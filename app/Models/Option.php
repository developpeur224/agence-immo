<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Option extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
