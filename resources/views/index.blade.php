<!DOCTYPE html>
<html>
<head>
    <title>Multi Platform Goals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div id="uuidForm" style="display: none;">
        <h3>Enter UUID</h3>
        <div class="mb-3">
            <input type="text" class="form-control" id="uuidInput" placeholder="Paste your UUID">
        </div>
        <button class="btn btn-primary" id="submitBtn">Submit</button>
        <button class="btn btn-secondary" id="addNewBtn">Add New</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const savedUuid = localStorage.getItem('uuid');

            if (savedUuid) {
                // Validate UUID with backend
                fetch('/check-uuid', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ uuid: savedUuid })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.valid) {
                        window.location.href = '/dashboard';
                    } else {
                        localStorage.removeItem('uuid');
                        document.getElementById('uuidForm').style.display = 'block';
                    }
                });
            } else {
                document.getElementById('uuidForm').style.display = 'block';
            }

            document.getElementById('submitBtn').addEventListener('click', () => {
                const uuid = document.getElementById('uuidInput').value.trim();
                fetch('/check-uuid', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ uuid })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.valid) {
                        localStorage.setItem('uuid', uuid);
                        window.location.href = '/dashboard';
                    } else {
                        alert('UUID not found. Redirecting to Add New Token...');
                        window.location.href = '{{ route("tokens.index") }}';
                    }
                });
            });

            document.getElementById('addNewBtn').addEventListener('click', () => {
                window.location.href = '{{ route("tokens.index") }}';
            });
        });
    </script>

</body>
</html>
