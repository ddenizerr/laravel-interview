<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';
    protected $primaryKey = 'id';

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'parent_property_id', 'id');
    }

    public function certification(): HasMany
    {
        return $this->hasMany(Certification::class, 'property_id','id');
    }

}
