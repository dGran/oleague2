<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Season;
use App\SeasonParticipant;
use App\SeasonPlayer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

// $text = "\xF0\x9F\x92\xB0 Clausulazo!!\n"
// . "El <b>Zenit (pAdRoNe)</b> paga la clausula de " . '<a href="http://pesdb.net/pes2018/?id=7511">L. Messi</a>' . " que pertenecía al Borussia Dortmund (Angel_el_grande)\n"
// . "Desembolsa <b>220 (200+20) millones</b> de euros\n"
// . "<i>Presupuesto del Zenit: 25 mill.</i>\n"
// . "<i>Presupuesto del Borussia Dortmund: 275 mill.</i>";

// $text = "\xF0\x9F\x93\x8A Clasificación LIGA NORTE\n"
// . "<pre>1.- Botafogo  - 12 puntos</pre>\n"
// . "<pre>2.- Ajax      -  9 puntos</pre>\n"
// . "<pre>3.- Liverpool -  7 puntos</pre>\n"
// . "...";

// $text = "\xE2\x9A\xBD Resultado registrado\n"
// . "<pre>LIGA NORTE - Jornada 3</pre>\n"
// . "<pre>Ajax (Luizao) 2-0 PSV (Sullendonkey)</pre>";

// $text = "\xF0\x9F\x92\x80 Usuario expulsado\n"
// . "<b>Fermin</b> expulsado de la liga";

// $text = "\xF0\x9F\x91\x8B Nuevo usuario registrado\n"
// . "<b>Antxon</b> se ha unido a la lista de reservas de la liga";


// Telegram::sendMessage([
//     'chat_id' => '-1001241759649',
//     'parse_mode' => 'HTML',
//     'text' => $text,
//     'disable_web_page_preview' => true
// ]);

        // $telegram = new Api('614390960:AAFss7OCInp0H97lxAZstNt9m7fw4CeaX64');
        // $response = $telegram->getMe();

        // $botId = $response->getId();
        // $firstName = $response->getFirstName();
        // $username = $response->getUsername();

// $response = $telegram->sendMessage([
//   'chat_id' => '599119701',
//   'text' => 'Hello World'
// ]);

// $messageId = $response->getMessageId();

        // dd($username);

        // $text = "Mensaje de prueba con channel almacenado";
        // send_telegram_notification($text);

        $users = User::all();
        $onlineUsersCount = 0;
        foreach ( $users as $user )
        {
            if($user->isOnline()) {
                $onlineUsersCount++;
            }
        }

        return view('home', compact('onlineUsersCount'));
    }

    public function clubs()
    {
        $participants = SeasonParticipant::
        leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'season_participants.user_id')
        ->select('season_participants.*', 'teams.name as team_name', 'users.name as user_name')
        ->seasonId(active_season()->id)->orderBy('teams.name', 'asc')->get();

        return view('clubs.list', compact('participants'));
    }

    public function club($slug)
    {
        $participants = SeasonParticipant::
        leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'season_participants.user_id')
        ->select('season_participants.*', 'teams.name as team_name', 'users.name as user_name')
        ->seasonId(active_season()->id)->orderBy('teams.name', 'asc')->get();
        // $participants = SeasonParticipant::where('season_id', '=', active_season()->id)->get();
        $participant = SeasonParticipant::
        leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'season_participants.user_id')
        ->select('season_participants.*', 'teams.name as team_name', 'users.name as user_name')
        ->seasonId(active_season()->id)
        ->where('teams.slug', '=', $slug)
        ->first();

        $team_avg_overall = SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('players.overall_rating')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $participant->id)
            ->avg('players.overall_rating');

        $team_avg_age = SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('players.age')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $participant->id)
            ->avg('players.age');

        return view('clubs.index', compact('participants', 'participant', 'team_avg_overall', 'team_avg_age'));
    }

    public function clubRoster($slug)
    {
        $participants = SeasonParticipant::
        leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'season_participants.user_id')
        ->select('season_participants.*', 'teams.name as team_name', 'users.name as user_name')
        ->seasonId(active_season()->id)->orderBy('teams.name', 'asc')->get();
        // $participants = SeasonParticipant::where('season_id', '=', active_season()->id)->get();
        $participant = SeasonParticipant::
        leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'season_participants.user_id')
        ->select('season_participants.*', 'teams.name as team_name', 'users.name as user_name')
        ->seasonId(active_season()->id)
        ->where('teams.slug', '=', $slug)
        ->first();

        $top_players = SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $participant->id)
            ->orderBy('players.overall_rating', 'desc')
            ->take(3)->get();

        $top_defs = SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $participant->id)
            ->where(function($q) {
                $q->where('players.position', '=', 'CT')
                  ->orWhere('players.position', '=', 'LI')
                  ->orWhere('players.position', '=', 'LD')
                  ->orWhere('players.position', '=', 'LD');
            })
            ->orderBy('players.overall_rating', 'desc')
            ->take(3)->get();

        $top_mids = SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $participant->id)
            ->where(function($q) {
                $q->where('players.position', '=', 'MCD')
                  ->orWhere('players.position', '=', 'MC')
                  ->orWhere('players.position', '=', 'MP')
                  ->orWhere('players.position', '=', 'II')
                  ->orWhere('players.position', '=', 'ID');
            })
            ->orderBy('players.overall_rating', 'desc')
            ->take(3)->get();

        $top_forws = SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $participant->id)
            ->where(function($q) {
                $q->where('players.position', '=', 'DC')
                  ->orWhere('players.position', '=', 'SD')
                  ->orWhere('players.position', '=', 'EI')
                  ->orWhere('players.position', '=', 'ED');
            })
            ->orderBy('players.overall_rating', 'desc')
            ->take(3)->get();

        $young_players = SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $participant->id)
            ->orderBy('players.age', 'asc')
            ->take(3)->get();

        $veteran_players = SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $participant->id)
            ->orderBy('players.age', 'desc')
            ->take(3)->get();

        return view('clubs.roster', compact('participants', 'participant', 'top_players', 'top_defs', 'top_mids', 'top_forws', 'young_players', 'veteran_players'));
    }

    public function participants()
    {
        return view('participants');
    }

    public function competitions()
    {
        return view('competitions.index');
    }

    public function competition()
    {
        return redirect(route('competition.league.standing'));
    }

    public function competition_standing()
    {
        return view('competitions.league.standing');
    }

    public function competition_schedule()
    {
        return view('competitions.league.schedule');
    }

    public function competition_statistics()
    {
        return view('competitions.league.statistics');
    }

    public function competition_match()
    {
        return view('competitions.match');
    }
}
