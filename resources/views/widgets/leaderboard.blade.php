<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Leaderboard Widget</title>
    <style>
        .container {
            margin: auto;
            background-color: {{ $overlay->leaderboard_bg_color }};
            color: {{ $overlay->leaderboard_text_color }};
            font-family: Arial, sans-serif;
            padding: 10px;
            border: black 1px solid;
            box-shadow: 5px 5px black;
            width: 90%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .leaderboard {
            max-width: 600px;
            margin: 0 auto;
        }

        .entry {
            display: flex;
            justify-content: space-between;
            padding: 8px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .entry:nth-child(odd) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .name {
            font-weight: bold;
        }

        .amount {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $overlay->leaderboard_title }}</h2>

        <div class="leaderboard">
            @foreach ($donations as $donor)
                <div class="entry">
                    <div class="name">{{ $donor->name }}</div>
                    <div class="amount">Rp{{ number_format($donor->total) }}</div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
