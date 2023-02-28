<?php

namespace App\Console\Commands;

use App\Models\Image;
use App\Models\Ingredient;
use Illuminate\Console\Command;

class CorrectionPathImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'correction:image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (Image::all() as $image){
            if($image->model_class === Ingredient::class) {
                $str1 = substr($image->path, 0, 6);
                $str2 = substr($image->path, 6);
                /*
                $image->path = $str1 . 'ingedient/' . $str2;
                $image->save();
                */
                $image->update([
                    'path' => $str1 . 'ingredient/' . $str2
                ]);
            }
        }
    }
}
