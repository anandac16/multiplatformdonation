<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function index($id = null)
    {
        $uuid = $id ?? request()->session()->get('user_uuid');
        $token = Token::where('uuid', $uuid)->first();
        return view('tokens.index', compact('token'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trakteer_token' => 'nullable|string',
            'sociabuzz_token' => 'nullable|string',
            'tako_token' => 'nullable|string',
        ]);

        $token = Token::create($validated);
        session(['user_uuid' => $token->uuid]);
        return redirect()->route('dashboard');
    }

    public function create()
    {
        return view('tokens.create');
    }

    public function show($uuid)
    {
        $token = Token::where('uuid', $uuid)->firstOrFail();
        return view('tokens.show', compact('token'));
    }

    public function update(Request $request, $uuid)
    {
        $token = Token::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'trakteer_token' => 'nullable|string',
            'sociabuzz_token' => 'nullable|string',
            'tako_token' => 'nullable|string',
        ]);

        $token->update($validated);
        return back()->with('success', 'Tokens updated!');
    }

    public function jsonData($uuid) {
        $token = Token::where('uuid', $uuid)->first();

        if (!$token) {
            return response()->json(['error' => 'UUID not found'], 404);
        }

        return response()->json([
            'trakteer_token' => $token->trakteer_token,
            'sociabuzz_token' => $token->sociabuzz_token,
            'tako_token' => $token->tako_token,
        ]);
    }
}
