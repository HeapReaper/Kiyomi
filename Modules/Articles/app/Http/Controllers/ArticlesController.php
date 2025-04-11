<?php

namespace Modules\Articles\Http\Controllers;

use App\Http\Controllers\Controller;
use DOMDocument;
use Illuminate\Http\Request;
use Modules\Articles\Models\Article;
use Modules\Articles\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Cache::rememberForever('articles', function () {
            return Article::with('categories', 'author')
                ->orderBy('created_at', 'desc')
                ->get();
        });

        return view('articles::articles.index', [
            'articles' => $articles,
        ]);
    }

    public function publicIndex()
    {
        $articles = Cache::rememberForever('articles', function () {
            return Article::with('categories', 'author')
                ->orderBy('created_at', 'desc')
                ->where('published', 1)
                ->get();
        });

        return view('articles::public.index', [
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        return view('articles::articles.create', [
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
            $dom = new DOMDocument();
            @$dom->loadHTML($validated['content']);
            $images = $dom->getElementsByTagName('img');

            if ($images->length > 0) {
                $imageSrc = $images->item(0)->getAttribute('src');
            } else {
                $imageSrc = null;
            }

            $article = Article::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'image' => $imageSrc,
                'published' => isset($validated['publication']),
            ]);

            $article->categories()->attach($validated['categories']);
            $article->author()->associate(auth()->user());
            $article->save();

            Cache::forget('articles');

            return redirect(route('articles.index'))->with('success', 'Artikel is aangemaakt!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        return view('articles::show');
    }

    public function publicShow($slug)
    {
        $article = Cache::remember('article_slug_' . $slug, now()->addHours(12), function () use ($slug) {
            return Article::with('categories', 'author')
                ->where('slug', $slug)
                ->where('published', true)
                ->firstOrFail();
        });

        return view('articles::public.show', [
            'article' => $article,
        ]);
    }

    public function edit(int $id)
    {
        return view('articles::articles.edit', [
            'article' => Article::with('categories', 'author')->findOrFail($id),
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required', 'string'],
            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'exists:categories,id'],
            'publication' => ['nullable'],
        ]);

        try {
            $article = Article::find($id);

            $article->update([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'published' => isset($validated['publication']),
            ]);

            $article->categories()->detach();
            $article->categories()->attach($validated['categories']);

            $article->save();

            Cache::forget('articles');
            Cache::forget('article_slug_' . $article->slug);

            return redirect(route('articles.index'))->with('success', 'Artikel is aangepast!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function destroy(int $id)
    {
        try {
            $article = Article::with('categories', 'author')->findOrFail($id);
            $article->categories()->detach();
            $article->delete();

            return redirect(route('articles.index'))->with('success', 'Artikel is verwijderd!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


    }
}
