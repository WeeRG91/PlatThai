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
        return $this->belongsToMany(Plat::class, 'plat_ingredient');
    }


    /**
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'model_id', 'id')->where('model_class', Ingredient::class);
    }

    public static function asReactSelectArray()
    {

        $result = [];
        foreach (static::query()->orderBy('name')->get() as $key => $ingredient) {
            $src = $ingredient->image ? '/storage/'.$ingredient->image->path : null;
            $result[] = [
                'value' => $ingredient->id,
                'label' => $src ? '<img src="'.$src.'" class="img-label me-2">' .$ingredient->name : $ingredient->name,
            ];
        }
//dd($result);
        return $result;

        //return static::query()->orderBy('name')->selectRaw('id as value, name as label')->get();
    }
}
