<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Modules\Articles\Models\Article;

class GenerateSiteMap extends Command
{
    protected $signature = 'generate:sitemap';

    protected $description = 'Generate a sitemap.';

    public function handle()
    {
        $this->info('Generating site map...');

        try {
            $sitemap = Sitemap::create();
            $sitemap->add(Url::create(route('home.index')));

            Article::where('published', 1)->each(function ($article) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('articles-public.show', $article->slug))
                        ->setLastModificationDate($article->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8)
                );
            });

            $sitemap->writeToFile(public_path('sitemap.xml'));

            $this->info('Sitemap created.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
