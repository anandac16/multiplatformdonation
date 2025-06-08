<!DOCTYPE html>
<html>
<head>
  <title>Save Webhook Tokens</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Save Webhook Tokens</h2>
  <form action="/save" method="post">
    @csrf
    @foreach (['trakteer', 'saweria', 'sociabuzz', 'tako'] as $field)
      <div class="mb-3">
        <label class="form-label text-capitalize">{{ $field }} Webhook Token</label>
        <input type="text" name="{{ $field }}" class="form-control" required>
      </div>
    @endforeach
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</body>
</html>
