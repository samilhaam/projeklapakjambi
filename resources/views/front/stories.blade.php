@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Cerita UMKM</h4>

    @foreach ($stories as $story)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <strong class="h5 d-block">{{ $story->title }}</strong>
                <p class="text-muted mb-0">{{ $story->excerpt }}</p>
            </div>
        </div>
    @endforeach

    @if ($stories->isEmpty())
        <div class="alert alert-info">
            Belum ada cerita UMKM yang tersedia.
        </div>
    @endif
</div>
@endsection
