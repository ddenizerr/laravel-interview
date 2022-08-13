<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    protected $table= 'notes';
    protected $primaryKey = 'id';

    public function certificate(): BelongsTo
    {
        return $this->belongsTo(Certificate::class, 'model_id','id');
    }
}
