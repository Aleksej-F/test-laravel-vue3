<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'title',
        'h2',
        'urlImg',
        'urlVideo',
        'titleSlider',
        'address',
        'workPeriod',
        'materials'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function sliders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Slider::class, 'facility_id', 'id');
    }
}
