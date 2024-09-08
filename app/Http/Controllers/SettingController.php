<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class settingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Setting $setting)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Setting $setting)
{
    $validated = $request->validate([
        'name' => 'required|string|max:25',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:2048', 
    ]);

    if ($request->hasFile('logo')) {
        if ($setting->logo && Storage::exists('public/' . $setting->logo)) {
            Storage::delete('public/' . $setting->logo); 
        }
        $validated['logo'] = $request->file('logo')->store('settings', 'public');
    }

    if ($request->hasFile('favicon')) {
        if ($setting->favicon && Storage::exists('public/' . $setting->favicon)) {
            Storage::delete('public/' . $setting->favicon); 
        }
        $validated['favicon'] = $request->file('favicon')->store('settings', 'public');
    }

    $setting->update($validated);

    return redirect()->route('settings.index')->with('success', 'Settings updated successfully');
}

    
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
