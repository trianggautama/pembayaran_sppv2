<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'total_bayar',
        'metode',
        'bukti_pembayaran',
        'status',
        'catatan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tagihan()
    {
        return $this->belongsToMany(Tagihan::class, 'pembayaran_tagihan');
    }

    public function labelMetode()
    {
        return match ($this->metode) {
            'transfer_bank' => 'Transfer Bank',
            'qris' => 'QRIS',
            'e_wallet' => 'E-Wallet',
            default => '-',
        };
    }
}
