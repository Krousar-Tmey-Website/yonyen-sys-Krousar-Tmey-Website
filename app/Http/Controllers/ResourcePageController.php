<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\ResourcePage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ResourcePageController extends Controller
{
    public function index()
    {
        $allArticles = News::published()->get();

        $pages = ResourcePage::active()->get()->map(function (ResourcePage $page) use ($allArticles) {
            $page->article_count = $this->matchingArticles($page, $allArticles)->count();
            return $page;
        });

        return view('resource-pages.index', compact('pages'));
    }

    public function show(string $slug)
    {
        $page = ResourcePage::active()->where('slug', $slug)->firstOrFail();
        $relatedArticles = $this->relatedArticles($page);

        return view('resource-pages.show', compact('page', 'relatedArticles'));
    }

    /**
     * Every article is bylined "by Krousar Thmey", so that page shows all
     * published articles. Every other page shows only articles tagged with
     * its title (tags now point back at the matching resource page).
     */
    private function matchingArticles(ResourcePage $page, $allArticles)
    {
        if ($page->slug === 'krousar-thmey') {
            return $allArticles;
        }

        $title = strtolower($page->title);

        return $allArticles->filter(
            fn (News $article) => collect($article->tag_links)
                ->pluck('label')
                ->contains(fn ($label) => strtolower($label) === $title)
        )->values();
    }

    /**
     * The "Krousar Thmey" catch-all page paginates 5 per page; every other
     * topic page paginates 6 per page (with Newer/Older Entries paging).
     */
    private function relatedArticles(ResourcePage $page)
    {
        if ($page->slug === 'krousar-thmey') {
            return News::published()->latest('published_at')->latest('id')->paginate(5);
        }

        $matching = $this->matchingArticles($page, News::published()->latest('published_at')->get());

        $perPage = 6;
        $currentPage = Paginator::resolveCurrentPage('page');

        return new LengthAwarePaginator(
            $matching->forPage($currentPage, $perPage)->values(),
            $matching->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath(), 'query' => request()->query()]
        );
    }
}
