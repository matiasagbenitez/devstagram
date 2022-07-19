<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Función que devuelve la vista para editar un perfil
    public function edit(User $user) {

        if ($user->id != auth()->user()->id) {
            return redirect()->route('posts.index', compact('user'));
        }

        return view('profile.edit', compact('user'));
    }

    // Actualizar información
    public function update(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id, 'email'],
        ]);

        if($request->image){
            $image = $request->file('image');
            $nombreImagen = Str::uuid().'.'.$image->extension();
            $imagenServidor = Image::make($image);
            $imagenServidor->fit(1000, 1000);
            $imagenPath = public_path('profiles').'/'.$nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->image = $nombreImagen ?? auth()->user()->image ?? null;
        $user->email = $request->email;
        $user->save();

        // Cambio de contraseña
        if ($request->password || $request->new_password) {
            $this->validate($request, [
                'password' => 'required|min:6',
                'new_password' => 'required|min:6'
            ]);

            if (Hash::check($request->password, $user->password)){
                $user->password = Hash::make($request->new_password);
                $user->save();
            } else {
                return back()->with('mensaje', 'The previous password does not match');
            }
        }

        // Redireccionar
        return redirect()->route('posts.index', $user->username);

    }

    public function followers(User $user)
    {
        $followers = $user->followers;

        return view('profile.followers', compact('user', 'followers'));
    }

    public function following(User $user)
    {
        $followings = $user->following;

        return view('profile.followings', compact('user', 'followings'));
    }



}
