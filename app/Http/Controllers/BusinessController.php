<?php

namespace App\Http\Controllers;

use App\Business;
use App\Http\Requests\Business\UpdateRequest;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $this->authorize('admin-only');
        $business = Business::get();
        $business = Business::where('id', 1)->firstOrFail();
        return view('admin.business.index', compact('business'));
    }
    public function update(UpdateRequest $request, Business $business)
    {
        $this->authorize('admin-only');
        try {
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $image_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("/image"), $image_name);
            }
            if (isset($image_name)) {
                $business->update($request->all() + [
                    'logo' => $image_name,
                ]);
                return redirect()->route('business.index')->with('success', 'Se ha actualizado la empresa');
            }
            $business = Business::find(auth()->user()->id);
            
            $configurations = $business->configurations ?? [];
           
            if (!is_array($configurations)) {
                $configurations = [];
            }
            $validatedData = $request->validate([
                'facebook' => 'nullable',
                'thead' => 'nullable',
                'twitter' => 'nullable',
                'instagram' => 'nullable',
            ]);
            $configurations['show_letter'] = $request->input('show_letter', null);
            $configurations['thead'] = $validatedData['thead'] ? $validatedData['thead'] : null;
            $configurations['facebook'] = $validatedData['facebook'] ? $validatedData['facebook'] : null;
            $configurations['twitter'] = $validatedData['twitter'] ? $validatedData['twitter'] : null;
            $configurations['instagram'] = $validatedData['instagram'] ? $validatedData['instagram'] : null;
            $business->configurations = $configurations;
            $business->update($request->all());
            return redirect()->route('business.index')->with('success', 'Se ha actualizado la empresa');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la empresa');
        }
    }
}
