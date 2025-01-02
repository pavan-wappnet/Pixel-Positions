<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // $employerAttributes = $request->validate([
        //     'employer_name' => ['required', 'string', 'max:255'],
        //     'employer_logo' => ['required', File::image()->max(1024)],
        // ]);

        $user = User::create($userAttributes);

        // $logopath = $request->file('employer_logo')->store('logos', 'public');

        // $user->employer()->create([
        //     'name' => $employerAttributes['employer_name'],
        //     'logo_path' => $logopath,
        // ]);

        Auth::login($user);
        return redirect('/');
    }
}
