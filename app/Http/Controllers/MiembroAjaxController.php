<?php

namespace App\Http\Controllers;

use App\Models\Miembro;
use Illuminate\Http\Request;

class MiembroAjaxController extends Controller
{
    public function search(string $value)
    {
        return response()->json(
            Miembro::whereNombresApellidos($value)->get()
        );
    }
}
