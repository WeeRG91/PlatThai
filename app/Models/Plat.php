<?php

namespace App\Models;

use App\Enums\SpicyLevelType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany(Ingredient::class);
    }


    /**
     * ATTRIBUTES
     */

    public function getIconsAttribute()
    {
        return SpicyLevelType::getIcons($this->spicy_level);
    }


}
