<?php

namespace App\Api\V1\Numbers\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Numbers\Repositories\Create\CreateRepository;
use Illuminate\Http\Request;
use App\Api\V1\Numbers\ValueObjects\NumberValue;

class NumbersController extends Controller
{
    public function save(Request $request, CreateRepository $repository)
    {
        $numberValue = new NumberValue(
            $request->lat,
            $request->lng
        );
        $repository->save($numberValue, $request->device_id);
        return response()->json([], 204);
    }
}
