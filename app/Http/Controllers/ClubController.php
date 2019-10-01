<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonParticipant;
use App\SeasonCompetitionPhaseGroupParticipant;
use App\Post;
use App\Press;

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
        // dd($par);

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
                        return back()->with('success', 'Nota de prensa guardada correctamente.');
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
