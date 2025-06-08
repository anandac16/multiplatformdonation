<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $uuid = session('user_uuid');
        $donations = Donation::where('uuid', $uuid)->latest()->paginate(20);
        return view('donations.index', compact('donations'));
    }

    public function storeJson(Request $request)
    {
        $validated = $request->validate([
            'uuid' => 'required|uuid',
            'platform' => 'required|string',
            'id' => 'required|string',
            'name' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'message' => 'nullable|string',
        ]);

        // Prevent duplicate
        if (Donation::where('external_id', $validated['id'])->exists()) {
            return response()->json(['message' => 'Already received'], 200);
        }

        Donation::create([
            'uuid' => $validated['uuid'],
            'platform' => $validated['platform'],
            'external_id' => $validated['id'],
            'name' => $validated['name'],
            'amount' => $validated['amount'],
            'message' => $validated['message'] ?? '',
        ]);

        return response()->json(['status' => 'saved']);
    }
}
