<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(12);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'CategoryName' => ['required', 'string', 'max:255', 'unique:categories,CategoryName'],
            'Description' => ['nullable', 'string'],
        ]);

        // Remove CategoryStatus - don't set it
        // $data['CategoryStatus'] = 1;

        $category = Category::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully.',
                'category' => [
                    'CategoryID' => $category->CategoryID,
                    'CategoryName' => $category->CategoryName,
                ],
            ]);
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'CategoryName' => ['required', 'string', 'max:255', 'unique:categories,CategoryName,' . $category->CategoryID . ',CategoryID'],
            'Description' => ['nullable', 'string'],
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
