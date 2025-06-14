<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'order_code',
        'layanan_id',
        'nama',
        'email',
        'telepon',
        'perusahaan',
        'pesan',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the layanan that owns the request.
     */
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-warning text-dark',
            'requested' => 'bg-info text-white',
            'approved' => 'bg-success text-white',
            'rejected' => 'bg-danger text-white'
        ];
        
        return $badges[$this->status] ?? 'bg-secondary text-white';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'pending' => 'Menunggu',
            'requested' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak'
        ];
        
        return $texts[$this->status] ?? 'Unknown';
    }

    /**
     * Generate unique order code
     */
    public static function generateOrderCode()
    {
        do {
            $code = 'ORD' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 7));
        } while (self::where('order_code', $code)->exists());
        
        return $code;
    }

    /**
     * Boot method to auto-generate order code
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($request) {
            if (empty($request->order_code)) {
                $request->order_code = self::generateOrderCode();
            }
        });
    }
}
