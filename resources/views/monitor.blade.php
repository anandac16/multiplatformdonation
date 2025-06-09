@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Real-Time Widget Monitor</h3>
    <p>Connected widgets: <span id="widget-count">0</span></p>
</div>

<script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
<script>
    const baseUrl = @json(env('WEBHOOK_URL'));
    let totalConnected = 0;
    const socket = io(baseUrl.replace(/^https?/, 'wss'), {
        // transports: ['websocket']
    });

    socket.on('widget-count', data => {
        totalConnected = (data.count > 0) ? data.count - 1 : 0;
        document.getElementById('widget-count').textContent = totalConnected;
    });
</script>
@endsection
