<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailbox;

class MailboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$notifications = Mailbox::where('user_id', '=', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('users.notifications.index', compact('notifications'));
    }

    public function read($id)
    {
		$notification = Mailbox::find($id);

		if ($notification) {
			$notification->read = 1;
			$notification->save();
		}

        return back();
    }

    public function readAll()
    {
		$notifications = Mailbox::where('user_id', '=', auth()->user()->id)->get();

		foreach ($notifications as $notification) {
			$notification->read = 1;
			$notification->save();
		}

        return back();
    }

    public function destroy($id)
    {
		$notification = Mailbox::find($id);

		if ($notification) {
			$notification->delete();
		}

        return back()->with('success', 'Notificación eliminada correctamente');
    }

    public function destroyAll()
    {
		$notifications = Mailbox::where('user_id', '=', auth()->user()->id)->get();

		foreach ($notifications as $notification) {
			$notification->delete();
		}

        return back()->with('success', 'Todas las notificaciones eliminadas correctamente');
    }
}
