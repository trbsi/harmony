<?php

namespace App\Api\V1\Numbers\Controllers;

use App\Http\Controllers\Controller;

class NumbersController extends Controller
{
    public function save()
    {
        return response()->json(['status' => true]);
    }
}
