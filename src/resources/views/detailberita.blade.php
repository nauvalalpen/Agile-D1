@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="container my-5 px-3 px-md-5">
    <h1 class="headline mb-2">{{ $berita->judul }}</h1>

    <p class="text-muted mb-4">{{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}</p>

    @if ($berita->foto)
    <div class="mb-4">
        <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}" class="img-fluid rounded-3" style="max-height: 480px; object-fit: cover; width: 100%;">
    </div>
    @endif

    <div class="content-text">
        {!! nl2br(e($berita->deskripsi)) !!}
    </div>
</div>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
        color: #1f2937; /* slate-800 */
    }

    .headline {
        font-size: 2.75rem;
        font-weight: 700;
        color: #0f172a; /* slate-900 */
        border-left: 6px solid #284574; /* blue-500 */
        padding-left: 15px;
        line-height: 1.2;
        letter-spacing: -0.5px;
    }

    .content-text {
        font-size: 1.15rem;
        line-height: 1.9;
        color: #374151; /* slate-700 */
    }

    @media (max-width: 768px) {
        .headline {
            font-size: 2rem;
        }

        .content-text {
            font-size: 1.05rem;
        }
    }
</style>
@endsection
