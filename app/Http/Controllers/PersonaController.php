<?php

namespace App\Http\Controllers;

use App\Models\Matrimonio;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PersonaController extends Controller
{


    //METODOS PARA  MOSTRAR PERSONAS
    public function mostrarPersonas()
    {
        $personas = Persona::simplePaginate(10); // Recupera 10 registros por página
        return view('personas', compact('personas'));
    }



    public function mostrarPersonasSolteras()
    {
        $personasSolteras = Persona::where('estado_civil', 'soltero')->simplePaginate(10); // Obtener todas las personas solteras paginadas
        $totalPersonas = Persona::where('estado_civil', 'soltero')->count(); // Obtener el total de personas solteras en la base de datos

        return view('mostrarPersonas.solteras', compact('personasSolteras', 'totalPersonas'));
    }

    public function mostrarPersonasCasadas()
    {
        $personasCasadas = Persona::where('estado_civil', 'casado')->simplePaginate(10); // Obtener todas las personas solteras paginadas
        $totalPersonas = Persona::where('estado_civil', 'casado')->count(); // Obtener el total de personas solteras en la base de datos

        return view('mostrarPersonas.casadas', compact('personasCasadas', 'totalPersonas'));
    }

    public function mostrarPersonasDivorsiados()
    {
        $personasDivorciado = Persona::where('estado_civil', 'divorciado')->simplePaginate(10); // Obtener todas las personas solteras paginadas
        $totalPersonas = Persona::where('estado_civil', 'divorciado')->count(); // Obtener el total de personas solteras en la base de datos

        return view('mostrarPersonas.divorciadas', compact('personasDivorciado', 'totalPersonas'));
    }

    public function mostrarPersonasViudas()
    {
        $personasViudas = Persona::where('estado_civil', 'viudo')->paginate(10); // Obtener todas las personas solteras paginadas
        $totalPersonas = Persona::where('estado_civil', 'viudo')->count(); // Obtener el total de personas solteras en la base de datos

        return view('mostrarPersonas.viudas', compact('personasViudas', 'totalPersonas'));
    }


    //METODO PARA MOSTRAR LOS MATRIMONIOS
    public function mostrarPersonasMatrimonio()
    {


        $totalMatrimonios = Matrimonio::count();
        $matrimonios = Matrimonio::simplePaginate(10); // Recupera 10 registros por página
        return view('mostrarPersonas.matrimonios', compact('matrimonios', 'totalMatrimonios'));
    }



    public function showMatrimonios()
    {
        $matrimonios = Matrimonio::with(['persona1', 'persona2'])->get();
        return view('mostrarPersonas.matrimonios', compact('matrimonios'));
    }

    //METODO PARA MOSTRAR INVITACION
    public function showIvitacion($id)
    {
        $matrimonio = Matrimonio::findOrFail($id);
        return view('partials.invitacion', compact('matrimonio'));
    }



    //METODOS PARA (ELIMINAR, EDITAR, ACTUALIZAR Y GUARDAR)

    public function destroy($id)
    {
        Persona::destroy($id);
        return redirect()->back()->with('success', 'La persona ha sido eliminada correctamente.');
    }


    //METODO REGISTRAR PERSONA SIN SER ADMINISTRADOR
    public function store(Request $request)
    {
        // Registro de los datos recibidos
        Log::info('Received request:', $request->all());

        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:personas',
            'password' => 'required|string|min:8|confirmed',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|max:10',
            'estado_civil' => 'required|string|in:Soltero,Casado,Divorciado,Viudo,Otro',
            'entidad_nacimiento' => 'nullable|string|max:255',
            'municipio_nacimiento' => 'nullable|string|max:255',
            'nacionalidad' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'nombre_padre' => 'nullable|string|max:255',
            'nacionalidad_madre' => 'nullable|string|max:255',
            'nacionalidad_padre' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        // Manejo de la subida de la imagen
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/perfiles');
        }


        // Registro de los datos que se van a guardar
        Log::info('Saving Persona:', $request->all());

        // Creación de una nueva instancia del modelo Persona y asignación de valores
        $persona = new Persona();
        $persona->name = $request->name;
        $persona->primer_apellido = $request->primer_apellido;
        $persona->segundo_apellido = $request->segundo_apellido;
        $persona->email = $request->email;
        $persona->password = bcrypt($request->password);
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->sexo = $request->sexo;
        $persona->estado_civil = $request->estado_civil;
        $persona->entidad_nacimiento = $request->entidad_nacimiento;
        $persona->municipio_nacimiento = $request->municipio_nacimiento;
        $persona->nacionalidad = $request->nacionalidad;
        $persona->nombre_madre = $request->nombre_madre;
        $persona->nombre_padre = $request->nombre_padre;
        $persona->nacionalidad_madre = $request->nacionalidad_madre;
        $persona->nacionalidad_padre = $request->nacionalidad_padre;
        $persona->image = $path;

        // Intento de guardar los datos en la base de datos
        try {
            $persona->save();
        } catch (\Exception $e) {
            Log::error('Error saving Persona:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error al guardar la persona: ' . $e->getMessage());
        }

        return redirect(url('/'))->with('success', 'Persona registrada exitosamente');
    }

    //METODO PARA REGISTRAR PERSONAS SIENDO ADMINISTRADOR
    public function agregarRegistro(Request $request)
    {
        // Registro de los datos recibidos
        Log::info('Received request:', $request->all());

        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:personas',
            'password' => 'required|string|min:8|confirmed',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|max:10',
            'estado_civil' => 'required|string|in:Soltero,Casado,Divorciado,Viudo,Otro',
            'entidad_nacimiento' => 'nullable|string|max:255',
            'municipio_nacimiento' => 'nullable|string|max:255',
            'nacionalidad' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'nombre_padre' => 'nullable|string|max:255',
            'nacionalidad_madre' => 'nullable|string|max:255',
            'nacionalidad_padre' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        // Manejo de la subida de la imagen
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/perfiles');
        }


        // Registro de los datos que se van a guardar
        Log::info('Saving Persona:', $request->all());

        // Creación de una nueva instancia del modelo Persona y asignación de valores
        $persona = new Persona();
        $persona->name = $request->name;
        $persona->primer_apellido = $request->primer_apellido;
        $persona->segundo_apellido = $request->segundo_apellido;
        $persona->email = $request->email;
        $persona->password = bcrypt($request->password);
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->sexo = $request->sexo;
        $persona->estado_civil = $request->estado_civil;
        $persona->entidad_nacimiento = $request->entidad_nacimiento;
        $persona->municipio_nacimiento = $request->municipio_nacimiento;
        $persona->nacionalidad = $request->nacionalidad;
        $persona->nombre_madre = $request->nombre_madre;
        $persona->nombre_padre = $request->nombre_padre;
        $persona->nacionalidad_madre = $request->nacionalidad_madre;
        $persona->nacionalidad_padre = $request->nacionalidad_padre;
        $persona->image = $path;

        // Intento de guardar los datos en la base de datos
        try {
            $persona->save();
        } catch (\Exception $e) {
            Log::error('Error saving Persona:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error al guardar la persona: ' . $e->getMessage());
        }

        // Redirigir a la vista personas después de un guardado exitoso
        return redirect(url('/lista-personas'))->with('success', 'Persona registrada exitosamente');
    }



    //METODO EDITAR
    public function index()
    {
        $personas = Persona::paginate(10);
        $personasTotales = Persona::all();
        return view('acciones.edit', compact('personas', 'personasTotales'));
    }
    public function edit($id)
    {
        $persona = Persona::findOrFail($id);
        return view('acciones.edit', compact('persona'));
    }



    public function update(Request $request, Persona $persona)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:personas,email,' . $persona->id,
            'password' => 'nullable|string|min:8|confirmed',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|max:10',
            'estado_civil' => 'required|string|max:10',
            'entidad_nacimiento' => 'nullable|string|max:255',
            'municipio_nacimiento' => 'nullable|string|max:255',
            'nacionalidad' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'nombre_padre' => 'nullable|string|max:255',
            'nacionalidad_madre' => 'nullable|string|max:255',
            'nacionalidad_padre' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($persona->image) {
                Storage::disk('public')->delete($persona->image);
            }
            $persona->image = $request->file('image')->store('public/perfiles');
        }

        $persona->name = $request->name;
        $persona->primer_apellido = $request->primer_apellido;
        $persona->segundo_apellido = $request->segundo_apellido;
        $persona->email = $request->email;
        if ($request->password) {
            $persona->password = bcrypt($request->password);
        }
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->sexo = $request->sexo;
        $persona->estado_civil = $request->estado_civil;
        $persona->entidad_nacimiento = $request->entidad_nacimiento;
        $persona->municipio_nacimiento = $request->municipio_nacimiento;
        $persona->nacionalidad = $request->nacionalidad;
        $persona->nombre_madre = $request->nombre_madre;
        $persona->nombre_padre = $request->nombre_padre;
        $persona->nacionalidad_madre = $request->nacionalidad_madre;
        $persona->nacionalidad_padre = $request->nacionalidad_padre;
        $persona->save();

        return response()->json(['success' => 'La persona ha sido actualizada correctamente.']);
    }


    //METODO PARA CASAR PERSONAS
    public function confirmarMatrimonio(Request $request)
    {
        Log::info('Iniciando proceso de confirmación de matrimonio.');

        // Obtener las personas seleccionadas
        $persona1 = Persona::findOrFail($request->persona1_id);
        $persona2 = Persona::findOrFail($request->persona2_id);

        Log::info('Personas seleccionadas:', ['persona1' => $persona1, 'persona2' => $persona2]);

        // Verificar si las personas existen
        if (!$persona1 || !$persona2) {
            return response()->json(['error' => 'Una o ambas personas no existen.'], 404);
        }

        // Validar sexo opuesto
        if ($persona1->sexo == $persona2->sexo) {
            return response()->json(['error' => 'Ambas personas deben ser de sexo opuesto.'], 400);
        }

        // Calcular edad
        $edadPersona1 = \Carbon\Carbon::parse($persona1->fecha_nacimiento)->age;
        $edadPersona2 = \Carbon\Carbon::parse($persona2->fecha_nacimiento)->age;

        Log::info('Edades calculadas:', ['edadPersona1' => $edadPersona1, 'edadPersona2' => $edadPersona2]);

        // Validar edades
        if ($edadPersona1 <= 18 || $edadPersona2 <= 18) {
            return response()->json(['error' => 'Ambas personas deben ser mayores de 18 años.'], 400);
        }

        // Validación de Estado Civil
        if ($persona1->estado_civil !== 'Soltero' || $persona2->estado_civil !== 'Soltero') {
            return response()->json(['error' => 'Una o ambas personas no están solteras. No se puede realizar el matrimonio.']);
        }

        // Verificar si ya están casados
        if ($persona1->estaCasado()) {
            Log::info('Persona1 ya está casada.', ['persona1_id' => $persona1->id]);
            return response()->json(['error' => 'Persona1 ya está casada. No se puede realizar el matrimonio.']);
        }

        if ($persona2->estaCasado()) {
            Log::info('Persona2 ya está casada.', ['persona2_id' => $persona2->id]);
            return response()->json(['error' => 'Persona2 ya está casada. No se puede realizar el matrimonio.']);
        }

        // Crear registro de matrimonio
        $matrimonio = new Matrimonio();
        $matrimonio->persona1_id = $persona1->id;
        $matrimonio->persona2_id = $persona2->id;
        $matrimonio->fecha_matrimonio = $request->fecha_matrimonio;
        $matrimonio->clausula = $request->clausula;

        if ($matrimonio->save()) {
            Log::info('Matrimonio registrado exitosamente.');

            // Actualizar estado civil de las personas a "Casado"
            $persona1->estado_civil = 'Casado';
            $persona1->save();

            $persona2->estado_civil = 'Casado';
            $persona2->save();

            Log::info('Estado civil actualizado a Casado para ambas personas.');

            return response()->json(['success' => 'Matrimonio confirmado exitosamente.']);
        } else {
            Log::error('Error al crear el registro de matrimonio.');
            return response()->json(['error' => 'Error al crear el registro de matrimonio.'], 500);
        }
    }

    // METODO PARA BUSCAR
    public function mostrarSolterasCasamiento()
    {
        $personasSolteras = Persona::where('estado_civil', 'soltero')->simplePaginate(10); // Obtener todas las personas solteras paginadas
        $totalPersonas = Persona::where('estado_civil', 'soltero')->count(); // Obtener el total de personas solteras en la base de datos

        return view('acciones.casamiento', compact('personasSolteras', 'totalPersonas'));
    }

    public function divorciar(Request $request, $id)
    {
        Log::info('Iniciando proceso de divorcio.');

        // Obtener el matrimonio basado en el ID
        $matrimonio = Matrimonio::findOrFail($id);

        if (!$matrimonio) {
            return response()->json(['error' => 'No se encontró el matrimonio.'], 404);
        }

        // Obtener las personas
        $persona1 = $matrimonio->persona1;
        $persona2 = $matrimonio->persona2;

        // Actualizar estado civil de las personas a "Divorciado"
        $persona1->estado_civil = 'Divorciado';
        $persona1->save();

        $persona2->estado_civil = 'Divorciado';
        $persona2->save();

        // Eliminar el registro de matrimonio
        if ($matrimonio->delete()) {
            Log::info('Matrimonio eliminado exitosamente. Estado civil actualizado a Divorciado para ambas personas.');
            return response()->json(['success' => 'Divorcio realizado exitosamente.']);
        } else {
            Log::error('Error al eliminar el registro de matrimonio.');
            return response()->json(['error' => 'Error al eliminar el registro de matrimonio.'], 500);
        }
    }





    public function search(Request $request)
    {
        $query = $request->input('query');
        $personas = Persona::where('name', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->get();

        return view('acciones.partials.search_results', compact('personas'));
    }



    public function mostrarGraficas(Request $request)
    {
        // Establecer año predeterminado si no se proporciona
        $year = $request->input('year', date('Y'));

        // Datos para el gráfico de matrimonios por mes
        $matrimoniosPorMes = Matrimonio::selectRaw('MONTH(fecha_matrimonio) as mes, COUNT(*) as cantidad')
            ->whereYear('fecha_matrimonio', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('cantidad', 'mes');

        // Datos para el gráfico de estados civiles
        $estadosCiviles = Persona::selectRaw('estado_civil, COUNT(*) as cantidad')
            ->groupBy('estado_civil')
            ->orderBy('cantidad', 'desc')
            ->pluck('cantidad', 'estado_civil');

        // Datos para el gráfico de géneros
        $generos = Persona::selectRaw('sexo, COUNT(*) as cantidad')
            ->groupBy('sexo')
            ->orderBy('cantidad', 'desc')
            ->pluck('cantidad', 'sexo');

        return view('graficas', compact('matrimoniosPorMes', 'estadosCiviles', 'generos', 'year'));
    }
}
