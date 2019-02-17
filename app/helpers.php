<?php

use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use App\GeneralSetting;
use App\Season;

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
	return "http://pesdb.net/pes2019/images/players/" . $id . ".png";
}

function pesmaster_player_info_path($id) {
	return "https://www.pesmaster.com/neymar/pes-2019/player/" . $id;
}

function pesmaster_player_img_path($id) {
	return "https://www.pesmaster.com/pes-2019/graphics/players/player_" . $id . ".png";
}

function send_telegram_notification($text) {
    return Telegram::sendMessage([
        'chat_id' => env('TELEGRAM_CHANNEL_ID'),
        'parse_mode' => 'HTML',
        'text' => $text
    ]);
}

function active_season() {
	$season_id = GeneralSetting::first()->active_season_id;
	$season = Season::find($season_id);
	return $season;
}