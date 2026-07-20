<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\ResourcePage;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::published()->latest('published_at')->latest('id');

        // Filter by tag if provided
        $activeTag = $request->filled('tag') ? $request->input('tag') : null;
        if ($activeTag) {
            $query->whereJsonContains('tag_links', ['label' => $activeTag]);
        }

        // Preserve ?tag= across pagination links so filtering survives paging.
        $articles = $query->paginate(12)->withQueryString();
        $krousarThmeyPage = ResourcePage::active()->where('slug', 'krousar-thmey')->first();
        $topicPagesByTitle = $this->topicPagesByTitle();

        return view('news', compact('articles', 'krousarThmeyPage', 'activeTag', 'topicPagesByTitle'));
    }

    public function show($slug)
    {
        $article = News::where('slug', $slug)->published()->firstOrFail();
        $krousarThmeyPage = ResourcePage::active()->where('slug', 'krousar-thmey')->first();
        $topicPagesByTitle = $this->topicPagesByTitle();

        return view('news.show', compact('article', 'krousarThmeyPage', 'topicPagesByTitle'));
    }

    /**
     * Tags saved without a URL (e.g. free-typed in the admin form) still need
     * somewhere to go when a visitor clicks them. Match by label against the
     * existing Topic pages so they land on the same page a properly-linked
     * tag with that label would.
     */
    private function topicPagesByTitle()
    {
        return ResourcePage::active()->get(['title', 'slug'])->keyBy(fn ($page) => strtolower($page->title));
    }
}
