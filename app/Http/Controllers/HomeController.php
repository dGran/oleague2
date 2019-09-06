<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Season;
use App\SeasonParticipant;
use App\SeasonPlayer;
use App\SeasonCompetitionPhaseGroupParticipant;
use App\Post;

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
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('home', compact('onlineUsersCount', 'posts'));
    }

    public function clubs()
    {
        $participants = $this->get_participants();
        return view('clubs.list', compact('participants'));
    }

    public function club($slug)
    {
        $participants = $this->get_participants();
        $participant = $this->get_participant($slug);

        // dd($participant->last_results());

        $par = SeasonCompetitionPhaseGroupParticipant::where('participant_id', '=', $participant->id)->first();
        // dd($par);

        return view('clubs.index', compact('participants', 'participant', 'par'));
    }

    public function clubRoster($slug)
    {
        $participants = $this->get_participants();
        $participant = $this->get_participant($slug);

        return view('clubs.roster', compact('participants', 'participant'));
    }

    public function clubEconomy($slug)
    {
        $participants = $this->get_participants();
        $participant = $this->get_participant($slug);

        return view('clubs.economy', compact('participants', 'participant'));
    }

    public function clubCalendar($slug)
    {
        $participants = $this->get_participants();
        $participant = $this->get_participant($slug);

        return view('clubs.calendar', compact('participants', 'participant'));
    }

    public function clubPress($slug)
    {
        $participants = $this->get_participants();
        $participant = $this->get_participant($slug);

        return view('clubs.press', compact('participants', 'participant'));
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

    public function rules()
    {
        return view('rules.index');
    }



    // helpers

    protected function get_participants()
    {
        return SeasonParticipant::
            leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
            ->leftJoin('users', 'users.id', '=', 'season_participants.user_id')
            ->select('season_participants.*', 'teams.name as team_name', 'users.name as user_name')
            ->seasonId(active_season()->id)->orderBy('teams.name', 'asc')->get();
    }

    protected function get_participant($slug)
    {
        return SeasonParticipant::
            leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
            ->leftJoin('users', 'users.id', '=', 'season_participants.user_id')
            ->select('season_participants.*', 'teams.name as team_name', 'users.name as user_name')
            ->seasonId(active_season()->id)
            ->where('teams.slug', '=', $slug)
            ->first();
    }
}
