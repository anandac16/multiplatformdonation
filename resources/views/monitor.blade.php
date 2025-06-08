@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Real-Time Widget Monitor</h3>
    <p>Connected widgets: <span id="widget-count">0</span></p>
</div>

<script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
<script>
    const socket = io('wss://server.achanvt.com', {
        transports: ['websocket']
    });

    socket.on('widget-count', data => {
        document.getElementById('widget-count').textContent = data.count;
    });
</script>
@endsection
