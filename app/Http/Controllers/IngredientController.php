<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Ingredient;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //$ingredients = Ingredient::all();
        return view('admin.ingredient.index');
    }

    public function search(Request $request)
    {
        $ingredients = Ingredient::query()
            ->leftJoin('ingredients as i2', 'i2.id', '=', 'ingredients.replace_id');

        if($request->filled('searchTerm')) {
            $ingredients->where('name', 'like', '%'.$request->input('searchTerm').'%');
        }

        if($request->filled('descriptionTerm')) {
            $ingredients->where('description', 'like', '%'.$request->input('descriptionTerm').'%');
        }

        $ingredients->with('remplacement');
        $ingredients->with('image');


        $ingredients->orderBy($request->input('orderBy'),$request->input('direction') );
        $ingredients = $ingredients->selectRaw('ingredients.*, i2.name as `replace`')->get();

        return response()->json(['ingredients' => $ingredients]);
    }

    public function isAllergen(Request $request, Ingredient $ingredient)
    {
        $ingredient->update(['is_allergen' => !$ingredient->is_allergen]);
        return response()->json('ok');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.ingredient.create');
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

        return redirect()->route('admin.ingredient.index');
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
        //$selected = Ingredient::find($ingredient);
        $selectedIngredient = Arr::first(Ingredient::asReactSelectArray(), fn($el, $key)=>$el['value'] === $ingredient->replace_id);
        $ingredients = Ingredient::asReactSelectArray();
        return view('admin.ingredient.edit')
            ->with('selectedIngredient', $selectedIngredient)
            ->with('ingredients', $ingredients)
            ->withIngredient($ingredient);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        //$ingredient = Ingredient::find($id);
        $ingredient->update([
            'replace_id' => $request->input('replace_id'),
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
        return redirect()->route('admin.ingredient.index');
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

    public function toggleStock(Request $request, Ingredient $ingredient)
    {
        $ingredient->update(['stock' => !$ingredient->stock]);
        return response()->json('ok');
    }
}
