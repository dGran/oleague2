<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
    	return back()->with('info', 'Competiciones - Próximamente...');
    }

    public function pendingMatches()
    {
    	return back()->with('info', 'Partidas pendientes - Próximamente...');
    }
}
