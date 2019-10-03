<?php

use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use App\GeneralSetting;
use App\Season;
use App\SeasonParticipant;
use App\Showcase;
use App\FavoritePlayer;
use App\Press;
use App\User;

function validateUrl($url)
{
	$url = @parse_url($url);
	if (!$url) return false;

	$url = array_map('trim', $url);
	$url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];

	$path = (isset($url['path'])) ? $url['path'] : '/';
	$path .= (isset($url['query'])) ? "?$url[query]" : '';

	if (isset($url['host']) && $url['host'] != gethostbyname($url['host'])) {

	     $fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 30);

	      if (!$fp) return false; //socket not opened

	        fputs($fp, "HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n"); //socket opened
	        $headers = fread($fp, 4096);
	        fclose($fp);

	     if(preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers)){//matching header
	           return true;
	     }
	     else return false;

	 } // if parse url
	 else return false;
}

function pesdb_player_info_path($id) {
	return "http://pesdb.net/pes2019/?id=" . $id;
}

function pesdb_player_img_path($id) {
	return "http://pesdb.net/pes2020/images/players/" . $id . ".png";
}

function pesmaster_player_info_path($id) {
	return "https://www.pesmaster.com/neymar/pes-2019/player/" . $id;
}

function pesmaster_player_img_path($id) {
	return "https://www.pesmaster.com/pes-2020/graphics/players/player_" . $id . ".png";
}

function send_telegram_notification($text) {
    return Telegram::sendMessage([
        'chat_id' => env('TELEGRAM_CHANNEL_ID'),
        'parse_mode' => 'HTML',
        'text' => $text
    ]);
}

function active_season() {
	if (DB::table('general_settings')->exists()) {
		$season_id = GeneralSetting::first()->active_season_id;
		if ($season_id) {
			$season = Season::find($season_id);
			return $season;
		}
	}
	return false;
}

function user_is_participant($user_id) {
	if (SeasonParticipant::where('season_id', '=', active_season()->id)->where('user_id', '=', $user_id)->first()) {
		return true;
	}
	return false;
}

function participant_of_user() {
	$participant = SeasonParticipant::where('season_id', '=', active_season()->id)->where('user_id', '=', auth()->user()->id)->first();
	if ($participant) {
		return $participant;
	}
	return null;
}

function is_favourite_player($player_id) {
	$favourite = FavoritePlayer::where('player_id', '=', $player_id)->where('participant_id', '=', participant_of_user()->id)->first();
	if ($favourite) {
		return true;
	}
	return false;
}

function num_favourite_player($player_id) {
	return FavoritePlayer::where('player_id', '=', $player_id)->count();
}

function player_in_showcase($player_id) {
	if (Showcase::where('player_id', '=', $player_id)->first()) {
		return true;
	}
	return false;
}

function hours_to_new_press($participant_id)
{
	$last_press = Press::where('participant_id', '=', $participant_id)->orderBy('created_at', 'desc')->first();
	if ($last_press) {
		$next_press_data = new \Carbon\Carbon($last_press->created_at);
		$next_press_data->addDay();
		$now = \Carbon\Carbon::now();
		$testdate = $next_press_data->diffInHours($now);

		return $testdate;
	} else {
		return 0;
	}
}

function online_registered_users()
{
    $users = User::all();
    $onlineUsersCount = 0;
    foreach ( $users as $user )
    {
        if ($user->isOnline()) {
            $onlineUsersCount++;
        }
    }

    return $onlineUsersCount;
}