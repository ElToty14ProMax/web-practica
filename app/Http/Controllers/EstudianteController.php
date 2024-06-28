<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\facades\Validator;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todos los parámetros de la solicitud
        $params = $request->all();

        // Crear una consulta base
        $query = Estudiante::query();

        // Iterar sobre los parámetros y añadir condiciones a la consulta
        foreach ($params as $key => $value) {
            if (in_array($key, [
                'identidad', 'nombre', 'apellidos', 'provincia', 'municipio', 'situacion_academica', 'estado', 'direccion', 'fecha_de_nacimiento', 'grupo', 'carrera', 'facultad_filial', 'tipo_de_curso', 'correo_electronico', 'fuente_de_ingreso', 'origen_academico', 'regimen_de_estudio', 'natural_de', 'telefono', 'fecha_de_ingreso_a_la_es', 'estado_civil', 'organizacion_politica', 'fecha_de_ingreso_al_ces', 'fecha_de_matricula', 'sexo', 'color_de_la_piel', 'tipo_de_estudiante', 'anno_de_estudio', 'centro_de_trabajo', 'nombre_del_padre', 'nivel_academico_del_padre', 'nombre_de_la_madre', 'nivel_academico_de_la_madre', 'tipo_de_servicio_militar', 'edad'
            ])) {
                // Convertir ambas partes de la condición a minúsculas
                $query->whereRaw('LOWER(' . $key . ') LIKE ?', ['%' . strtolower($value) . '%']);
            }
        }

        // Obtener los resultados de la consulta
        $students = $query->get();

        // Verificar si se encontraron resultados
        if ($students->isEmpty()) {
            $data = [
                'data' => 'No se encontraron estudiantes',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        $data = [
            'data' => $students,
            'status' => 200
        ];
        return response()->json($data, 200);
    }





    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $profesor = Estudiante::find($id);

        if (!$profesor) {
            $data = [
                'data' => 'No se encontraron profesores',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        $data = [
            'data' => $profesor,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editpartial(Request $request, $id)
    {
        $profesor = Estudiante::find($id);

        $validator = Validator::make($request->all(), [
            'ci' => 'digits:11',
            'nombre' => 'max:255',
            'apellidos' => 'max:255',
            'cargo' => 'max:40',
            'departamento_id' => 'digits:1'
        ]);

        if ($validator->fails()) {
            $data = [
                'data' => 'Profesor no validado',
                'error' => $validator->errors(),
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        if ($request->has('ci')) {
            $profesor->ci = $request->ci;
        }
        if ($request->has('nombre')) {
            $profesor->nombre = $request->nombre;
        }
        if ($request->has('apellidos')) {
            $profesor->apellidos = $request->apellidos;
        }
        if ($request->has('cargo')) {
            $profesor->cargo = $request->cargo;
        }

        if ($request->has('departamento_id')) {
            $profesor->departamento_id = $request->departamento_id;
        }

        $profesor->save();

        $data = [
            'data' => 'Profesor actualizado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $profesor = Estudiante::find($id);

        $validator = Validator::make($request->all(), [
            'ci' => 'required|max:11',
            'nombre' => 'required',
            'apellidos' => 'required',
            'cargo' => 'required',
            'departamento_id' => 'required'

        ]);

        if ($validator->fails()) {
            $data = [
                'data' => 'Profesor no validado',
                'error' => $validator->errors(),
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $profesor->ci = $request->ci;
        $profesor->nombre = $request->nombre;
        $profesor->apellidos = $request->apellidos;
        $profesor->cargo = $request->cargo;
        $profesor->departamento_id = $request->departamento_id;
        $profesor->save();

        $data = [
            'data' => 'Profesor actualizado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $profesor = Estudiante::find($id);

        if (!$profesor) {
            $data = [
                'data' => 'Profesor no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $profesor->delete();

        $data = [
            'data' => 'Profesor eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
