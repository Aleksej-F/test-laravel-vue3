<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'text',
        'smallText',
        'complite',
        'list_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function tasklist(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TaskList::class, 'list_id', 'id');
    }
}
