@extends('layouts.blog')

@section('content')
 <div class="text-center mb-5 position-relative" style="margin-top: 50px">
            <div class="d-inline-block" style="transform: rotate(-2deg);">
                <h1 class="display-4 fw-bold text-warning glitch" >
                    <i>Profil Tim</i>
                </h1>
            </div>
    <p class="lead text-muted mt-3 text-center" style="font-family: 'Comic Neue', cursive;">
                Kami adalah tim yang berfokus pada pengembangan blog ini, berbagi pengetahuan dan inspirasi lewat tulisan.
            </p>
</div>

<h2 class="text-center mb-4 fw-semibold" style="color: #e67e22;">Anggota Tim</h2>

<div class="container">
    <div class="row g-4 justify-content-center">
        @foreach($members as $member)
        <div class="col-md-8 col-lg-6">
            <div class="card d-flex flex-row shadow-sm border-light overflow-hidden rounded-4">
                <div class="bg-white p-3 d-flex align-items-center justify-content-center">
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=ed6009&color=fff&rounded=true&size=80"
                        class="img-fluid rounded-circle"
                        alt="{{ $member->name }}"
                        style="width: 80px; height: 80px;"
                    >
                </div>

                <div class="card-body d-flex flex-column justify-content-center py-3">
                    <h4 class="card-title mb-1 fw-bold" style="color: #ed6009;">{{ $member->name }}</h4>
                    <p class="card-text text-muted mb-1 fs-6">
                        <strong>{{ ucfirst($member->role) }}</strong>
                    </p>
                    <p class="card-text fst-italic text-secondary fs-6 mb-0">
                        {{ $member->email }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

<style>
    .glitch {
            animation: glitch 2s infinite;
        }
    @keyframes glitch {
            0% { text-shadow: 0 0 0 #fff; }
            2% { text-shadow: -1px -1px 0 #ff00ff, 1px 1px 0 #00ffff; }
            4% { text-shadow: 0 0 0 #fff; }
            100% { text-shadow: 0 0 0 #fff; }
        }
</style>