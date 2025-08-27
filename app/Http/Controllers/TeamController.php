<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $members = User::where('role', '!=', 'user')->get();

        return view('team.index', compact('members'));
    }
}
