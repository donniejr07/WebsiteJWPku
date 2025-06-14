@extends('user.layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Solusi Website Terbaik untuk Bisnis Anda</h1>
                <p class="lead mb-4">Kami menyediakan layanan pembuatan website profesional, modern, dan responsif untuk membantu mengembangkan bisnis Anda di era digital.</p>

            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('images/WebsiteJWPku.png') }}" alt="Website JWP KU" class="img-fluid" style="max-width: 400px;">
            </div>
        </div>
    </div>
</section>



<!-- Why Choose Us Section -->
<section class="py-5" style="background: white;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Mengapa Memilih Kami?</h2>
            <p class="text-muted">Keunggulan yang membuat kami berbeda dari yang lain</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="service-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Kualitas Terjamin</h5>
                    <p class="text-muted">Website berkualitas tinggi dengan standar profesional</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="service-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Pengerjaan Cepat</h5>
                    <p class="text-muted">Proses pengerjaan yang efisien dan tepat waktu</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="service-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Support 24/7</h5>
                    <p class="text-muted">Dukungan teknis yang siap membantu kapan saja</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="service-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Responsive Design</h5>
                    <p class="text-muted">Website yang optimal di semua perangkat</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection