<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('ingredient.index')->withIngredients($ingredients);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('ingredient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $ingredient = Ingredient::create([
            'name' =>  $request->input('name'),
            'is_allergen' => $request->input('is_allergen') ?? 0,
            'description' =>  $request->input('description'),
        ]);

        if($request->hasFile('image')) {
            $uploadedImage = $request->file('image');
            $path = Storage::disk('public')->putFile('images/ingredient/'.$ingredient->id, $uploadedImage);

            Image::create([
                'nom' =>  $uploadedImage->getClientOriginalName(),
                'path' => $path,
                'model_id' => $ingredient->id,
                'model_class' => Ingredient::class,
            ]);
        }

        return redirect()->route('ingredient.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredient.edit')->withIngredient($ingredient);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        //$ingredient = Ingredient::find($id);
       // dd($ingredient);

        $ingredient->update([
            'name' =>  $request->input('name'),
            'description' =>  $request->input('description'),
            'is_allergen' =>  $request->input('is_allergen') ?? 0,
        ]);

        if($request->hasFile('image')) {

            $image = $ingredient->image;
            if($image){
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            $uploadedImage = $request->file('image');

            $path = Storage::disk('public')->putFile('images/ingredient/'.$ingredient->id, $uploadedImage);

            Image::create([
                'nom' =>  $uploadedImage->getClientOriginalName(),
                'path' => $path,
                'model_id' => $ingredient->id,
                'model_class' => Ingredient::class,
            ]);
        }
        return redirect()->route('ingredient.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
