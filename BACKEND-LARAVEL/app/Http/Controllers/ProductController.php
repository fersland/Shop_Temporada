<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // LISTAR PRODUCTOS EN FORMATO JSON
    public function index(){
        $model = Product::all();
        return response()->json($model);
    }

    public function store(Request $request){
        $request->validate([
            'codigo'        => 'required',
            'descripcion'   => 'required',
            'precio'        => 'required',
            'image'         => 'required',
            'categoryId'    => 'required',
            'disponible'    => ''
        ]);

        Product::create($request->post());
        return response()->json(['message' => 'Product Added Successfully!!!']);
    }

    public function getById($id){
        $model = Product::find($id);
        if(is_null($model)){
            return response()->json(['message' => 'Product not found!', 404]);
        }
        return response()->json($model::find($id), 200);
    }

    public function update(Request $request, string $id){
        $model = Product::findOrFail($request->id);
        $model->codigo = $request->codigo;
        $model->descripcion = $request->descripcion;
        $model->precio = $request->precio;
        $model->image = $request->image;
        $model->categoryId = $request->categoryId;
        $model->disponible = $request->disponible;
        if($model->save()){
            return response()->json(['message' => 'Product data successfully!!!', 200]);
        }else{
            return response()->json(['message' => 'Error updated data!', 500]);
        }        
    }

    public function destroy(Request $request, string $id){
        $model = Product::destroy($id);
        return response()->json(['message' => 'Product deleted data successfully!!']);
    }

}
