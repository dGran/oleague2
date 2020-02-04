<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Telegram\Bot\Laravel\Facades\Telegram;

use App\SeasonParticipant;
use App\SeasonParticipantCashHistory as Cash;
use App\GeneralSetting;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function telegram_notifications() {
    	return $notifications = GeneralSetting::first()->telegram_notifications;
    }

    // Telegram
    protected function telegram_notification_channel($text) {
    	if ($this->telegram_notifications()) {
			Telegram::sendMessage([
				// official channel
			    'chat_id' => env('TELEGRAM_CHANNEL_ID', 'YOUR-TELEGRAM-CHANNEL-ID'),
			    // padrone
			    // 'chat_id' => '599119701',

			    // development
			    // 'chat_id' => '-1001159210380',
			    'parse_mode' => 'HTML',
			    'text' => $text
			]);
    	}
    }

    protected function telegram_notification_admin($text) {
		Telegram::sendMessage([
		    'chat_id' => '-266877087',
		    'parse_mode' => 'HTML',
		    'text' => $text
		]);
    }

    public function telegram_updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
    }
    // END: Telegram


    // Competitions
    protected function add_cash_history($participant_id, $description, $amount, $movement) {
        $cash = new Cash;
        $cash->participant_id = $participant_id;
        $cash->description = $description;
        $cash->amount = $amount;
        $cash->movement = $movement;
        $cash->save();
    }
    // END: Competitions

    // meter todas las funciones que pueden ser utiles en mas controladores

}
