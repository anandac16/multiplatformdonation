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
        .progress {
            margin-top: 20px;
            width: 80%;
            height: 30px;
            background: #ddd;
            margin-left: auto;
            margin-right: auto;
        }
        .progress-bar {
            height: 100%;
            background: {{ $overlay->milestone_text_color }};
            border-radius: 0 5px 5px 0;
        }
        p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 id="title">Loading..</h2>
        <div class="progress">
            <div class="progress-bar" id="progressBar" style="width: 0%">0%</div>
        </div>
        <p id="amountText">Loading</p>
    </div>
    <script>
        const uuid = '{{ $uuid }}';
        const baseUrl = @json(env('WEBHOOK_URL'));
        let donated = 0;
        let target = 1000;

        const bar = document.getElementById('progressBar');
        const amountText = document.getElementById('amountText');
        const titleEl = document.getElementById('title');

        function formatRupiah(value) {
            return 'Rp' + value.toLocaleString('id-ID');
        }

        function updateProgress() {
            const percent = Math.min(100, (donated / target) * 100);
            bar.style.width = percent + '%';
            bar.textContent = Math.floor(percent) + '%';
            amountText.textContent = `${formatRupiah(donated)} dari ${formatRupiah(target)}`;
        }

        // Load milestone data from API
        fetch(`${baseUrl}/api/widgets/milestone/${uuid}`)
            .then(res => res.json())
            .then(data => {
                titleEl.textContent = data.title;
                target = data.target;
                donated = data.donated;
                document.body.style.backgroundColor = data.bg_color;
                bar.style.color = data.text_color;
                bar.style.backgroundColor = data.text_color;
                updateProgress();
            });

        // Connect to WebSocket
        const socket = io(baseUrl.replace(/^https?/, 'wss'), {
            transports: ['websocket']
        });

        socket.emit('join-room', uuid);

        socket.on('donation', data => {
            if (data.uuid === uuid) {
                donated += data.amount;
                updateProgress();
            }
        });
    </script>
</body>
</html>
