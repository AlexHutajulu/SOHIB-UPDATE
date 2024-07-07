<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    protected $fillable = ['submission_id', 'latitude', 'longitude'];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
