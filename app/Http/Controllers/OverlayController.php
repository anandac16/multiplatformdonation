<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overlay;
use Illuminate\Support\Str;

class OverlayController extends Controller
{
    public function editMilestone()
    {
        $uuid = session('user_uuid');
        $overlay = Overlay::firstOrCreate(['uuid' => $uuid]);
        return view('overlays.milestone', compact('overlay'));
    }

    public function updateMilestone(Request $request)
    {
        $uuid = session('user_uuid');

        $request->validate([
            'title' => 'required|string',
            'target' => 'required|numeric|min:1',
            'bg_color' => 'required|string',
            'text_color' => 'required|string',
        ]);

        $overlay = Overlay::firstOrCreate(['uuid' => $uuid]);
        $overlay->milestone_title = $request->title;
        $overlay->milestone_target = $request->target;
        $overlay->milestone_bg_color = $request->bg_color;
        $overlay->milestone_text_color = $request->text_color;
        $overlay->save();

        return back()->with('success', 'Milestone overlay updated!');
    }

    public function editLeaderboard()
    {
        $uuid = session('user_uuid');
        $overlay = Overlay::firstOrCreate(['uuid' => $uuid]);
        return view('overlays.leaderboard', compact('overlay'));
    }

    public function updateLeaderboard(Request $request)
    {
        $uuid = session('user_uuid');

        $request->validate([
            'title' => 'required|string',
            'range' => 'required|in:daily,weekly,monthly,all',
            'bg_color' => 'required|string',
            'text_color' => 'required|string',
        ]);

        $overlay = Overlay::firstOrCreate(['uuid' => $uuid]);
        $overlay->leaderboard_title = $request->title;
        $overlay->leaderboard_range = $request->range;
        $overlay->leaderboard_bg_color = $request->bg_color;
        $overlay->leaderboard_text_color = $request->text_color;
        $overlay->save();

        return back()->with('success', 'Leaderboard overlay updated!');
    }
}
