@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Milestone Overlay Settings</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form method="POST" action="{{ route('overlay.milestone.update') }}">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="{{ $overlay->milestone_title }}">
        </div>
        <div class="mb-3">
            <label>Target Amount</label>
            <input type="number" class="form-control" name="target" value="{{ $overlay->milestone_target }}">
        </div>
        <div class="mb-3">
            <label>Background Color</label>
            <input type="color" class="form-control" name="bg_color" value="{{ $overlay->milestone_bg_color }}">
        </div>
        <div class="mb-3">
            <label>Text Color</label>
            <input type="color" class="form-control" name="text_color" value="{{ $overlay->milestone_text_color }}">
        </div>
        <div class="mb-3">
            <label>Widget URL</label>
            <input type="text" id="widget_url" onclick="copyText()" class="form-control" readonly value="{{ route('widget.milestone', session('user_uuid')) }}">
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
    <script>
        function copyText() {
            // Get the text field
            var copyText = document.getElementById("widget_url");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Copied to clipboard");
        }
    </script>
</div>
@endsection
