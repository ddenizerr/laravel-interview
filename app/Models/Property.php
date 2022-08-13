<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PHPUnit\Framework\NoChildTestSuiteException;
use Prophecy\Exception\Doubler\MethodNotExtendableException;

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

    public function certificate(): HasMany
    {
        return $this->hasMany(Certificate::class, 'property_id','id');
    }

}
