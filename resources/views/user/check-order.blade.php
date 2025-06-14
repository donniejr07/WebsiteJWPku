@extends('user.layouts.app')

@section('title', 'Cek Pesanan')

@section('content')
<!-- Page Header -->
<section class="hero-section">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-4">Cek Status Pesanan</h1>
            <p class="lead">Masukkan kode pesanan Anda untuk melihat status pemesanan</p>
        </div>
    </div>
</section>

<!-- Check Order Section -->
<section class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="card-title text-center mb-4">
                            <i class="fas fa-search text-primary me-2"></i>
                            Cek Status Pesanan
                        </h4>
                        
                        <!-- Search Form -->
                        <form method="POST" action="{{ route('check.order.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="order_code" class="form-label">Kode Pesanan</label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="order_code" 
                                       name="order_code" 
                                       placeholder="Masukkan kode pesanan (contoh: ORDABCD123)"
                                       value="{{ $orderCode }}"
                                       required>
                                <div class="form-text">Kode pesanan diberikan setelah Anda mengirim permintaan layanan</div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-search me-2"></i>
                                Cek Status
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @if($order)
        <!-- Order Result -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-file-alt me-2"></i>
                            Detail Pesanan: {{ $order->order_code }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Pesanan</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold">Kode Pesanan:</td>
                                        <td>{{ $order->order_code }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tanggal Pesanan:</td>
                                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Layanan:</td>
                                        <td>{{ $order->layanan ? $order->layanan->nama_layanan : 'Konsultasi Umum' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Status:</td>
                                        <td>
                                            <span class="badge {{ $order->status_badge }}">
                                                {{ $order->status_text }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Kontak</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold">Nama:</td>
                                        <td>{{ $order->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Email:</td>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Telepon:</td>
                                        <td>{{ $order->telepon }}</td>
                                    </tr>
                                    @if($order->perusahaan)
                                    <tr>
                                        <td class="fw-bold">Perusahaan:</td>
                                        <td>{{ $order->perusahaan }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        
                        @if($order->pesan)
                        <div class="mt-3">
                            <h6 class="fw-bold">Pesan:</h6>
                            <div class="bg-light p-3 rounded">
                                {{ $order->pesan }}
                            </div>
                        </div>
                        @endif
                        
                        <!-- Status Information -->
                        <div class="mt-4 p-3 rounded" 
                             style="background-color: 
                             @if($order->status == 'pending') #fff3cd
                             @elseif($order->status == 'approved') #d1edff
                             @elseif($order->status == 'rejected') #f8d7da
                             @else #e2e3e5 @endif">
                            <h6 class="fw-bold mb-2">
                                @if($order->status == 'pending')
                                    <i class="fas fa-clock text-warning me-2"></i>Status: Menunggu Review
                                @elseif($order->status == 'approved')
                                    <i class="fas fa-check-circle text-success me-2"></i>Status: Disetujui
                                @elseif($order->status == 'rejected')
                                    <i class="fas fa-times-circle text-danger me-2"></i>Status: Ditolak
                                @endif
                            </h6>
                            <p class="mb-0">
                                @if($order->status == 'pending')
                                    Pesanan Anda sedang dalam proses review. Tim kami akan menghubungi Anda segera.
                                @elseif($order->status == 'approved')
                                    Selamat! Pesanan Anda telah disetujui. Tim kami akan segera menghubungi Anda untuk langkah selanjutnya.
                                @elseif($order->status == 'rejected')
                                    Maaf, pesanan Anda tidak dapat diproses saat ini. Silakan hubungi kami untuk informasi lebih lanjut.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($orderCode)
        <!-- No Order Found -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 col-lg-6">
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                    <h5>Pesanan Tidak Ditemukan</h5>
                    <p class="mb-0">Kode pesanan "{{ $orderCode }}" tidak ditemukan. Pastikan Anda memasukkan kode yang benar.</p>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Help Section -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="fas fa-question-circle text-info me-2"></i>
                            Butuh Bantuan?
                        </h5>
                        <p class="card-text">Jika Anda mengalami kesulitan atau memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection