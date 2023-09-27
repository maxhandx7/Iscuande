<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


class SearchController extends Controller
{
    public function show(Request $request)
    {
        try {
            $query = $request->input('query');
            if ($query === null) {
                return redirect()->route('home')->with('error', 'Hora inicio no puede quedar vacia');
            }


            $apiUrl = env('OPEN_MEDICAL_API_URL');
            $response = Http::get("$apiUrl.$query");
            $xmlContent = $response->body();

            $xml = simplexml_load_string($xmlContent);
            $array = [];
            foreach ($xml->list->document as $key => $value) {
                foreach ($value as  $values) {
                    $array[] = $values;
                }
                
            }
            $xml = collect($array);
            if ($response->successful()) {
                return view('admin.search.results', compact('xml'));
            } else {
                return redirect()->back()->with('error', 'No se encontro resultado en la biblioteca');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'No se encontro resultado en la biblioteca');
        }
    }
}
