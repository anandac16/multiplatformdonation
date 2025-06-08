<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overlay;
use App\Models\Donation;

class WidgetController extends Controller
{
    public function milestone($uuid)
    {
        $overlay = Overlay::where('uuid', $uuid)->firstOrFail();
        $donated = Donation::where('uuid', $uuid)->sum('amount');
        return view('widgets.milestone', compact('overlay', 'donated'));
    }

    public function leaderboard($uuid)
    {
        $overlay = Overlay::where('uuid', $uuid)->firstOrFail();
        $donations = Donation::where('uuid', $uuid)
            ->selectRaw('name, SUM(amount) as total')
            ->groupBy('name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('widgets.leaderboard', compact('overlay', 'donations'));
    }

    public function milestoneJson($uuid)
    {
        $overlay = Overlay::where('uuid', $uuid)->first();
        $donated = Donation::where('uuid', $uuid)->sum('amount');

        if (!$overlay) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json([
            'title' => $overlay->milestone_title,
            'target' => $overlay->milestone_target,
            'donated' => $donated,
            'bg_color' => $overlay->milestone_bg_color,
            'text_color' => $overlay->milestone_text_color,
        ]);
    }

    public function leaderboardJson($uuid)
    {
        $overlay = Overlay::where('uuid', $uuid)->first();

        if (!$overlay) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $range = $overlay->leaderboard_range ?? 'all';
        $query = Donation::where('uuid', $uuid);

        if ($range === 'daily') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($range === 'weekly') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($range === 'monthly') {
            $query->whereMonth('created_at', now()->month);
        }

        $top = $query->select('name')
            ->selectRaw('SUM(amount) as total_amount')
            ->groupBy('name')
            ->orderByDesc('total_amount')
            ->limit(10)
            ->get();

        return response()->json([
            'title' => $overlay->leaderboard_title,
            'bg_color' => $overlay->leaderboard_bg_color,
            'text_color' => $overlay->leaderboard_text_color,
            'data' => $top,
        ]);
    }

}
