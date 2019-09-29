<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
	protected $table = 'trades';
    protected $fillable = ['season_id', 'participant1_id', 'participant2_id', 'cash1', 'cash2', 'state', 'cession'];

    public function season()
    {
        return $this->hasOne('App\Season', 'id', 'season_id');
    }

    public function participant1()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant1_id');
    }

    public function participant2()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant2_id');
    }

    public function detail()
    {
        return $this->hasmany('App\TradeDetail', 'trade_id', 'id');
    }

    public function check_offer()
    {
        // $offer_valid = true;
        $warnings = [];
        $counter = 0;

        $participant1 = SeasonParticipant::find($this->participant1_id);
        $participant2 = SeasonParticipant::find($this->participant2_id);

        // check participant budgets after confirm offer
        $cash = $participant1->budget() - $this->cash1 + $this->cash2;
        if ($cash < 0) {
            // $offer_valid = false;
            $warnings[$counter] = "El presupuesto del " . $participant1->name() . " quedará en números rojos";
            $counter++;
        }
        $cash = $participant2->budget() - $this->cash2 + $this->cash1;
        if ($cash < 0) {
            // $offer_valid = false;
            $warnings[$counter] = "El presupuesto del " . $participant2->name() . " quedará en números rojos";
            $counter++;
        }

        // check that players are still on the same teams
        $p1_players_counter = 0;
        $p2_players_counter = 0;
        $details = TradeDetail::where('trade_id', '=', $this->id)->get();
        foreach ($details as $detail) {
            if ($detail->player1_id) {
                $player = SeasonPlayer::find($detail->player1_id);
                if ($player->participant_id != $participant1->id) {
                    $warnings[$counter] = "El jugador " . $player->player->name . " ya no pertenece al " . $participant1->name();
                    $counter++;
                }
                $p1_players_counter++;
            }
            if ($detail->player2_id) {
                $player = SeasonPlayer::find($detail->player2_id);
                if ($player->participant_id != $participant2->id) {
                    $warnings[$counter] = "El jugador " . $player->player->name . " ya no pertenece al " . $participant2->name();
                    $counter++;
                }
                $p2_players_counter++;
            }
        }

        // check that the templates are in the max and min range allowed
        $p1_total_players = $participant1->players->count() + $p2_players_counter - $p1_players_counter;
        $p2_total_players = $participant1->players->count() + $p1_players_counter - $p2_players_counter;
        $season = Season::find($this->season_id);
        $max_players = $season->max_players;
        $min_players = $season->min_players;

        if ($p1_total_players < $min_players || $p1_total_players > $max_players) {
            $warnings[$counter] = "La plantilla de " . $participant1->name() . " quedará fuera del rango permitido de jugadores máximos y mínimos";
            $counter++;
        }
        if ($p2_total_players < $min_players || $p2_total_players > $max_players) {
            $warnings[$counter] = "La plantilla de " . $participant2->name() . " quedará fuera del rango permitido de jugadores máximos y mínimos";
            $counter++;
        }

        return $warnings;
    }
}
