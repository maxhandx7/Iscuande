<?php

namespace App\Directives\Methods;

use App\Assistant;
use Assistent\Directives\Implementations\DirectivesAnswers;

class GetFunctions implements DirectivesAnswers
{
    public function outPut($input)
    {
        $assistant = Assistant::get();
        $assistant = Assistant::where('id', 1)->firstOrFail();
        $datosArrayDir = json_decode($assistant->directivas, true);

        $directivasArray = [];
        foreach ($datosArrayDir as $elemento1) {
            $elementosSeparados1 = array_map('trim', explode(',', $elemento1));
            $directivas = array_merge($directivasArray, $elementosSeparados1);
            $string = implode(',', $directivas);
        }

        return [
            "message" => $string,
        ];
    }
}