<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    function index(){
        $courses = Course::all();
        if($courses->isNotEmpty()){
            return response()->json(['data' => $courses], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['data' => 'No existen courses'], 404, [], JSON_UNESCAPED_UNICODE);
        }
    }

    function show($id){
        $course = Course::find($id);
        if($course){
            return response()->json(['data' => $course], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['data' => 'Course no existe'], 404, [], JSON_UNESCAPED_UNICODE);
        }
    }
    //curl -X POST -H "Content-Type: application/json" -d '{"product_name":"RTX 4080", "product_code":"admin", "product_category": "Tarjeta gráfica"}' http://localhost:8000/api/products/store
    function store(Request $request){
        $course = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        try{
            Course::create($course);
            return response()->json(['data' => 'Course insertado correctamente'], 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch(\Exception $e){
            return response()->json(['data' => 'Error al insertar el course'], 404, [], JSON_UNESCAPED_UNICODE);
        }
    }
    function update(Request $request, $id){
        $course = Course::find($id);

        if($course){
            try{
                $course->update($request->all());
                return response()->json(['data' => 'Course actualizado correctamente'], 200, [], JSON_UNESCAPED_UNICODE);
            }
            catch(\Exception $e){
                return response()->json(['data' => 'Error al actualizar el course'], 404, [], JSON_UNESCAPED_UNICODE);
            }

        }

    }

    function destroy($id){
        try{
            $deleted = Course::where('id', $id)->delete();

            if($deleted) {
                return response()->json(['data' => 'Course eliminado con éxito'], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['data' => 'Error al eliminar el course'], 404, [], JSON_UNESCAPED_UNICODE);
            }
        }
        catch(\Exception $e){
            return response()->json(['data' => 'Error al eliminar el course'], 404, [], JSON_UNESCAPED_UNICODE);
        }

    }
}
