<?php

namespace App\Directives\Helpers;

use Assistent\Sai\Src\Helpers\Pattern\Methods\HelperBase;

class GetExample extends HelperBase 
{
    public function outPut($input)
    {
        return config('app.app_name', 'AF DEVELOPER');
    }
}