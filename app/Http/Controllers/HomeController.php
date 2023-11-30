<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        /** @var \App\Models\User\User $user */
		$user = Auth::user();

		if ($user->hasRole('admin')) return redirect('/users');
		return redirect('/');
    }
}
