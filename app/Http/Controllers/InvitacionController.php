<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matrimonio;

class InvitacionController extends Controller
{
    public function show($id)
    {
        $matrimonio = Matrimonio::findOrFail($id);
        return view('acciones.invitacion', compact('matrimonio'));
    }

    public function showMatrimonios()
    {
        $matrimonios = Matrimonio::with(['persona1', 'persona2'])->get();
        return view('acciones.invitacion', compact('matrimonios'));
    }
}
