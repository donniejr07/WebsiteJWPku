@extends('user.layouts.app')

@section('title', 'Layanan Kami')

@section('content')
<!-- Page Header -->
<section class="hero-section">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-4">Layanan Kami</h1>
            <p class="lead">Berbagai paket layanan website profesional untuk kebutuhan bisnis Anda</p>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="main-content">
    <div class="container">
        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="fw-bold">Pilih Layanan Terbaik</h3>
                <p class="text-muted">Temukan paket yang sesuai dengan kebutuhan bisnis Anda</p>
            </div>
        </div>
        
        <!-- Services Grid -->
        <div class="row g-4" id="servicesGrid">
            @forelse($services as $service)
            <div class="col-md-6 col-lg-4 service-item" data-name="{{ strtolower($service->nama) }}">
                <div class="service-card h-100">
                    <div class="service-icon">
                        <i class="fas fa-{{ $service->icon ?? 'globe' }}"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ $service->nama_layanan }}</h4>
                    @if($service->nama_katalog)
                        <p class="text-muted mb-4">{{ $service->nama_katalog }}</p>
                    @endif
                    
                    <!-- Features List -->
                    @if($service->fitur)
                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Fitur Termasuk:</h6>
                        <ul class="list-unstyled">
                            @foreach(explode(',', $service->fitur) as $fitur)
                            <li class="mb-1">
                                <i class="fas fa-check text-success me-2"></i>
                                <small>{{ trim($fitur) }}</small>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <!-- Price -->
                    <div class="mb-4">
                        <div class="text-center">
                            <span class="h3 text-primary fw-bold">Rp {{ number_format($service->harga, 0, ',', '.') }}</span>
                            @if($service->durasi)
                            <small class="text-muted d-block">{{ $service->durasi }}</small>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="mt-auto">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#serviceModal{{ $service->id }}">
                                <i class="fas fa-info-circle me-2"></i>Detail Layanan
                            </button>
                            <a href="{{ route('contact', ['service' => $service->id]) }}" class="btn btn-primary">
                                <i class="fas fa-shopping-cart me-2"></i>Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted mb-3">Belum Ada Layanan Tersedia</h3>
                    <p class="text-muted mb-4">Layanan akan segera hadir untuk memenuhi kebutuhan bisnis Anda</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami untuk Info Lebih Lanjut
                    </a>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- No Results Message -->
        <div class="row d-none" id="noResults">
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Tidak ada layanan yang ditemukan</h4>
                    <p class="text-muted">Coba gunakan kata kunci yang berbeda</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
@if($services->count() > 0)
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="text-center text-white">
            <h2 class="fw-bold mb-3">Siap Memulai Proyek Website Anda?</h2>
            <p class="lead mb-4">Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                <i class="fas fa-phone me-2"></i>Konsultasi Gratis
            </a>
        </div>
    </div>
</section>
@endif

<!-- Service Detail Modals -->
@foreach($services as $service)
<div class="modal fade" id="serviceModal{{ $service->id }}" tabindex="-1" aria-labelledby="serviceModalLabel{{ $service->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel{{ $service->id }}">{{ $service->nama_layanan }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($service->gambar)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $service->gambar) }}" alt="{{ $service->nama_layanan }}" class="img-fluid rounded" style="width: 100%; max-height: 300px; object-fit: cover;">
                </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="fw-bold mb-3">Deskripsi Layanan</h6>
                        <p class="text-muted mb-4">{{ $service->deskripsi }}</p>
                        
                        @if($service->nama_katalog)
                        <h6 class="fw-bold mb-3">Nama Katalog Website</h6>
                        <p class="text-muted mb-4">{{ $service->nama_katalog }}</p>
                        @endif
                        
                        @if($service->fitur)
                        <h6 class="fw-bold mb-3">Fitur yang Termasuk</h6>
                        <ul class="list-unstyled">
                            @foreach(explode(',', $service->fitur) as $fitur)
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                {{ trim($fitur) }}
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h6 class="fw-bold mb-3">Harga Paket</h6>
                                <div class="mb-3">
                                    <span class="h3 text-primary fw-bold">Rp {{ number_format($service->harga, 0, ',', '.') }}</span>
                                    @if($service->durasi)
                                    <small class="text-muted d-block">{{ $service->durasi }}</small>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <span class="badge bg-primary">{{ $service->kategori }}</span>
                                </div>
                                <a href="{{ route('contact', ['service' => $service->id]) }}" class="btn btn-primary w-100">
                                    <i class="fas fa-shopping-cart me-2"></i>Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection