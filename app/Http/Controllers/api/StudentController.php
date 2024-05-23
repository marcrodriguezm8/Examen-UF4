<?php

namespace App\Http\Controllers\api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    //
    function index(){
        $students = Student::all();
        if($students->isNotEmpty()){
            return response()->json(['data' => $students], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['data' => 'No existen students'], 404, [], JSON_UNESCAPED_UNICODE);
        }
    }

    function show($id){
        $student = Student::find($id);
        if($student){
            return response()->json(['data' => $student], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['data' => 'Student no existe'], 404, [], JSON_UNESCAPED_UNICODE);
        }
    }
    //curl -X POST -H "Content-Type: application/json" -d '{"product_name":"RTX 4080", "product_code":"admin", "product_category": "Tarjeta gráfica"}' http://localhost:8000/api/products/store
    function store(Request $request){
        $student = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'birthDate' => 'required|date',
            'course_id' => 'required|numeric'
        ]);

        try{
            Student::create($student);
            return response()->json(['data' => 'Student insertado correctamente'], 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch(\Exception $e){
            return response()->json(['data' => 'Error al insertar el student'], 404, [], JSON_UNESCAPED_UNICODE);
        }
    }
    function update(Request $request, $id){
        $student = Student::find($id);

        if($student){
            try{
                $student->update($request->all());
                return response()->json(['data' => 'Student actualizado correctamente'], 200, [], JSON_UNESCAPED_UNICODE);
            }
            catch(\Exception $e){
                return response()->json(['data' => 'Error al actualizar el student'], 404, [], JSON_UNESCAPED_UNICODE);
            }

        }

    }

    function destroy($id){
        try{
            $deleted = Student::where('id', $id)->delete();

            if($deleted) {
                return response()->json(['data' => 'Student eliminado con éxito'], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['data' => 'Error al eliminar el student'], 404, [], JSON_UNESCAPED_UNICODE);
            }
        }
        catch(\Exception $e){
            return response()->json(['data' => 'Error al eliminar el student'], 404, [], JSON_UNESCAPED_UNICODE);
        }

    }
}
