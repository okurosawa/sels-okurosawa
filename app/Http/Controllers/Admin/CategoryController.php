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

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $validated = $request->validated();
        Category::where('id', $id)
            ->update([
                'title' => $validated['title'],
                'description'  => $validated['description']
            ]);

        return redirect('/admin/home')->with('my_status', __('Edit category is succeeded!'));
    }

    public function delete($id)
    {
        Category::destroy($id);

        return redirect('/admin/home')->with('my_status', __('Delete category is succeeded!'));
    }
}
