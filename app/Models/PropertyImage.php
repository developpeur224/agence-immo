<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $property_id
 * @property string $path
 * @property string $thumbnail_path
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Property $property
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereThumbnailPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'path', 'thumbnail_path', 'order'];
    
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
