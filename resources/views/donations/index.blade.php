@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Donation History</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th><th>Name</th><th>Amount</th><th>Message</th><th>Platform</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($donations as $d)
            <tr>
                <td>{{ $d->created_at }}</td>
                <td>{{ $d->name }}</td>
                <td>Rp{{ number_format($d->amount) }}</td>
                <td>{{ $d->message }}</td>
                <td>{{ $d->platform }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $donations->links() }}
</div>
@endsection
