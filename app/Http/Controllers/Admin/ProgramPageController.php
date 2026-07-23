<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramPageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramPageController extends Controller
{
    public function index()
    {
        $items = ProgramPageItem::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.program_pages.index', compact('items'));
    }

    public function create()
    {
        return view('admin.program_pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'              => 'required|string|max:255',
            'title_fr'           => 'nullable|string|max:255',
            'short_content'      => 'nullable|string',
            'short_content_fr'   => 'nullable|string',
            'objective'          => 'nullable|string',
            'objective_fr'       => 'nullable|string',
            'detail_content'     => 'nullable|string',
            'detail_content_fr'  => 'nullable|string',
            'activities'         => 'nullable|string',
            'activities_fr'      => 'nullable|string',
            'image'          => 'nullable|image|max:4096',
            'image_url'      => 'nullable|url|max:2048',
            'image_2'        => 'nullable|image|max:4096',
            'image_2_url'    => 'nullable|url|max:2048',
            'image_3'        => 'nullable|image|max:4096',
            'image_3_url'    => 'nullable|url|max:2048',
            'is_active'      => 'boolean',
            'sort_order'     => 'nullable|integer',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        // Handle 3 images
        foreach ([['field' => 'image', 'url' => 'image_url'], ['field' => 'image_2', 'url' => 'image_2_url'], ['field' => 'image_3', 'url' => 'image_3_url']] as $img) {
            $url = $request->input($img['url']);
            unset($data[$img['url']]);
            if ($request->hasFile($img['field'])) {
                $data[$img['field']] = $request->file($img['field'])->store('program_page_items', 'public');
            } elseif (!empty($url)) {
                $data[$img['field']] = $url;
            }
        }

        ProgramPageItem::create($data);
        return redirect()->route('admin.program-pages.index')->with('success', 'Item created successfully.');
    }

    public function show(ProgramPageItem $item)
    {
        return redirect()->route('program-page-items.show', $item->id);
    }

    public function edit(ProgramPageItem $item)
    {
        return view('admin.program_pages.edit', compact('item'));
    }

    public function update(Request $request, ProgramPageItem $item)
    {
        $data = $request->validate([
            'title'              => 'required|string|max:255',
            'title_fr'           => 'nullable|string|max:255',
            'short_content'      => 'nullable|string',
            'short_content_fr'   => 'nullable|string',
            'objective'          => 'nullable|string',
            'objective_fr'       => 'nullable|string',
            'detail_content'     => 'nullable|string',
            'detail_content_fr'  => 'nullable|string',
            'activities'         => 'nullable|string',
            'activities_fr'      => 'nullable|string',
            'image'          => 'nullable|image|max:4096',
            'image_url'      => 'nullable|url|max:2048',
            'image_2'        => 'nullable|image|max:4096',
            'image_2_url'    => 'nullable|url|max:2048',
            'image_3'        => 'nullable|image|max:4096',
            'image_3_url'    => 'nullable|url|max:2048',
            'is_active'      => 'boolean',
            'sort_order'     => 'nullable|integer',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        foreach ([['field' => 'image', 'url' => 'image_url'], ['field' => 'image_2', 'url' => 'image_2_url'], ['field' => 'image_3', 'url' => 'image_3_url']] as $img) {
            $field = $img['field'];
            $url   = $request->input($img['url']);
            $remove = $request->input('remove_' . $field);
            unset($data[$img['url']]);

            if ($remove) {
                if ($item->$field && !str_starts_with($item->$field, 'http')) Storage::disk('public')->delete($item->$field);
                $data[$field] = null;
            } elseif ($request->hasFile($field)) {
                if ($item->$field && !str_starts_with($item->$field, 'http')) Storage::disk('public')->delete($item->$field);
                $data[$field] = $request->file($field)->store('program_page_items', 'public');
            } elseif (!empty($url)) {
                if ($item->$field && !str_starts_with($item->$field, 'http')) Storage::disk('public')->delete($item->$field);
                $data[$field] = $url;
            } else {
                unset($data[$field]);
            }
        }

        $item->update($data);
        return redirect()->route('admin.program-pages.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(ProgramPageItem $item)
    {
        foreach (['image', 'image_2', 'image_3'] as $field) {
            if ($item->$field && !str_starts_with($item->$field, 'http')) Storage::disk('public')->delete($item->$field);
        }
        $item->delete();
        return redirect()->route('admin.program-pages.index')->with('success', 'Item deleted successfully.');
    }
}
