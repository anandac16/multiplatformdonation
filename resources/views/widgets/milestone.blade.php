<!DOCTYPE html>
<html>
<head>
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
            width: {{ min(100, round(($donated / max(1, $overlay->milestone_target)) * 100)) }}%;
            border-radius: 0 5px 5px 0;
        }
        p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $overlay->milestone_title }}</h2>
        <div class="progress">
            <div class="progress-bar"></div>
        </div>
        <p>{{ number_format($donated) }} / {{ number_format($overlay->milestone_target) }}</p>
    </div>
</body>
</html>
