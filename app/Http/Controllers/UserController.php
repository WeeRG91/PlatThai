<?php

namespace App\Http\Controllers;

use App\Enums\Permissions\PermissionType;
use App\Enums\Permissions\PlatPermissionType;
use App\Http\Requests\StoreUserRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.utilisateur.index')->withUsers(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.utilisateur.create')
            ->withPermissionTypes(PermissionType::asFullArray())
            ->withPermissions(Permission::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
           'name' => $request->input('name'),
           'email' => $request->input('email'),
           'password' => Hash::make($request->input('password')),
        ]);

        if($request->hasFile('image')){
            $uploadedImage = $request->file('image');
            $path = Storage::disk('public')->putFile('images/user/'.$user->id, $uploadedImage);

            Image::create([
                'nom' =>  $uploadedImage->getClientOriginalName(),
                'path' => $path,
                'model_id' => $user->id,
                'model_class' => User::class,
            ]);
        }

        $user->permissions()->sync($request->input('permissions'));

        return redirect()->route('utilisateur.index');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
