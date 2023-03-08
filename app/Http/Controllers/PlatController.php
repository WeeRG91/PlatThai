<?php

namespace App\Http\Controllers;

use App\Enums\SpicyLevelType;
use App\Http\Requests\StorePlatRequest;
use App\Http\Requests\UpdatePlatRequest;
use App\Models\Image;
use App\Models\Ingredient;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlatController extends Controller
{
    public function index()
    {

        /*$plats = Plat::all();
        return view('plat.index')->withPlats($plats);*/
        //dd(Plat::all());
        $plats = Plat::all();

        $plats->each->append('icons');
        /*
        $plats->each(fn($plat)=> $plat->append('icons'));

        $plats->each(function ($plat) {
            $plat->append('icons');
        });

        foreach ($plats as $plat) {
            $plat->append('icons');
        }
        */
        return view('admin.plat.index')->withPlats($plats);
    }

    public function create()
    {
        return view('admin.plat.create')
            ->withIngredients(Ingredient::asReactSelectArray())
            ->withSpicyLevelTypeReact(SpicyLevelType::asReactSelectArray());
    }

    public function store(StorePlatRequest $request)
    {
        /*
        $plat = new Plat();
        $plat->titre = $request->input('titre');
        $plat->titre_thai = $request->input('titre_thai');
        $plat->description = $request->input('description');
        $plat->save();
        dd($plat);
        */

        $plat = Plat::create([
            'titre' =>  $request->input('titre'),
            'titre_thai' =>  $request->input('titre_thai'),
            'description' =>  $request->input('description'),
            'price' =>  $request->input('price'),
            'spicy_level' =>  $request->input('spicy_level'),
        ]);

        $plat->ingredients()->sync($request->input('ingredients'));

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                //$path = $image->store('public/images/'.$plat->id);
                $path = Storage::disk('public')->putFile('images/plat/'.$plat->id, $image);

                Image::create([
                    'nom' =>  $image->getClientOriginalName(),
                    'path' => $path,
                    'model_id' => $plat->id,
                    'model_class' => Plat::class,
                ]);

            }
        }



        return redirect()->route('admin.plat.index');
    }

    public function edit($id)
    {
        //$plat = Plat::where('id', '=', $id)->first();
        //$plat = Plat::where('id', $id)->first();
        $plat = Plat::find($id);

        //$selectSpicyLevel = null;
        /*
        foreach (SpicyLevelType::asReactSelectArray() as $item) {
            if($item['value'] === $plat->spicy_level) {
                $selectSpicyLevel = $item;
            }
        }
    dd($selectSpicyLevel);
        */
        $selectedSpicyLevel = \Illuminate\Support\Arr::first(SpicyLevelType::asReactSelectArray(),fn($el, $key)=> $el['value'] === $plat->spicy_level);

        return view('admin.plat.edit')
            ->withIngredients(Ingredient::asReactSelectArray())
            ->withSelectedIngredients($plat->asIngredientsAsReactSelectArray())
            ->withSelectedSpicyLevel($selectedSpicyLevel)
            ->withSpicyLevelTypeReact(SpicyLevelType::asReactSelectArray())
            ->withPlat($plat);
    }

    public function update(UpdatePlatRequest $request)
    {
        //dd($request->input('ingredients');
        $plat = Plat::find($request->input('id'));

        $plat->update([
            'titre' =>  $request->input('titre'),
            'titre_thai' =>  $request->input('titre_thai'),
            'description' =>  $request->input('description'),
            'price' =>  $request->input('price'),
            'spicy_level' =>  $request->input('spicy_level'),
        ]);

        $plat->ingredients()->sync($request->input('ingredients'));



        /*

        Plat::where('id', $request->input('id'))->update([
            'titre' =>  $request->input('titre'),
            'titre_thai' =>  $request->input('titre_thai'),
            'description' =>  $request->input('description'),
        ]);
        */
        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                //$path = $image->store('public/images/'.$plat->id);
                $path = Storage::disk('public')->putFile('images/plat/'.$plat->id, $image);

                Image::create([
                    'nom' =>  $image->getClientOriginalName(),
                    'path' => $path,
                    'model_id' => $plat->id,
                    'model_class' => Plat::class,
                ]);

            }
        }
        return redirect()->route('admin.plat.index');
    }

    public function delete($id)
    {
        $plat = Plat::find($id);
        $plat->delete();
        return redirect()->route('plat.index');
    }
}
