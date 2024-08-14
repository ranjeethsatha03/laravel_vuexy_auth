<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')->get()->keyBy('key');
        $settings = $settings->mapWithKeys(function ($item) {
            return [$item->key => $item->value];
        });

        $countries = DB::table('countries')->get();

        return view('settings.index', ['settings' => $settings, 'countries' => $countries]);    
    }

    public function update(Request $request)
    {
        $settings = $request->except('_token');
        if ($request->hasFile('system_logo')) {
            $file = $request->file('system_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $settings['system_logo'] = $filename;
        }
        foreach ($settings as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value]
            );
        }
        return response()->json(['success' => true, 'message' => 'Settings Updated Successfully.']);
    }
}
