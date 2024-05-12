<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $response = Product::create($inputs);
        return response()->json([
            'data'=>$response,
            'message'=>'Producto creado con éxito'
        ]);
    }

    /** 
     * Search products by parameter
    */
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $products = Product::where('name', 'like', "%$searchTerm%")
                            ->orWhere('description', 'like', "%$searchTerm%")
                            ->orWhere('category', 'like', "%$searchTerm%")
                            ->get();

        return view('products.find', ['products' => $products]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(isset($product)){
            return response()->json([
                'data'=>$product,
                'message'=>'Producto encontrado con éxito'
            ]);
        }else{
            return response()->json([
                'data'=>[],
                'message'=>'El producto no existe'
            ]);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::find($id);
        if(isset($producto)){
            $producto->name = $request->name;
            $producto->description = $request->description;
            $producto->price = $request->price;
            $producto->category = $request->category;
            if($producto->save()){
                return response()->json([
                    'data'=>$producto,
                    'message'=>'Producto actualizado con éxito'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=>'Error al actualizar el producto'
                ]); 
            }
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No existe el producto'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(isset($product)){
            $res = Product::destroy($id);
            if($res){
                return response()->json([
                    'data'=>[],
                    'message'=>'Producto eliminado con éxito'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=>'Error al eliminar el producto'
                ]); 
            } 
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No existe el producto '
            ]);
        }
    }
}
