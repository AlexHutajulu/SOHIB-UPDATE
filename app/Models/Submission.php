<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $table = 'submissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik', 'name', 'address', 'phone', 'email', 'budget', 'application_letter', 'documentation',
        'email', 'land_certificate', 'management_letter', 'notaris', 'npwp', 'domicile_letter', 'ibadah', 'tanah', 'rab', 'status',
        'information',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function map()
    {
        return $this->hasOne(Map::class);
    }

    public function surat_kelurahan()
    {
        return $this->hasOne(surat_kelurahan::class);
    }

    public function suratpimpinan()
    {
        return $this->hasOne(suratpimpinan::class);
    }

    public function tanggalpengajuan()
    {
        return $this->hasOne(tanggalpengajuan::class);
    }

    public function otorisasi()
    {
        return $this->hasOne(otorisasi::class);
    }

    public function berita_acara()
    {
        return $this->hasOne(berita_acara::class);
    }

    public function bank()
    {
        return $this->hasOne(bank::class);
    }

    public function kelurahan()
    {
        return $this->hasOne(kelurahan::class);
    }
}
