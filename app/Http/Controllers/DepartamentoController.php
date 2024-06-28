<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\facades\Validator;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Departamento::all();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nombre_departamento' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion',
                'error' => $validator -> errors(),
                'status' => 400
            ];
            return response ()->json($data,400);
        }

        $departamento = Departamento::create([
            'nombre_departamento' => $request->nombre_departamento
        ]);

        if(!$departamento){
            $data = [
                'message' => 'Error al crear el departamento',
                'status' => 500
            ];
            return response ()->json($data,500);
        }

        $data = [
            'departamento' => $departamento,
            'status' => 201
        ];
        return response ()->json($data,200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        if(!$departamento){
            $data = [
                'message' => 'No se encontraron departamentos',
                'status' => 200
            ];
            return response ()->json($data,200);
        }

        $data = [
            'message' => $departamento,
            'status' => 200
        ];
        return response ()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editpartial(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        $validator = Validator::make($request->all(),[
            'nombre_departamento' => 'max:255'

        ]);

        if($validator->fails()){
            $data =[
                'message' => 'Departamento no validado',
                'error' => $validator-> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        if($request-> has('nombre_departamento')){
            $departamento-> nombre_departamento = $request->nombre_departamento;
        }

        $departamento -> save();

        $data =[
            'message' => 'Departamento actualizado',
            'status' => 200
        ];
        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        $validator = Validator::make($request->all(),[
            'nombre_departamento' => 'required'

        ]);

        if($validator->fails()){
            $data =[
                'message' => 'Departamento no validado',
                'error' => $validator-> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $departamento -> nombre_departamento = $request-> nombre_departamento;

        $departamento -> save();

        $data =[
            'message' => 'Departamento actualizado',
            'status' => 200
        ];

        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        if(!$departamento){
            $data =[
                'message' => 'Departamento no encontrado',
                'status' => 404
            ];

            return response()->json($data,404);
        }

        $departamento-> delete();

        $data =[
            'message' => 'Departamento eliminado',
            'status' => 200
        ];

        return response()->json($data,200);
    }
}
