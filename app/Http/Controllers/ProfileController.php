<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
		$profile = auth()->user()->profile()->firstOrNew([]);
        return view('users/profile', compact('profile'));
    }

    public function update(Request $request, $id)
    {
    	$profile = Profile::find($id);
    	if (!$profile) {
            $profile = new Profile;
            $profile->user_id = $id;
    	}
    	$profile->fill($request->all());
    	$profile->slack_notifications = $request->slack_notifications ? true : false;
        $profile->email_notifications = $request->email_notifications ? true : false;

    	$profile->save();

    	return back()->with('status', 'Perfil de usuario actualizado correctamente');
    }
}
