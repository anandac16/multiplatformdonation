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
            'external_id' => 'required|string',
            'name' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'message' => 'nullable|string',
        ]);

        // Prevent duplicate
        if (Donation::where('transaction_id', $validated['external_id'])->exists()) {
            return response()->json(['message' => 'Already received'], 200);
        }

        // FILTER TEST DONATIONS
        $blockKeywords = ['Ini hanya test notifikasi', 'Ini adalah pesan contoh', 'THIS IS A FAKE MESSAGE', '[ Stream Test ]'];
        $lowerName = strtolower($validated['name']);
        $lowerMsg = strtolower($validated['message'] ?? '');

        foreach ($blockKeywords as $keyword) {
            if (str_contains($lowerName, strtolower($keyword)) || str_contains($lowerMsg, strtolower($keyword))) {
                return response()->json(['ignored' => 'Test donation detected'], 200);
            }
        }


        Donation::create([
            'uuid' => $validated['uuid'],
            'platform' => $validated['platform'],
            'transaction_id' => $validated['external_id'],
            'name' => $validated['name'],
            'amount' => $validated['amount'],
            'message' => $validated['message'] ?? '',
        ]);

        return response()->json(['status' => 'saved']);
    }
}
