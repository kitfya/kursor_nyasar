@extends('layouts.blog')

@section('content')
<div class="container my-5">
    <article class="card border-0 shadow-lg overflow-hidden">
        
        <div class="bg-gradient-to-r from-warning to-secondary text-white p-4 text-center">
            <a href="{{ route('blog.index') }}" class="text-white text-decoration-none fw-bold d-inline-block mb-3">
                ← Kembali ke Blog
            </a>
            <h1 class="display-5 fw-bold lh-1">{{ $post->title }}</h1>
        </div>

        <div class="px-4 py-3 bg-light border-bottom">
            <p class="text-muted small mb-0">
                Oleh 
                <a href="{{ route('team.index', $post->author->id) }}" class="text-decoration-none fw-semibold text-dark">
                    {{ $post->author->name }}
                </a> 
                di <span class="badge bg-purple text-white">{{ $post->category->name }}</span> | 
                <time>{{ $post->published_at?->format('d M Y') }}</time>
            </p>
        </div>

        @if($post->thumbnail)
            <div class="position-relative overflow-hidden">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                     alt="{{ $post->title }}" 
                     class="img-fluid w-100" 
                     style="max-height: 600px; object-fit: cover; transition: transform 0.5s ease;">
                <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.1); pointer-events: none;"></div>
            </div>
        @endif
        
        <div class="card-body px-4 py-5">
            <div class="blog-content" style="max-width: 800px; margin: 0 auto; font-size: 1.1rem; line-height: 1.9; color: #333;">
                @php
                    $paragraphs = preg_split('/\n\s*\n/', $post->content, -1, PREG_SPLIT_NO_EMPTY);
                @endphp

                @foreach($paragraphs as $index => $p)
                    <p class="mb-4" style="{{ $index === 0 ? 'font-size: 1.3rem; font-weight: 300; color: #444; font-style: italic;' : '' }}">
                        {!! nl2br(e($p)) !!}
                    </p>
                @endforeach
            </div>
        </div>

        <div class="bg-light px-4 py-5 border-top">
            <h4 class="mb-4 fw-bold" style="color: #333;">💬 Komentar</h4>

            
            <div class="mb-5 p-4 bg-white rounded shadow-sm border">
                <h5 class="mb-3">Tinggalkan Komentar</h5>

                <form action="{{ route('comments.store', $post) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="author_name" class="form-label">Nama Anda</label>
        <input type="text"
               name="author_name"
               id="author_name"
               class="form-control"
               value="{{ old('author_name') }}"
               required>
    </div>

    <div class="mb-3">
        <label for="author_email" class="form-label">Email (opsional)</label>
        <input type="email"
               name="author_email"
               id="author_email"
               class="form-control"
               value="{{ old('author_email') }}">
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Komentar Anda</label>
        <textarea name="content"
                  id="content"
                  rows="4"
                  class="form-control"
                  placeholder="Tulis komentar Anda..."
                  required>{{ old('content') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
</form>
            </div>

            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            @forelse($post->comments as $comment)
                <div class="p-3 rounded mb-3 bg-white shadow-sm border" style="animation: fadeIn 0.4s ease-out;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="text-dark">
                            {{ $comment->author_name ?? $comment->user?->name ?? 'Anonim' }}
                        </strong>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-0 text-dark" style="font-size: 0.98rem;">
                        {{ $comment->content }}
                    </p>
                </div>
            @empty
                <p class="text-muted fst-italic">Belum ada komentar. Jadilah yang pertama menyuarakan pendapatmu!</p>
            @endforelse
        </div>

    </article>
</div>

<style>
    :root {
        --primary: #ffbe6f;
        --secondary: #fe9939;
        --purple: #7b4dff;
    }

    .bg-gradient-to-r {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    .badge.bg-purple {
        background-color: var(--purple); 
        font-weight: 500;
    }

    .blog-content p {
        transition: color 0.3s ease;
    }

    .card:hover img {
        transform: scale(1.03);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    
    a.text-decoration-none:hover {
        color: var(--primary) !important;
        text-decoration: underline !important;
    }

    time {
        font-variant: small-caps;
    }
</style>

@endsection