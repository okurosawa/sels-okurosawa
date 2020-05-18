<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function add()
    {
        return view('admin.category.add');
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        $created_category = Category::create([
            'title'        => $validated['title'],
            'description'  => $validated['description']
        ]);

        return redirect('/admin/home')->with('my_status', __('Create category is succeeded!'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->update([
            'title' => $validated['title'],
            'description'  => $validated['description']
        ]);

        return redirect('/admin/home')->with('my_status', __('Edit category is succeeded!'));
    }

    public function delete(Category $category)
    {
        $category->delete();

        return redirect('/admin/home')->with('my_status', __('Delete category is succeeded!'));
    }
}
