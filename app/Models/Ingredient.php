<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * App\Models\Ingredient
 *
 * @property Image|null image
 * @property Collection plats
 */
class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'is_allergen'];

    /**
     * @return BelongsToMany
     */
    public function plats()
    {
        return $this->belongsToMany(Plat::class);
    }

    /**
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'model_id', 'id')->where('model_class', Ingredient::class);
    }
}
