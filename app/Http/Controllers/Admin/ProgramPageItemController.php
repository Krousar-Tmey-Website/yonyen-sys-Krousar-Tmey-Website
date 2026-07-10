<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramPageItem;
use App\Models\ProgramPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramPageItemController extends Controller
{
    public function index()
    {
        $items = ProgramPageItem::with('page')->latest()->get();
        $pages = ProgramPage::orderBy('title')->get();
        return view('admin.program_page_items.index', compact('items', 'pages'));
    }

    public function create()
    {
        $pages = ProgramPage::orderBy('title')->get();
        return view('admin.program_page_items.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'program_page_id' => 'nullable|exists:program_pages,id',
            'title'           => 'required|string|max:255',
            'short_content'   => 'nullable|string',
            'detail_content'  => 'nullable|string',
            'image'           => 'nullable|image|max:4096',
            'image_url'       => 'nullable|url|max:2048',
            'image_2'         => 'nullable|image|max:4096',
            'image_2_url'     => 'nullable|url|max:2048',
            'image_3'         => 'nullable|image|max:4096',
            'image_3_url'     => 'nullable|url|max:2048',
            'is_active'       => 'boolean',
            'sort_order'      => 'nullable|integer',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        // Handle images
        foreach ([1 => 'image', 2 => 'image_2', 3 => 'image_3'] as $n => $field) {
            $urlKey = $n === 1 ? 'image_url' : "image_{$n}_url";
            $url = $request->input($urlKey);
            unset($data[$urlKey]);

            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('program_page_items', 'public');
            } elseif (!empty($url)) {
                $data[$field] = $url;
            }
        }

        ProgramPageItem::create($data);
        return redirect()->route('admin.program-page-items.index')->with('success', 'Item created successfully.');
    }

    public function show(ProgramPageItem $programPageItem)
    {
        return redirect()->route('program-page-items.show', $programPageItem->id);
    }

    public function edit(ProgramPageItem $programPageItem)
    {
        $pages = ProgramPage::orderBy('title')->get();
        return view('admin.program_page_items.edit', compact('programPageItem', 'pages'));
    }

    public function update(Request $request, ProgramPageItem $programPageItem)
    {
        $data = $request->validate([
            'program_page_id' => 'nullable|exists:program_pages,id',
            'title'           => 'required|string|max:255',
            'short_content'   => 'nullable|string',
            'detail_content'  => 'nullable|string',
            'image'           => 'nullable|image|max:4096',
            'image_url'       => 'nullable|url|max:2048',
            'image_2'         => 'nullable|image|max:4096',
            'image_2_url'     => 'nullable|url|max:2048',
            'image_3'         => 'nullable|image|max:4096',
            'image_3_url'     => 'nullable|url|max:2048',
            'is_active'       => 'boolean',
            'sort_order'      => 'nullable|integer',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        // Handle images
        foreach ([1 => ['field' => 'image', 'url_key' => 'image_url'],
                  2 => ['field' => 'image_2', 'url_key' => 'image_2_url'],
                  3 => ['field' => 'image_3', 'url_key' => 'image_3_url']] as $info) {
            $field   = $info['field'];
            $urlKey  = $info['url_key'];
            $url     = $request->input($urlKey);
            unset($data[$urlKey]);

            if ($request->hasFile($field)) {
                if ($programPageItem->$field && !str_starts_with($programPageItem->$field, 'http')) {
                    Storage::disk('public')->delete($programPageItem->$field);
                }
                $data[$field] = $request->file($field)->store('program_page_items', 'public');
            } elseif (!empty($url)) {
                if ($programPageItem->$field && !str_starts_with($programPageItem->$field, 'http')) {
                    Storage::disk('public')->delete($programPageItem->$field);
                }
                $data[$field] = $url;
            } else {
                unset($data[$field]);
            }
        }

        $programPageItem->update($data);
        return redirect()->route('admin.program-page-items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(ProgramPageItem $programPageItem)
    {
        foreach (['image', 'image_2', 'image_3'] as $field) {
            if ($programPageItem->$field && !str_starts_with($programPageItem->$field, 'http')) {
                Storage::disk('public')->delete($programPageItem->$field);
            }
        }
        $programPageItem->delete();
        return redirect()->route('admin.program-page-items.index')->with('success', 'Item deleted successfully.');
    }
}
