@extends('admin.layouts.app')

@section('title', 'Detail Katalog Website')

@section('content')
<style>
    .detail-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .detail-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        padding: 30px;
        margin-bottom: 25px;
    }
    
    .detail-image {
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        max-width: 100%;
        height: auto;
    }
    
    .category-badge {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 500;
        display: inline-block;
    }
    
    .price-tag {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        padding: 12px 20px;
        border-radius: 25px;
        font-size: 1.2em;
        font-weight: bold;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }
    
    .info-item {
        border-bottom: 1px solid #f1f3f4;
        padding: 15px 0;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 5px;
    }
    
    .info-value {
        color: #6c757d;
        line-height: 1.6;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .btn-custom {
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-edit {
        background: linear-gradient(45deg, #ffc107, #fd7e14);
        color: white;
    }
    
    .btn-edit:hover {
        background: linear-gradient(45deg, #e0a800, #e8590c);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
    }
    
    .btn-back {
        background: linear-gradient(45deg, #6c757d, #495057);
        color: white;
    }
    
    .btn-back:hover {
        background: linear-gradient(45deg, #5a6268, #3d4142);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
    }
    
    .btn-delete {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
    }
    
    .btn-delete:hover {
        background: linear-gradient(45deg, #c82333, #a71e2a);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
    }
</style>

<div class="detail-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-2">Detail Katalog Website</h1>
        </div>
        <div class="action-buttons">
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-custom btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="detail-card">
            <div class="row">
                <div class="col-md-6">
                    @if($layanan->gambar)
                        <img src="{{ asset('storage/' . $layanan->gambar) }}" 
                             alt="{{ $layanan->nama_layanan }}" 
                             class="detail-image">
                    @else
                        <div class="d-flex align-items-center justify-content-center detail-image" 
                             style="height: 300px; background: #f8f9fa; border: 2px dashed #dee2e6;">
                            <div class="text-center">
                                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada gambar</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-globe"></i> Nama Katalog Website
                        </div>
                        <div class="info-value">
                            <h4 class="fw-bold text-primary">{{ $layanan->nama_layanan }}</h4>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-tags"></i> Kategori
                        </div>
                        <div class="info-value">
                            <span class="category-badge">{{ $layanan->kategori }}</span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-money-bill-wave"></i> Harga
                        </div>
                        <div class="info-value">
                            <span class="price-tag">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar-alt"></i> Tanggal Dibuat
                        </div>
                        <div class="info-value">
                            {{ $layanan->created_at->format('d F Y, H:i') }} WIB
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-clock"></i> Terakhir Diupdate
                        </div>
                        <div class="info-value">
                            {{ $layanan->updated_at->format('d F Y, H:i') }} WIB
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="detail-card">
            <h5 class="mb-3">
                <i class="fas fa-align-left"></i> Deskripsi
            </h5>
            <div class="info-value">
                {{ $layanan->deskripsi }}
            </div>
        </div>
        
        <div class="detail-card">
            <h5 class="mb-3">
                <i class="fas fa-cogs"></i> Aksi
            </h5>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.layanan.edit', $layanan->id) }}" 
                   class="btn btn-custom btn-edit">
                    <i class="fas fa-edit"></i> Edit Katalog
                </a>
                <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" 
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-custom btn-delete w-100"
                            onclick="return confirm('Yakin ingin menghapus katalog website ini?')">
                        <i class="fas fa-trash"></i> Hapus Katalog
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection