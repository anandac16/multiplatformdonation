<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        if(session('user_uuid')) {
            return redirect(route('dashboard'));
        }
        return view('index');
    }

    public function checkUuid(Request $request)
    {
        $uuid = $request->input('uuid');
        $token = Token::where('uuid', $uuid)->first();

        if ($token) {
            session(['user_uuid' => $uuid]);
            return response()->json(['valid' => true]);
        }

        return response()->json(['valid' => false]);
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function howto()
    {
        return view('howto');
    }
}
