<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index(Request $request)
    {
        return view('user.categories.index');
    }


    // Show form to create a new category or sub-category
    public function create(Request $request)
    {
        $tab = $request->query('tab', 'category');
        // return $tab;
        // Get all categories to use as parent categories for sub-category
        $categories = Category::whereNull('parent_id')->pluck('name', 'id');
        return view('user.categories.create', compact('tab','categories'));
    }

    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->pluck('name', 'id');
        return view('user.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ]);
            return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update category.');
        }
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
