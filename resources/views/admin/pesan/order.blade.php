@extends('admin.layouts.app')
@section('title', 'Pesan Masuk')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pesan Masuk</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <span class="badge bg-info">{{ $requests->count() }} Total Request</span>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-body">
                @if($requests->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle rounded overflow-hidden">
                            <thead class="table-dark">
                                <tr>
                                    <th class="py-3"><i class="fas fa-user me-2"></i> Nama</th>
                                    <th class="py-3"><i class="fas fa-envelope me-2"></i> Email</th>
                                    <th class="py-3"><i class="fas fa-phone me-2"></i> Telepon</th>
                                    <th class="py-3"><i class="fas fa-cogs me-2"></i> Layanan</th>
                                    <th class="py-3"><i class="fas fa-calendar me-2"></i> Tanggal</th>
                                    <th class="py-3"><i class="fas fa-info-circle me-2"></i> Status</th>
                                    <th class="py-3 text-center" style="min-width: 140px;"><i class="fas fa-tools me-2"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $request)
                                <tr class="main-row" data-request-id="{{ $request->id }}">
                                    <td class="py-3">
                                        <div class="fw-bold text-dark">{{ $request->nama }}</div>
                                    </td>
                                    <td class="py-3">
                                        <small class="text-muted">{{ $request->email }}</small>
                                    </td>
                                    <td class="py-3">
                                        <small class="text-muted">{{ $request->telepon }}</small>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge bg-primary">{{ $request->layanan ? $request->layanan->nama_layanan : 'Layanan tidak ditemukan' }}</span>
                                    </td>
                                    <td class="py-3">
                                        <small class="text-muted">{{ $request->created_at->format('d/m/Y H:i') }}</small>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge rounded-pill {{ $request->status_badge }}">
                                            {{ $request->status_text }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <div class="btn-group-vertical btn-group-sm" role="group">
                                            <div class="btn-group mb-1" role="group">
                                                @if($request->status === 'pending' || $request->status === 'requested')
                                                    <form method="POST" action="{{ route('admin.pesan.updateStatus', $request->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="btn btn-success btn-sm me-1 rounded-pill" 
                                                                onclick="return confirm('Setujui request ini?')">
                                                            <i class="fas fa-check"></i> Setujui
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.pesan.updateStatus', $request->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill" 
                                                                onclick="return confirm('Tolak request ini?')">
                                                            <i class="fas fa-times"></i> Tolak
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge bg-success me-2">
                                                        <i class="fas fa-check-circle"></i> {{ $request->status_text }}
                                                    </span>
                                                    <form method="POST" action="{{ route('admin.pesan.destroy', $request->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" 
                                                                onclick="return confirm('Hapus pesan ini? Tindakan ini tidak dapat dibatalkan.')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <button class="btn btn-info btn-sm rounded-pill toggle-detail" data-request-id="{{ $request->id }}">
                                                <i class="fas fa-chevron-down"></i> Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Detail Row (Hidden by default) -->
                                <tr class="detail-row" id="detail-{{ $request->id }}" style="display: none;">
                                    <td colspan="7">
                                        <div class="detail-content p-4 bg-light border-start border-info border-4 mx-3 my-2 rounded-3 shadow-sm">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="text-info mb-3"><i class="fas fa-info-circle"></i> Informasi Kontak</h6>
                                                    <div class="mb-2"><strong>Nama:</strong> {{ $request->nama }}</div>
                                                    <div class="mb-2"><strong>Email:</strong> {{ $request->email }}</div>
                                                    <div class="mb-2"><strong>Telepon:</strong> {{ $request->telepon }}</div>
                                                    <div class="mb-2"><strong>Perusahaan:</strong> {{ $request->perusahaan }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="text-info mb-3"><i class="fas fa-cogs"></i> Detail Request</h6>
                                                    <div class="mb-2"><strong>Kode Pesanan:</strong> <span class="badge bg-secondary">{{ $request->order_code }}</span></div>
                                                    <div class="mb-2"><strong>Layanan:</strong> {{ $request->layanan ? $request->layanan->nama_layanan : 'Layanan tidak ditemukan' }}</div>
                                                    <div class="mb-2"><strong>Status:</strong> <span class="badge {{ $request->status_badge }}">{{ $request->status_text }}</span></div>
                                                    <div class="mb-2"><strong>Tanggal:</strong> {{ $request->created_at->format('d/m/Y H:i:s') }}</div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h6 class="text-info mb-2"><i class="fas fa-comment"></i> Pesan</h6>
                                                    <div class="p-3 bg-white border rounded-3">
                                                        {{ $request->pesan }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5 bg-light rounded-3 my-3">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Request</h5>
                        <p class="text-muted">Request dari user akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Toggle Detail -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-detail');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const requestId = this.getAttribute('data-request-id');
            const detailRow = document.getElementById('detail-' + requestId);
            const icon = this.querySelector('i');
            
            if (detailRow.style.display === 'none' || detailRow.style.display === '') {
                // Show detail
                detailRow.style.display = 'table-row';
                icon.className = 'fas fa-chevron-up';
                this.innerHTML = '<i class="fas fa-chevron-up"></i> Tutup';
                this.classList.remove('btn-info');
                this.classList.add('btn-warning');
            } else {
                // Hide detail
                detailRow.style.display = 'none';
                icon.className = 'fas fa-chevron-down';
                this.innerHTML = '<i class="fas fa-chevron-down"></i> Detail';
                this.classList.remove('btn-warning');
                this.classList.add('btn-info');
            }
        });
    });
});
</script>

<style>
.card {
    transition: all 0.3s ease;
}

.table {
    border-collapse: separate;
    border-spacing: 0;
}

.table thead th:first-child {
    border-top-left-radius: 0.5rem;
}

.table thead th:last-child {
    border-top-right-radius: 0.5rem;
}

.main-row:hover {
    background-color: #f0f7ff !important;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.detail-content {
    animation: slideDown 0.3s ease-out;
    border-radius: 0.5rem !important;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.toggle-detail {
    transition: all 0.3s ease;
}

.badge {
    padding: 0.5em 0.8em;
    font-weight: 500;
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>
@endsection