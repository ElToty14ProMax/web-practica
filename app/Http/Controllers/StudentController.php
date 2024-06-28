<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\facades\Validator;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();

        if(!$student){
            $data = [
                'message' => 'No se encontraron estudiantes',
                'status' => 200
            ];
            return response ()->json($data,200);
        }

        $data = [
            'message' => $student,
            'status' => 200
        ];
        return response ()->json($data,200);
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
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'lenguaje' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion',
                'error' => $validator -> errors(),
                'status' => 400
            ];
            return response ()->json($data,400);
        }

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'lenguaje' => $request->lenguaje
        ]);

        if(!$student){
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response ()->json($data,500);
        }

        $data = [
            'student' => $student,
            'status' => 201
        ];
        return response ()->json($data,200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $student = Student::find($id);

        if(!$student){
            $data = [
                'message' => 'No se encontraron estudiantes',
                'status' => 200
            ];
            return response ()->json($data,200);
        }

        $data = [
            'message' => $student,
            'status' => 200
        ];
        return response ()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editpartial(Request $request, $id)
    {
        $student = Student::find($id);

        $validator = Validator::make($request->all(),[
            'name' => 'max:255',
            'email' => 'email',
            'address' => 'in:Cuba',
            'lenguaje' => 'max:255'

        ]);

        if($validator->fails()){
            $data =[
                'message' => 'Estudiante no validado',
                'error' => $validator-> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        if($request-> has('name')){
            $student-> name = $request->name;
        }
        if($request-> has('email')){
            $student-> email = $request->email;
        }
        if($request-> has('address')){
            $student-> address = $request->address;
        }
        if($request-> has('lenguaje')){
            $student-> lenguaje = $request->lenguaje;
        }

        $student -> save();

        $data =[
            'message' => 'Estudiante actualizado',
            'status' => 200
        ];
        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'lenguaje' => 'required'

        ]);

        if($validator->fails()){
            $data =[
                'message' => 'Estudiante no validado',
                'error' => $validator-> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $student -> name = $request-> name;
        $student -> email = $request-> email;
        $student -> address = $request-> address;
        $student -> lenguaje = $request-> lenguaje;
        $student -> save();

        $data =[
            'message' => 'Estudiante actualizado',
            'status' => 200
        ];

        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $student = Student::find($id);

        if(!$student){
            $data =[
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];

            return response()->json($data,404);
        }

        $student-> delete();

        $data =[
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];

        return response()->json($data,200);
    }
}
