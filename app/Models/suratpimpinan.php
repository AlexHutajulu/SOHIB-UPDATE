<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suratpimpinan extends Model
{
    use HasFactory;

    protected $table = 'suratpimpinan';

    protected $fillable = ['submission_id', 'file_pimpinan'];

    // Relasi dengan model Submission
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
