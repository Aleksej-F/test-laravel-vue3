<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'img',
        'title',
        'description',
        'facility_id',
        'num'

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function facility(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
