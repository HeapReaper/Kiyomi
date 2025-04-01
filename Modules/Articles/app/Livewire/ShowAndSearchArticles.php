<?php

namespace Modules\Articles\Livewire;

use Livewire\Component;
use Modules\Articles\Models\Article;

class ShowAndSearchArticles extends Component
{
    public string $articleSearch = '';

    public function render()
    {
        return view('articles::livewire.show-and-search-articles', [
            'articles' => Article::query()
                ->where(function ($query) {
                    $query->where('id', 'like', '%' . $this->articleSearch . '%')
                        ->orWhere('title', 'like', '%' . $this->articleSearch . '%')
                        ->orWhereHas('author', function ($query) {
                            $query->where('name', 'like', '%' . $this->articleSearch . '%');
                        });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }
}
