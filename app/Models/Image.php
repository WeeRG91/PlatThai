<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable=['model_id', 'model_class', 'nom', 'path'];

    public function plat()
    {
        return $this->hasOne(Plat::class, 'id', 'model_id')->where('model_class',Plat::class);
    }
}
