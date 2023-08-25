<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {        
        $products = Product::get();
        return view('pages.product', compact('products'));
    }

    public function create()
    {
        return view('pages.create_product');
    }

    public function store(Request $request)
    {        
        $request->validate([
            'prod_name' => ['required', 'string', 'max:255'],
            'prod_brand' => ['required', 'string', 'max:255'],
            'prod_price' => ['required', 'numeric'],
            'prod_tax' => ['required', 'numeric'],
            'category' => ['required', 'numeric'],
            'prod_description' => ['required', 'string', 'max:1000'],
            'prod_image_path' => ['required','mimes:png,jpg,jpeg','max:2048'],
        ]);

        $imageName = time().'.'.$request->file('prod_image_path')->getClientOriginalExtension();
        $path = $request->file('prod_image_path')->storeAs('public/images',$imageName);

        try {

            $product = new Product();
            $product->prod_name = $request->prod_name;
            $product->prod_brand = $request->prod_brand;
            $product->prod_price = $request->prod_price;
            $product->prod_tax = $request->prod_tax;
            $product->cat_id = $request->category;
            $product->prod_description = $request->prod_description ;
            $product->prod_image_path = $imageName;
            $product->save();

            $image = new Image();
            $image->image_path = $imageName;            
            $product->images()->save($image);

             return response()->json(['success'=>'Product saved successfully']);
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);        
        $img_path = $product->images->image_path;
       
        return view('pages.update_product', compact('product','img_path'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'prod_name' => ['required', 'string', 'max:255'],
            'prod_brand' => ['required', 'string', 'max:255'],
            'prod_price' => ['required', 'numeric'],
            'prod_tax' => ['required', 'numeric'],
            'category' => ['required', 'numeric'],
            'prod_description' => ['required', 'string', 'max:1000'],
        ]);

        $input = $request->all();

        if ($request->file('prod_image_path')) {
            $request->validate([
                'prod_image_path' => ['required','mimes:png,jpg,jpeg','max:2048'],
            ]);

            $imageName = time().'.'.$request->file('prod_image_path')->getClientOriginalExtension();
            $path = $request->file('prod_image_path')->storeAs('public/images',$imageName);

        } else {
            unset($input['prod_image_path']);
        }

        try {

            $product = Product::find($id);
            $product->prod_name = $request->prod_name;
            $product->prod_brand = $request->prod_brand;
            $product->prod_price = $request->prod_price;
            $product->prod_tax = $request->prod_tax;
            $product->cat_id = $request->category;
            $product->prod_description = $request->prod_description ;
            if(isset($imageName)) {
                $product->prod_image_path = $imageName;
                $product->images()->update(['image_path' =>$imageName]);
            }
            $product->save();

             return response()->json(['success'=>'Product Updated successfully']);
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        Product::find($id)->delete();  
        return response()->json(['success'=>'Product Deleted Successfully!']);
    }

    
}
