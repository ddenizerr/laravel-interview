<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $parent_property_id
 * @property $organisation
 * @property $property_type
 * @property $uprn
 * @property $address
 * @property $town
 * @property $postcode
 * @property $live
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * **/
class Property extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';
   // protected $fillable = ['parent_property_id', 'organisation', 'property_type', 'uprn', 'address', 'town', 'postcode', 'live'];
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'parent_property_id', 'id');
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'property_id', 'id');
    }

//    public function notes(){
//        $notes = collect();
//        foreach($this->certificates as $certificate) {
//            $notes = collection_push($certificate->notes)
//        }
//
//        return $notes;
//    }

}
