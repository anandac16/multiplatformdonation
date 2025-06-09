<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
    <style>
        .container {
            margin: auto;
            background-color: {{ $overlay->milestone_bg_color }};
            color: {{ $overlay->milestone_text_color }};
            font-family: Arial, sans-serif;
            text-align: center;
            border: black 1px solid;
            box-shadow: 5px 5px black;
            width: 90%;
        }
        .progress-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 20px auto;
            width: 80%;
        }

        .progress {
            flex: 1;
            height: 30px;
            background: #444;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: {{ $overlay->milestone_text_color }};
            transition: width 0.3s ease;
        }

        .progress-text {
            min-width: 40px;
            text-align: left;
        }
        p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container" id="container">
        <h2 id="title">{{ $overlay->milestone_title }}</h2>
        <div class="progress-container">
            <div class="progress">
                @php
                    $percent = min(100, ($donated / $overlay->milestone_target) * 100);
                @endphp
                <div class="progress-bar" id="progressBar" style="width: {{ $percent }}%"></div>
            </div>
            <span id="progressText" class="progress-text">{{ $percent }}%</span>
        </div>
        <p id="amountText">Rp{{ number_format($donated,0,",",".") }} dari Rp{{ number_format($overlay->milestone_target,0,",",".") }}</p>
    </div>
    <script>
        const uuid = '{{ $uuid }}';
        const baseUrl = @json(env('APP_URL'));
        const webhookUrl = @json(env('WEBHOOK_URL'));
        let donated = parseInt(@json($donated));
        let target = parseInt(@json($overlay->milestone_target));

        const container = document.getElementById('container');
        const bar = document.getElementById('progressBar');
        const amountText = document.getElementById('amountText');
        const titleEl = document.getElementById('title');
        const progressText = document.getElementById('progressText');

        function formatRupiah(value) {
            return 'Rp' + parseInt(value).toLocaleString('id-ID');
        }

        function updateProgress() {
            const percent = Math.min(100, (donated / target) * 100);
            bar.style.width = percent + '%';
            progressText.textContent = Math.floor(percent) + '%';
            amountText.textContent = `${formatRupiah(donated)} dari ${formatRupiah(target)}`;
        }

        // Load milestone data from API
        fetch(`${baseUrl}/api/widgets/milestone/${uuid}`)
            .then(res => res.json())
            .then(data => {
                target = parseInt(data.target);
                donated = parseInt(data.donated);
                container.style.backgroundColor = data.bg_color;
                bar.style.color = data.text_color;
                bar.style.backgroundColor = data.text_color;
                updateProgress();
            });

        // Connect to WebSocket
        const socket = io(webhookUrl.replace(/^https?/, 'wss'), {
            cors: {
                origin: "*", // or specific domain
                methods: ["GET", "POST"],
                allowedHeaders: ["*"],
                credentials: true
            }
            // transports: ['websocket']
        });

        socket.emit('join-room', uuid);

        socket.on('donation', data => {
            if (data.uuid === uuid) {
                donated += parseInt(data.amount);
                updateProgress();
            }
        });

        socket.on('reload-widget', data => {
            if (data.type === 'milestone') {
                // Re-fetch milestone data only
                fetch(`${baseUrl}/api/widgets/milestone/${uuid}`)
                    .then(res => res.json())
                    .then(data => {
                        titleEl.textContent = data.title;
                        target = data.target;
                        donated = data.donated;
                        container.style.backgroundColor = data.bg_color;
                        bar.style.color = data.text_color;
                        bar.style.backgroundColor = data.text_color;
                        updateProgress();
                    });
            }
        });

    </script>
</body>
</html>
