<?php
// MatrimonioController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarInvitacionMatrimonio;
use App\Models\Matrimonio;

class MatrimonioController extends Controller
{
    public function enviarCorreo($id)
    {
        $matrimonio = Matrimonio::findOrFail($id);
        $email = $matrimonio->persona1->email;

        Mail::to($email)->send(new EnviarInvitacionMatrimonio($matrimonio));

        return response()->json(['success' => 'Correo enviado correctamente.']);
    }
}
