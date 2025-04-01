<?php

namespace Modules\Articles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Articles\Models\Article;
use Modules\Articles\Models\Category;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('articles::pages.index');
    }

    public function create()
    {
        return view('articles::pages.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255', 'unique:articles,title'],
            'content' => ['required', 'string'],
            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'exists:categories,id'],
            'publication' => ['nullable'],
        ]);

        try {
            $article = Article::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'publication' => $validated['publication'] ?? false,

            ]);

            $article->categories()->attach($validated['categories']);
            $article->author()->associate(auth()->user());

            return redirect(route('articles.index'))->with('success', 'Artikel is aangemaakt!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        return view('articles::show');
    }

    public function edit($id)
    {
        return view('articles::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
