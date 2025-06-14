@extends('user.layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<!-- Page Header -->
<section class="hero-section">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-4">Hubungi Kami</h1>
            <p class="lead">Siap membantu mewujudkan website impian Anda. Konsultasi gratis!</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="main-content">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">Kirim Pesan Anda</h3>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                @if(session('order_code'))
                                    <div class="mt-3 p-3 bg-white rounded border">
                                        <h6 class="fw-bold mb-2">
                                            <i class="fas fa-ticket-alt text-primary me-2"></i>
                                            Kode Pesanan Anda:
                                        </h6>
                                        <div class="d-flex align-items-center">
                                            <code class="fs-5 fw-bold text-primary me-3" id="orderCode">{{ session('order_code') }}</code>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="copyOrderCode()">
                                                <i class="fas fa-copy me-1"></i> Salin
                                            </button>
                                        </div>
                                        <small class="text-muted d-block mt-2">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Simpan kode ini untuk mengecek status pesanan Anda di menu "Cek Pesanan"
                                        </small>
                                    </div>
                                @endif
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            
                            <!-- Service Selection (if from services page) -->
                            @if(request('service'))
                            <div class="mb-3">
                                <label for="layanan_id" class="form-label fw-bold">Layanan yang Diminati</label>
                                <select class="form-select @error('layanan_id') is-invalid @enderror" id="layanan_id" name="layanan_id">
                                    <option value="">Pilih Layanan</option>
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ request('service') == $service->id ? 'selected' : '' }}>
                                        {{ $service->nama_layanan }}{{ $service->nama_katalog ? ' - ' . $service->nama_katalog : '' }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('layanan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @else
                            <div class="mb-3">
                                <label for="layanan_id" class="form-label fw-bold">Layanan yang Diminati (Opsional)</label>
                                <select class="form-select @error('layanan_id') is-invalid @enderror" id="layanan_id" name="layanan_id">
                                    <option value="">Pilih Layanan</option>
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}">
                                        {{ $service->nama_layanan }}{{ $service->nama_katalog ? ' - ' . $service->nama_katalog : '' }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('layanan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @endif
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label fw-bold">Nama Lengkap *</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Email *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label fw-bold">Nomor Telepon *</label>
                                        <input type="tel" class="form-control @error('telepon') is-invalid @enderror" 
                                               id="telepon" name="telepon" value="{{ old('telepon') }}" required>
                                        @error('telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="perusahaan" class="form-label fw-bold">Nama Perusahaan (Opsional)</label>
                                        <input type="text" class="form-control @error('perusahaan') is-invalid @enderror" 
                                               id="perusahaan" name="perusahaan" value="{{ old('perusahaan') }}">
                                        @error('perusahaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="pesan" class="form-label fw-bold">Pesan / Kebutuhan Detail *</label>
                                <textarea class="form-control @error('pesan') is-invalid @enderror" 
                                          id="pesan" name="pesan" rows="5" required 
                                          placeholder="Ceritakan kebutuhan website Anda secara detail...">{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Informasi Kontak</h4>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="service-icon me-3" style="font-size: 1.5rem;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Alamat</h6>
                                    <p class="text-muted mb-0">Jakarta, Indonesia</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="service-icon me-3" style="font-size: 1.5rem;">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Telepon</h6>
                                    <p class="text-muted mb-0">+62 812-3456-7890</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="service-icon me-3" style="font-size: 1.5rem;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Email</h6>
                                    <p class="text-muted mb-0">info@websitejwpku.com</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <div class="service-icon me-3" style="font-size: 1.5rem;">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Jam Operasional</h6>
                                    <p class="text-muted mb-0">Senin - Jumat: 09:00 - 18:00</p>
                                    <p class="text-muted mb-0">Sabtu: 09:00 - 15:00</p>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h6 class="fw-bold mb-3">Mengapa Memilih Kami?</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <small>Konsultasi gratis</small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <small>Harga terjangkau</small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <small>Kualitas terjamin</small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <small>Support 24/7</small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <small>Garansi kepuasan</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function copyOrderCode() {
    const orderCode = document.getElementById('orderCode').textContent;
    navigator.clipboard.writeText(orderCode).then(function() {
        // Show success feedback
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin!';
        button.classList.remove('btn-outline-primary');
        button.classList.add('btn-success');
        
        setTimeout(function() {
            button.innerHTML = originalText;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-primary');
        }, 2000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
        alert('Gagal menyalin kode. Silakan salin secara manual.');
    });
}
</script>

@endsection