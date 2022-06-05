<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
   
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ],200);
    }
   
 public function store(Request $request){
    $product = new Product([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        
        'photo' => $request->input('photo'),
        'type' => $request->input('type'),
        'quantity' => $request->input('quantity'),
        'price' => $request->input('price')]);
        $product->save();

    }
   public function show ($id){
       $product = Product::find($id);
       return response()->json([
           'product' => $product
       ],200);
   }
   public function update(Request $request,$id){
       $product = Product::find($id);

       $product->name = $request->name;
        $product->description = $request->description;
        if($request->photo!=$request->photo){
            $strpos = strpos($request->photo, ';'); 
            $sub = substr($request->photo,0,$strpos); 
            $ex = explode('/',$sub) [1];
            $name = time().".".$ex; 
            $img = Image::make($request->photo)->resize(200, 200); 
            $upload_path = public_path()."/upload/"; 
            $image= $upload_path.$product->photo;
            $img->save($upload_path.$name);
           if(file_exists($image)){
               @unlink($image);
           }
        }else{
            $name = $product->photo;
        }
        $product->photo = $request->name;
        $product->type = $request->type;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->save();


   }
   public function deletebyid($id){
       $product = Product::find($id);
       $product -> delete();
       return response()->json('product  supprimé !');
   }
}
