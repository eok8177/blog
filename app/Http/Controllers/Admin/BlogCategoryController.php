<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::orderBy('id', 'desc')->paginate($request->input('paginate', 20));
        return view('admin.blog-category.index', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request, BlogCategory $blog_category)
    {
        $this->validate($request, [
            'title_ua' => 'required',
        ]);
        $blog_category = $blog_category->create($request->all());

        return redirect()->route('admin.blog-category.edit', ['blog_category' => $blog_category->id])->with('success', __('Created'));
    }

    public function edit(BlogCategory $blog_category)
    {
        return view('admin.blog-category.edit', [
            'category' => $blog_category
        ]);
    }

    public function update(Request $request, BlogCategory $blog_category)
    {
        $this->validate($request, [
            'title_ua' => 'required',
        ]);
        $blog_category->update($request->all());

        return redirect()->route('admin.blog-category.index')->with('success', __('Updated'));
    }

    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
