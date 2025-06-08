<!DOCTYPE html>
<html>
<head>
  <title>Webhook Listener</title>
  <meta charset="UTF-8">
  <script>
    setInterval(() => {
      fetch(`/webhook-data/{{ $uuid }}`)
        .then(res => res.json())
        .then(data => {
          document.getElementById("msg").innerText = data.message || "(No message yet)";
        });
    }, 2000);
  </script>
</head>
<body class="container mt-5">
  <h2>Listening for Webhook: <code>{{ $uuid }}</code></h2>
  <pre id="msg">(Waiting for webhook message...)</pre>
</body>
</html>
