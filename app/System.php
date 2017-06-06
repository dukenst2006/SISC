<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    public static function getVAT()
    {
        return 20;
    }
}
