<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $surface
 * @property string $bedrooms
 * @property string $rooms
 * @property string $floor
 * @property int $price
 * @property string $city
 * @property string|null $postal_code
 * @property int $sold
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereSurface($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereUpdatedAt($value)
 * @property string|null $address
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereSold($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Option> $options
 * @property-read int|null $options_count
 * @property string|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereImage($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PropertyImage> $images
 * @property-read int|null $images_count
 * @mixin \Eloquent
 */
class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'surface',
        'bedrooms',
        'rooms',
        'floor',
        'price',
        'city',
        'address',
        'postal_code',
        'sold',
        'image',
    ];

    public function options():  BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

     public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
