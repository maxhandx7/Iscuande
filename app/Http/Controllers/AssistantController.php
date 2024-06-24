<?php

namespace App\Http\Controllers;

use App\Assistant;
use App\Http\Requests\StoreAssistantRequest;
use App\Http\Requests\UpdateAssistantRequest;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    public function index()
    {
        $this->authorize('admin-only');
        $assistant = Assistant::get();
        $assistant = Assistant::where('id', 1)->firstOrFail();
        
        $datosArrayPrinc = json_decode($assistant->principios, true);
        $datosArrayDir = json_decode($assistant->directivas, true);

        $principiosArray = [];
        foreach ($datosArrayPrinc as $elemento1) {
            $elementosSeparados1 = array_map('trim', explode(',', $elemento1));
            $principios = array_merge($principiosArray, $elementosSeparados1);
            $string = implode(',', $principios);
        }

        $directivasArray = [];
        foreach ($datosArrayDir as $elemento2) {
            $elementosSeparados2 = array_map('trim', explode(',', $elemento2));
            $directivas = array_merge($directivasArray, $elementosSeparados2);
            $string2 = implode(',', $directivas);
        }
        return view('admin.assistant.index', compact('assistant', 'string', 'string2'), ['principios' => $principios, 'directivas' => $directivas]);
    }


    public function update(Request $request, Assistant $assistant)
    {
        $this->authorize('admin-only');
        try {
            $datosJsonPrincipios = json_encode($request->principios);
            $datosJsonDirectivas = json_encode($request->directivas);

            $assistant->my_update($request, $datosJsonPrincipios, $datosJsonDirectivas);
            return redirect()->route('assistants.index')->with('success', 'Se ha guardado la configuración');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al guardar la configuración');
        }
    }
}
