@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>{{ isset($token) ? 'Edit Tokens' : 'Tambah Token Baru' }}</h3>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <form action="{{ isset($token) ? route('tokens.update', $token->uuid) : route('tokens.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="trakteer_token" class="form-label">Trakteer Token</label>
            <input type="text" class="form-control" name="trakteer_token" value="{{ old('trakteer_token', $token->trakteer_token ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="sociabuzz_token" class="form-label">Sociabuzz Token</label>
            <input type="text" class="form-control" name="sociabuzz_token" value="{{ old('sociabuzz_token', $token->sociabuzz_token ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="tako_token" class="form-label">Tako Token</label>
            <input type="text" class="form-control" name="tako_token" value="{{ old('tako_token', $token->tako_token ?? '') }}">
        </div>

        @if(isset($token))
            <div class="mb-3">
                <label for="uuid" class="form-label">UUID</label>
                <input type="text" readonly class="form-control-plaintext" value="{{ $token->uuid }}">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">{{ isset($token) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endsection
