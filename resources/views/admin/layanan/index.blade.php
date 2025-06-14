@extends('admin.layouts.app')

@section('title', 'Kelola Katalog Website')

@section('content')
<style>
    .catalog-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
        color: white;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .catalog-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .catalog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .search-filter-section {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
    }
    
    .table-modern {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .table-modern thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .table-modern thead th {
        border: none;
        padding: 15px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .table-modern tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
    }
    
    .table-modern tbody tr:hover {
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }
    
    .catalog-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .catalog-image:hover {
        transform: scale(1.1);
        border-color: #667eea;
    }
    
    .btn-action {
        margin: 2px;
        border-radius: 8px;
        padding: 8px 12px;
        transition: all 0.3s ease;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    
    .price-badge {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .category-badge {
        background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .no-data {
        text-align: center;
        padding: 50px;
        color: #6c757d;
    }
    
    .no-data i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }
    
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }
    
    .search-input {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .filter-select {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .filter-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    @media (max-width: 768px) {
        .catalog-header {
            text-align: center;
        }
        
        .catalog-header h1 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .table-responsive {
            border-radius: 15px;
        }
        
        .btn-action {
            padding: 6px 10px;
            font-size: 0.8rem;
        }
    }
</style>

<div class="catalog-header">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div>
            <h1 class="h2 mb-2">Kelola Katalog Website</h1>
        </div>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-light btn-lg">
            Tambah Katalog Website
        </a>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="search-filter-section">
    <div class="row">
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control search-input" 
                   placeholder="Cari nama katalog website..." id="searchInput">
        </div>
        <div class="col-md-3 mb-3">
            <select class="form-select filter-select" id="categoryFilter">
                <option value="">Semua Kategori</option>
                <option value="Portfolio">Portfolio</option>
                <option value="Landing Page">Landing Page</option>
                <option value="Company Profile">Company Profile</option>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <select class="form-select filter-select" id="priceFilter">
                <option value="">Semua Harga</option>
                <option value="low">< Rp 1.000.000</option>
                <option value="medium">Rp 1.000.000 - Rp 5.000.000</option>
                <option value="high">> Rp 5.000.000</option>
            </select>
        </div>
    </div>
</div>

<div class="catalog-card">
    <div class="table-responsive">
        <table class="table table-modern mb-0">
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag"></i> No</th>
                    <th><i class="fas fa-image"></i> Gambar</th>
                    <th><i class="fas fa-globe"></i> Nama Katalog Website</th>
                    <th><i class="fas fa-tags"></i> Kategori</th>
                    <th><i class="fas fa-money-bill-wave"></i> Harga</th>
                    <th><i class="fas fa-cogs"></i> Aksi</th>
                </tr>
            </thead>
            <tbody id="catalogTable">
                @forelse($layanan as $index => $item)
                <tr data-name="{{ strtolower($item->nama_layanan) }}" 
                    data-category="{{ $item->kategori }}" 
                    data-price="{{ $item->harga }}">
                    <td><span class="fw-bold text-primary">{{ $layanan->firstItem() + $index }}</span></td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                 alt="{{ $item->nama_layanan }}" 
                                 class="catalog-image"
                                 data-bs-toggle="tooltip" 
                                 title="{{ $item->nama_layanan }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px; background: #f8f9fa; border-radius: 10px; border: 2px dashed #dee2e6;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div>
                            <h6 class="mb-1 fw-bold">{{ $item->nama_layanan }}</h6>
                            <small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                        </div>
                    </td>
                    <td>
                        <span class="category-badge">{{ $item->kategori }}</span>
                    </td>
                    <td>
                        <span class="price-badge">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.layanan.show', $item->id) }}" 
                           class="btn btn-info btn-sm btn-action"
                           data-bs-toggle="tooltip" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="no-data">
                        <i class="fas fa-folder-open"></i>
                        <h5 class="mt-3">Belum Ada Data Katalog Website</h5>
                        <p class="text-muted">Mulai tambahkan katalog website pertama Anda</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($layanan->hasPages())
<div class="pagination-wrapper">
    {{ $layanan->links() }}
</div>
@endif

<script>
// Search and Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const priceFilter = document.getElementById('priceFilter');
    const tableRows = document.querySelectorAll('#catalogTable tr[data-name]');
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value;
        const selectedPriceRange = priceFilter.value;
        
        tableRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const category = row.getAttribute('data-category');
            const price = parseFloat(row.getAttribute('data-price'));
            
            let showRow = true;
            
            // Search filter
            if (searchTerm && !name.includes(searchTerm)) {
                showRow = false;
            }
            
            // Category filter
            if (selectedCategory && category !== selectedCategory) {
                showRow = false;
            }
            
            // Price filter
            if (selectedPriceRange) {
                switch(selectedPriceRange) {
                    case 'low':
                        if (price >= 1000000) showRow = false;
                        break;
                    case 'medium':
                        if (price < 1000000 || price > 5000000) showRow = false;
                        break;
                    case 'high':
                        if (price <= 5000000) showRow = false;
                        break;
                }
            }
            
            row.style.display = showRow ? '' : 'none';
        });
        
        // Check if any rows are visible
        const visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
        const noDataRow = document.querySelector('#catalogTable tr td[colspan="6"]');
        
        if (visibleRows.length === 0 && !noDataRow) {
            const tbody = document.getElementById('catalogTable');
            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = `
                <td colspan="6" class="no-data">
                    <i class="fas fa-search"></i>
                    <h5 class="mt-3">Tidak Ada Data yang Ditemukan</h5>
                    <p class="text-muted">Coba ubah kriteria pencarian Anda</p>
                </td>
            `;
            emptyRow.id = 'noResultsRow';
            tbody.appendChild(emptyRow);
        } else {
            const noResultsRow = document.getElementById('noResultsRow');
            if (noResultsRow) {
                noResultsRow.remove();
            }
        }
    }
    
    searchInput.addEventListener('input', filterTable);
    categoryFilter.addEventListener('change', filterTable);
    priceFilter.addEventListener('change', filterTable);
});
</script>
@endsection