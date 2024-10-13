<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.settings', [
            'settings' => Setting::all()
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->except(['_method','_token']);

        foreach ($data as $key => $value) {
            $item = Setting::where('key',$key)->firstOrNew();
            $item->value = $value;
            $item->save();
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated');
    }
}
