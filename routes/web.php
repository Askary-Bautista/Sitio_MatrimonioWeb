<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\InvitacionController;
use App\Http\Controllers\MatrimonioController;
use App\Http\Controllers\ActaMatrimonioController;

Route::get('/', function () {
    return view('index');
})->name('index');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/persona/registrar', function () {
    return view('registrar');
})->name('personasRegistrar');

// Ruta para manejar el envío del formulario de registro
Route::post('/registrarPersona', [PersonaController::class, 'store'])->name('personas.Registrar');


// Ruta para mostrar personas (Todas)
Route::get('/lista-personas', [PersonaController::class, 'mostrarPersonas'])->name('personas');

Route::get('/dashboard', [PersonaController::class, 'mostrarPersonas'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // RUTA PARA BUSCAR PERSONAS
    Route::get('/search', [PersonaController::class, 'search'])->name('personas.search');

    // Ruta para mostrar personas (Todas)
    Route::get('/lista-personas', [PersonaController::class, 'mostrarPersonas'])->name('personas');

    // Ruta para mostrar personas (Solteras)
    Route::get('/personas-solteras', [PersonaController::class, 'mostrarPersonasSolteras'])->name('personas.solteras');

    // Ruta para mostrar personas (Casadas)
    Route::get('/personas-casadas', [PersonaController::class, 'mostrarPersonasCasadas'])->name('personas.casadas');

    // Ruta para mostrar personas (Divorciados)
    Route::get('/personas-divorciadas', [PersonaController::class, 'mostrarPersonasDivorsiados'])->name('personas.divorciadas');

    // Ruta para mostrar personas (Viudos)
    Route::get('/personas-viudas', [PersonaController::class, 'mostrarPersonasViudas'])->name('personas.viudas');

    // RUTAS PARA CREAR, ELIMINAR, ACTUALIZAR Y GUARDAR
    // Rutas para editar y actualizar personas
    Route::get('personas/{persona}/edit', [PersonaController::class, 'edit'])->name('personas.edit');
    Route::put('personas/{persona}', [PersonaController::class, 'update'])->name('personas.update');

    Route::delete('personas/{id}', [PersonaController::class, 'destroy'])->name('personas.destroy');

    // Ruta para mostrar el formulario de registro
    Route::get('/registrar-persona', function () {
        return view('acciones.registrarPersona');
    })->name('personas.mostrarRegistro');

    // Ruta para manejar el envío del formulario de registro
    Route::post('/registrar-persona', [PersonaController::class, 'agregarRegistro'])->name('personas.agregarRegistro');

    Route::get('/casamiento', function () {
        return view('acciones.casamiento');
    });

    // RUTA PARA DIVORCIAR
    Route::post('/divorciar-persona/{id}', [PersonaController::class, 'divorciar'])->name('personas.divorciar');

    // RUTA PARA CONFIRMAR MATRIMONIO
    Route::post('/personas/confirmar-matrimonio', [PersonaController::class, 'confirmarMatrimonio'])->name('personas.confirmarMatrimonio');

    // RUTA PARA MOSTRAR PERSONAS EN (MATRIMONIOS)
    Route::get('/personas-matrimonio', [PersonaController::class, 'mostrarPersonasMatrimonio'])->name('personas.matrimonio');

    // RUTAS PARA LA INVITACION
    Route::get('/invitacion/{id}', [InvitacionController::class, 'show'])->name('invitacion.show');

    // RUTA PARA ENVIAR CORREO
    Route::post('/enviar-correo/{id}', [MatrimonioController::class, 'enviarCorreo'])->name('enviar.correo');

    // RUTA PARA EL ACTA DE MATRIMONIO
    Route::get('/acta-matrimonio/{id}', [ActaMatrimonioController::class, 'generarActaMatrimonio'])->name('acta.matrimonio');

    Route::get('/mostrar-solteras-casamiento', [PersonaController::class, 'mostrarSolterasCasamiento'])->name('mostrar_solteras_casamiento');

    // RUTA PARA IR A GRAFICAS
    Route::get('/graficas', [PersonaController::class, 'mostrarGraficas'])->name('graficas');
});



require __DIR__ . '/auth.php';