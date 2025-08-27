@extends('layouts.blog')

@section('content')
    <div class="container my-5" style="font-family: 'Poppins', sans-serif;">

        <!-- Header dengan gaya nyasar -->
        <div class="text-center mb-5 position-relative">
            <div class="d-inline-block" style="transform: rotate(-2deg);">
                <h1 class="display-4 fw-bold text-warning glitch" style="text-shadow: 3px 3px 0 #000;">
                    <i>Kursor Nyasar</i>
                </h1>
            </div>
            <p class="lead text-muted mt-3" style="font-family: 'Comic Neue', cursive;">
                Tempat kursor nyasar menulis cerita digital yang nyata.
            </p>
        </div>

        <!-- Carousel dengan gaya lebih hidup -->
        @if($posts->isNotEmpty())
            <div id="carouselExampleCaptions" class="carousel slide mb-5 shadow-lg" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($posts->take(3) as $index => $post)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}"
                                class="{{ $index === 0 ? 'active bg-warning' : 'bg-secondary' }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner rounded-4 overflow-hidden" style="height: 400px;">
                    @foreach($posts->take(3) as $index => $post)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-100">
                            <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                 class="d-block w-100 h-100"
                                 alt="{{ $post->title }}"
                                 style="object-fit: cover; filter: brightness(0.7);">
                            <div class="carousel-caption d-flex flex-column justify-content-center h-100 text-start p-4">
                                <div class="bg-black bg-opacity-50 p-3 rounded-3 backdrop-blur" style="max-width: 60%;">
                                    <h5 class="mb-2">
                                        <a href="{{ route('blog.show', $post->slug) }}"
                                           class="text-warning text-decoration-none fs-4">
                                            {{ Str::limit($post->title, 50) }}
                                        </a>
                                    </h5>
                                    <p class="mb-0 text-light small d-none d-md-block">
                                        {{ Str::limit(strip_tags($post->content), 100) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif

        <!-- Hero Post dengan animasi -->
        @if($posts->isNotEmpty())
            @php $hero = $posts->first(); @endphp
            <div class="row mb-5 g-0 align-items-center animate-fade-in">
                <div class="col-lg-7">
                    <div class="position-relative">
                        @if($hero->thumbnail)
                            <img src="{{ asset('storage/' . $hero->thumbnail) }}"
                                 class="img-fluid rounded-4 shadow-lg"
                                 style="width: 100%; height: 400px; object-fit: cover;"
                                 alt="{{ $hero->title }}">
                            <div class="position-absolute top-0 start-0 w-100 h-100 rounded-4"
                                 style="background: linear-gradient(45deg, rgba(255,100,100,0.1), rgba(100,100,255,0.1)); pointer-events: none;"></div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5 mt-4 mt-lg-0">
                    <h2 class="fw-bold text-warning" style="font-family: 'Space Grotesk', sans-serif;">
                        {{ $hero->title }}
                    </h2>
                    <p class="text-muted small">
                        <i class="bi bi-person"></i> {{ $hero->author->name }} |
                        <i class="bi bi-folder"></i> {{ $hero->category->name }} |
                        <i class="bi bi-clock"></i> {{ $hero->created_at->diffForHumans() }}
                    </p>
                    <p class="text-secondary">
                        {{ Str::limit(strip_tags($hero->content), 200) }}
                    </p>
                    <a href="{{ route('blog.show', $hero->slug) }}" class="btn btn-warning btn-lg px-4 rounded-pill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
                    <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                    </svg>Baca Sekarang</a>
                </div>
            </div>
        @endif

        <!-- Grid Artikel dengan tata letak zig-zag -->
        <h2 class="text-center mb-5 fw-bold" style="color: #ff6b35;">Cerita Lainnya</h2>

        <div class="row g-4">
            @forelse($posts->skip(1) as $index => $post)
                <div class="col-md-6 col-lg-4 animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="card border-0 shadow-sm h-100 hover-lift" style="border-radius: 16px; overflow: hidden;">
                        @if($post->thumbnail)
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                     class="card-img-top"
                                     alt="{{ $post->title }}"
                                     style="height: 180px; object-fit: cover; transition: transform 0.5s;">
                                <div class="position-absolute top-2 start-2">
                                    <span class="badge bg-warning text-dark px-2 py-1">{{ $post->category->name }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-semibold mb-1">
                                <a href="{{ route('blog.show', $post->slug) }}"
                                   class="text-dark text-decoration-none">
                                    {{ Str::limit($post->title, 50) }}
                                </a>
                            </h6>
                            <p class="text-muted small mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                                {{ $post->author->name }} · {{ $post->created_at->format('d M') }}
                            </p>
                            <p class="card-text text-secondary flex-grow-1 small">
                                {{ Str::limit(strip_tags($post->content), 90) }}
                            </p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-warning btn-sm mt-2 rounded-pill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                                </svg> Baca
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mouse-fill" viewBox="0 0 16 16">
                    <path d="M3 5a5 5 0 0 1 10 0v6a5 5 0 0 1-10 0zm5.5-1.5a.5.5 0 0 0-1 0v2a.5.5 0 0 0 1 0z"/>
                    </svg> Kursor nyasar... belum ada cerita di sini.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;600&family=Comic+Neue:wght@400;700&display=swap');

        body {
            background: #fdf6ec;
            color: #333;
        }

        .glitch {
            animation: glitch 2s infinite;
        }

        @keyframes glitch {
            0% { text-shadow: 0 0 0 #fff; }
            2% { text-shadow: -1px -1px 0 #ff00ff, 1px 1px 0 #00ffff; }
            4% { text-shadow: 0 0 0 #fff; }
            100% { text-shadow: 0 0 0 #fff; }
        }

        .hover-lift:hover img {
            transform: scale(1.05);
        }

        .backdrop-blur {
            backdrop-filter: blur(4px);
        }

        .animate-fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .animate-slide-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .badge {
            font-size: 0.7rem;
            transform: rotate(-5deg);
        }
    </style>

    <!-- Opsional: Tambahkan efek suara klik halus (jika ingin lebih playful) -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const links = document.querySelectorAll('a[href]');
            links.forEach(link => {
                link.addEventListener('click', () => {
                });
            });
        });
    </script>

@endsection