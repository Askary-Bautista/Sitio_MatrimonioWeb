<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matrimonio;
use App\Models\Persona;
use Barryvdh\DomPDF\Facade\Pdf;

class ActaMatrimonioController extends Controller
{
    public function generarActaMatrimonio(Request $request)
    {
        // Obtén el ID del matrimonio de la ruta
        $matrimonio_id = $request->route('id');

        // Encuentra el matrimonio correspondiente
        $matrimonio = Matrimonio::findOrFail($matrimonio_id);

        // Encuentra las personas asociadas con este matrimonio
        $persona1 = Persona::findOrFail($matrimonio->persona1_id);
        $persona2 = Persona::findOrFail($matrimonio->persona2_id);


        // Genera el PDF con los datos
        $pdf = Pdf::loadView('acta_matrimonio', compact('matrimonio', 'persona1', 'persona2'));

        return $pdf->stream();
    }


    public function show($id)
    {
        $matrimonio = Matrimonio::findOrFail($id);
        return view('acta_matrimonio', compact('matrimonio'));
    }
}
