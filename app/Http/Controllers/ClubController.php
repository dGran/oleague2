<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonParticipant;
use App\SeasonCompetitionPhaseGroupParticipant;
use App\Post;
use App\Press;
use App\SeasonCompetitionMatch;

use Telegram\Bot\Laravel\Facades\Telegram;

class ClubController extends Controller
{
    public function clubs()
    {
        $participants = $this->get_participants();
        return view('clubs.index', compact('participants'));
    }

    public function club($slug)
    {
        $participants = $this->get_participants();
        $participant = $this->get_participant($slug);

        // dd($participant->last_results());

        $par = SeasonCompetitionPhaseGroupParticipant::where('participant_id', '=', $participant->id)->first();

        return view('clubs.club', compact('participants', 'participant', 'par'));
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

        $cash = 0;
        foreach ($participant->cash_history as $cash_history) {
            if ($cash_history->movement == "E") {
                $cash += $cash_history->amount;
                $cash_history['cash'] = $cash;
            } else {
                $cash -= $cash_history->amount;
                $cash_history['cash'] = $cash;
            }
        }

        return view('clubs.economy', compact('participants', 'participant', 'cash_history'));
    }

    public function clubCalendar($slug)
    {
        $participants = $this->get_participants();
        $participant = $this->get_participant($slug);

        $matches = SeasonCompetitionMatch::
            leftJoin('playoffs_rounds_clashes', 'playoffs_rounds_clashes.id', '=', 'season_competitions_matches.clash_id')
            ->leftJoin('season_competitions_phases_groups_leagues_days', 'season_competitions_phases_groups_leagues_days.id', '=', 'season_competitions_matches.day_id')
            ->leftJoin('season_competitions_phases_groups_participants as local_group_participant', 'local_group_participant.id', '=', 'season_competitions_matches.local_id')
            ->leftJoin('season_competitions_phases_groups_participants as visitor_group_participant', 'visitor_group_participant.id', '=', 'season_competitions_matches.visitor_id')
            ->leftJoin('season_participants as local_participant', 'local_participant.id', '=', 'local_group_participant.participant_id')
            ->leftJoin('season_participants as visitor_participant', 'visitor_participant.id', '=', 'visitor_group_participant.participant_id')
            ->select('season_competitions_matches.*')
            ->where('local_participant.id', '=', $participant->id)
            ->orWhere('visitor_participant.id', '=', $participant->id)
            ->orderBy('season_competitions_matches.date_limit', 'asc')
            ->orderBy('season_competitions_matches.id', 'asc')
            ->get();

        return view('clubs.calendar', compact('participants', 'participant', 'matches'));
    }

    public function clubPress($slug)
    {
        $participants = $this->get_participants();
        $participant = $this->get_participant($slug);
        $presses = Press::where('participant_id', '=', $participant->id)->orderBy('created_at', 'desc')->get();

        return view('clubs.press', compact('participants', 'participant', 'presses'));
    }

    public function clubPressAdd($slug)
    {
        if (auth()->guest()) {
            return back()->with('info', 'La página ha expirado debido a la inactividad.');
        } else {
            if (!user_is_participant(auth()->user()->id)) {
                return back()->with('error', 'No eres participante del torneo.');
            } else {
                $participant = $this->get_participant($slug);
                if (auth()->user()->id != $participant->user_id) {
                    return back()->with('error', 'No puedes crear notas de prensa de otros equipos.');
                } else {
                    $participant = $this->get_participant($slug);
                    $press = new Press;
                    $press->participant_id = $participant->id;
                    $press->title = request()->title;
                    $press->description = request()->description;
                    $press->save();
                    if ($press->save()) {
                        $post = Post::create([
                            'type' => 'press',
                            'transfer_id' => null,
                            'match_id' => null,
                            'press_id' => $press->id,
                            'category' => 'RUEDA DE PRENSA - ' . $participant->team->name,
                            'title' => $press->title,
                            'description' => $press->description,
                            'img' => 'img/microphone.png',
                        ]);

                        $club_link = 'https://lpx.es/clubs/'.$participant->team->slug.'/sala-de-prensa';
                        $club_name = $participant->team->name;
                        $user_name = $participant->user->name;
                        $title = "\xF0\x9F\x92\xAC Declaraciones de $user_name ($club_name) \xF0\x9F\x92\xAC";
                        $text = "$title\n\n";
                        $text .= "    <b>$press->title</b>\n";
                        $text .= "    " . $press->description . "\n\n";
                        $text .= "\xF0\x9F\x8F\xA0 <a href='$club_link'>Sala de prensa de $club_name</a>\n";
                        Telegram::sendMessage([
                            'chat_id' => '-1001241759649',
                            'parse_mode' => 'HTML',
                            'text' => $text
                        ]);
                        return back()->with('success', 'Nota de prensa enviada correctamente.');
                    }
                }
            }
        }
    }



    // helpers functions

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
