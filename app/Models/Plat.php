<?php

namespace App\Models;

use App\Enums\SpicyLevelType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property Collection asIngredientsAsReactSelectArray
 */
class Plat extends Model
{
    use HasFactory;

    //protected $table = 'plats';
    //protected $primaryKey = 'id_plat';

    protected $fillable=['titre', 'titre_thai', 'description', 'spicy_level'];


    /**
     * RELATIONS
     */

    public function images()
    {
        return $this->hasMany(Image::class, 'model_id', 'id')->where('model_class', Plat::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'plat_ingredient');
    }


    /**
     * ATTRIBUTES
     */

    public function getIconsAttribute()
    {
        return SpicyLevelType::getIcons($this->spicy_level);
    }

    public function asIngredientsAsReactSelectArray()
    {
        $result = [];
        foreach ($this->ingredients()->orderBy('name')->get() as $key => $ingredient) {
            $src = $ingredient->image ? '/storage/'.$ingredient->image->path : null;
            $result[] = [
                'value' => $ingredient->id,
                'label' => $src ? '<img src="'.$src.'" class="img-label me-2">' .$ingredient->name : $ingredient->name,
            ];
        }
        return $result;
        //return $this->ingredients()->orderBy('name')->selectRaw('id as value, name as label')->get();
    }


}
