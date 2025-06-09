@extends('layouts.app')

@section('content')
<div class="container">
    <center><h1>How to ?</h1></center>
    <p style="white-space:pre-wrap">
This tutorial explains how to connect your donation platforms (Trakteer, Sociabuzz, Tako, Sociabuzz) to the dashboard so you can receive and display donations in real-time overlays.

If this is your first time, open menu <a href="/tokens/{{ session('user_uuid') }}">Tokens</a>
If it's not your first time, open <a href="/connect">Connect</a> and insert your UUID
    </p>
    <h3>Set up new Tokens</h3>
    You'll see a form to fill in your webhook tokens :

    <ul>
        <li>Trakteer Token</li>
        <li>Sociabuzz Token</li>
        <li>Tako Token</li>
        <li>(Saweria doesn't need to set a token because the platform didnt provide the token)</li>
    </ul>
    <p style="white-space: pre-wrap">
Here's how to get the tokens :
For trakteer, go to Integrations > Webhook
For Sociabuzz, go to Overlay Live Streaming > Integrations > Webhook
For Tako, go to click Creator page > Integrasi > Notifikasi Webhook
For Saweria, go to Integration > Webhook
    </p>
    <h3>Save your tokens</h3>
    <p style="white-space: pre-wrap">After saving, it will generate a webhook url for you. Open menu <a href="/tokens/{{ session('user_uuid') }}">Tokens</a>.
Copy the Webhook URL and paste it into each platform’s webhook settings.
    </p>

    <h3>Show the widgets!</h3>
    <p style="white-space: pre-wrap">Currently there are only 2 widgets that can be displayed.
The first is <a href="/overlays/milestone">Milestone</a>. In here you can set the title of the milestone, target amount, background color, and text color. To show it on stream, copy the Widget URL and add a browser source on OBS (or any other streaming software).

And the second widget is <a href="/overlays/leaderboard">Leaderboard</a>. In here you can set the title of the Leaderboard, range, background color, and text color. To show it on stream, copy the Widget URL and add a browser source on OBS (or any other streaming software).
    </p>

    <h3>Donation History!</h3>
    <p style="white-space: pre-wrap">To see your donation history, open menu <a href="/donations">Donation History</a>
    </p>
</div>
@endsection
