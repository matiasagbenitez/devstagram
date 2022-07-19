<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Página principal de un perfil
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(8);

        return view('dashboard', compact('user', 'posts'));
    }

    // Devuelve la vista para crear un post
    public function create()
    {
        return view('posts.create');
    }

    // Almacena un nuevo post
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required|max:255',
            'description'   => 'required',
            'image'         => 'required'
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);

    }

    // Muestra detalles de un post
    public function show(User $user, Post $post,)
    {
        return view('posts.show', compact('post', 'user'));
    }

    // Elimina un post existente
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Delete image
        $imagenPath = public_path('uploads/' . $post->image);
        if (File::exists($imagenPath)) {
            unlink($imagenPath);
        };

        return redirect()->route('posts.index', auth()->user()->username);
    }

    // Devuelve la vista para editar un post
    public function edit(User $user, Post $post)
    {
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('posts.show', compact('user', 'post'));
        }

        return view('posts.edit', compact('post', 'user'));
    }

    // Actualiza la información de un post existente
    public function update(User $user, Post $post, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $post = Post::find($post->id);

        $post->title = $request->title;
        $post->description = $request->description;
        $post-> save();

        return redirect()->route('posts.show', compact('post', 'user'));
    }

}
