<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Carbon\Carbon;

class Users extends Controller
{
    public function getAllThisMonth()
    {
        $allUsers = User::all()->count();
        $task = User::whereMonth(
            'created_at', '=', Carbon::now()->month
        )->get();
        return [$task, $allUsers];
    }
}
