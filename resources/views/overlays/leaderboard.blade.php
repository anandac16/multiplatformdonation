@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Leaderboard Overlay Settings</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('overlay.leaderboard.update') }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $overlay->leaderboard_title }}">
        </div>

        <div class="mb-3">
            <label for="range" class="form-label">Range</label>
            <select name="range" id="range" class="form-control">
                <option value="daily" {{ $overlay->leaderboard_range === 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="weekly" {{ $overlay->leaderboard_range === 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ $overlay->leaderboard_range === 'monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="all" {{ $overlay->leaderboard_range === 'all' ? 'selected' : '' }}>All Time</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="bg_color" class="form-label">Background Color</label>
            <input type="color" name="bg_color" id="bg_color" class="form-control form-control-color" value="{{ $overlay->leaderboard_bg_color }}">
        </div>

        <div class="mb-3">
            <label for="text_color" class="form-label">Text Color</label>
            <input type="color" name="text_color" id="text_color" class="form-control form-control-color" value="{{ $overlay->leaderboard_text_color }}">
        </div>

        <div class="mb-3">
            <label for="widget_url" class="form-label">Widget URL</label>
            <input type="text" readonly class="form-control" value="{{ route('widget.leaderboard', session('user_uuid')) }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
