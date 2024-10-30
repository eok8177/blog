<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::orderBy('id', 'desc');
        if($request->search) {
            $pages = $pages->where('title_ua', 'like', '%'.$request->search.'%')
            ->orWhere('title_en', 'like', '%'.$request->search.'%');
        }
        return view('admin.page.index', [
            'pages' => $pages->paginate($request->input('paginate', 20))
        ]);
    }

    public function store(Request $request, Page $page)
    {
        $this->validate($request, [
            'title_ua' => 'required',
        ]);
        $page = $page->create($request->all());

        return redirect()->route('admin.page.edit', ['page' => $page->id])->with('success', __('Created'));
    }

    public function edit(Page $page)
    {
        return view('admin.page.edit', [
            'page' => $page
        ]);
    }

    public function update(Request $request, Page $page)
    {
        $this->validate($request, [
            'title_ua' => 'required',
        ]);
        $page->update($request->all());

        return redirect()->route('admin.page.index')->with('success', __('Updated'));
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
