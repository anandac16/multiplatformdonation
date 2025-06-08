<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Leaderboard Widget</title>
    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
    <style>
        .container {
            margin: 0 auto;
            background-color: {{ $overlay->leaderboard_bg_color }};
            color: {{ $overlay->leaderboard_text_color }};
            font-family: Arial, sans-serif;
            padding: 10px;
            border: black 1px solid;
            box-shadow: 5px 5px black;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .leaderboard-list {
            list-style: none;
            padding: 0;
        }

        .leaderboard-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #444;
            font-size: 18px;
        }

        .donator-name {
            flex: 1;
            text-align: left;
        }

        .donation-amount {
            text-align: right;
            min-width: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 id="title">Loading..</h2>

        <ul id="leaderboard-list" class="leaderboard-list">
        </ul>
    </div>
    <script>
        const uuid = '{{ $uuid }}';
        const baseUrl = @json(env('WEBHOOK_URL'));

        const listEl = document.getElementById('leaderboard-list');
        const titleEl = document.getElementById('leaderboard-title');

        function formatRupiah(amount) {
            return 'Rp' + amount.toLocaleString('id-ID');
        }

        function updateList(entries) {
            listEl.innerHTML = '';
            entries.forEach(entry => {
                const li = document.createElement('li');
                li.className = 'leaderboard-item';

                const name = document.createElement('span');
                name.className = 'donator-name';
                name.textContent = entry.name;

                const amount = document.createElement('span');
                amount.className = 'donation-amount';
                amount.textContent = formatRupiah(entry.total_amount);

                li.appendChild(name);
                li.appendChild(amount);
                listEl.appendChild(li);
            });
        }


        // Load initial leaderboard data
        fetch(`${baseUrl}/api/widgets/leaderboard/${uuid}`)
            .then(res => res.json())
            .then(data => {
                titleEl.textContent = data.title || 'Top Donators';
                document.body.style.backgroundColor = data.bg_color || '#000';
                document.body.style.color = data.text_color || '#fff';
                updateList(data.data || []);
            });

        // WebSocket connection
        const socket = io(baseUrl.replace(/^https?/, 'wss'), {
            transports: ['websocket']
        });

        socket.emit('join-room', uuid);

        socket.on('donation', donation => {
            if (donation.uuid === uuid) {
                fetch(`${baseUrl}/api/widgets/leaderboard/${uuid}`)
                    .then(res => res.json())
                    .then(data => {
                        updateList(data.data || []);
                    });
            }
        });
    </script>
</body>
</html>
