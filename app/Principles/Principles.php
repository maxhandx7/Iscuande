<?php

namespace App\Principles;

use App\Assistant;
use App\Models\User;
use Assistent\Sai\Src\Principles\Principles as SaiPrinciples;

class Principles extends SaiPrinciples
{
    public function __invoke()
    {
        $assistant = Assistant::get();
        $assistant = Assistant::where('id', 1)->firstOrFail();
        $datosArrayPrinc = json_decode($assistant->principios, true);

        $principiosArray = [];
        foreach ($datosArrayPrinc as $elemento1) {
            $elementosSeparados1 = array_map('trim', explode(',', $elemento1));
            $principios = array_merge($principiosArray, $elementosSeparados1);
        }
        return array_merge(
            [
                'Tu nombre es'.$assistant->nombre
            ],
            $principios,
        );
    }
}
