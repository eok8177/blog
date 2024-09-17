<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogPageController extends Controller
{
    public function index(Request $request)
    {
        $pages = BlogPage::orderBy('id', 'desc')->paginate($request->input('paginate', 20));
        return view('admin.blog-page.index', [
            'pages' => $pages
        ]);
    }

    public function store(Request $request, BlogPage $blog_page)
    {
        $this->validate($request, [
            'title_ua' => 'required',
        ]);
        $blog_page = $blog_page->create($request->all());

        return redirect()->route('admin.blog-page.edit', ['blog_page' => $blog_page->id])->with('success', __('Created'));
    }

    public function edit(BlogPage $blog_page)
    {
        return view('admin.blog-page.edit', [
            'page' => $blog_page,
            'categories' => \App\Models\BlogCategory::where('show', true)->get()
        ]);
    }

    public function update(Request $request, BlogPage $blog_page)
    {
        $this->validate($request, [
            'title_ua' => 'required',
        ]);
        $blog_page->update($request->all());

        $blog_page->categories()->sync($request->category_ids ?? []);

        return redirect()->route('admin.blog-page.index')->with('success', __('Updated'));
    }

    public function destroy(BlogPage $blog_page)
    {
        $blog_page->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
