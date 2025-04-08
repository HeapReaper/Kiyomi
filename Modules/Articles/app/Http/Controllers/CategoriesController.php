<?php

namespace Modules\Articles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Articles\Models\Article;
use Modules\Articles\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('articles::categories.index', [
            'categories' => Category::orderBy('name', 'asc')->get()
        ]);
    }

    public function create()
    {
        return view('articles::create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255', 'unique:categories,name'],
            'slug' => ['required', 'max:255', 'unique:categories,slug'],
        ]);

        try {
            Category::create([
                'name' => $validated['name'],
                'slug' => $validated['slug'],
            ]);

            return redirect()->back()->with('success', 'Categorie is aangemaakt!');
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

    public function destroy(int $id)
    {
        try {
            Category::find($id)->delete();

            return redirect()->back()->with('success', 'Categorie is verwijderd!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
