<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\ResourcePage;

class ResourcePageController extends Controller
{
    public function index()
    {
        $pages = ResourcePage::active()->get();
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
     * published articles, 5 per page (with Newer/Older Entries paging).
     * Every other page shows only articles tagged with its title (tags now
     * point back at the matching resource page).
     */
    private function relatedArticles(ResourcePage $page)
    {
        if ($page->slug === 'krousar-thmey') {
            return News::published()->latest('published_at')->latest('id')->paginate(5);
        }

        $title = strtolower($page->title);

        return News::published()->latest('published_at')->get()->filter(
            fn (News $article) => collect($article->tag_links)
                ->pluck('label')
                ->contains(fn ($label) => strtolower($label) === $title)
        )->values();
    }
}
