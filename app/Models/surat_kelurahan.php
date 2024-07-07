<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat_kelurahan extends Model
{
    use HasFactory;

    protected $table = 'surat_kelurahan';

    protected $fillable = ['submission_id', 'file_kelurahan'];

    // Relasi dengan model Submission
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
