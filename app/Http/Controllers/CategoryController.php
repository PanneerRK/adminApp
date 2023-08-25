<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
     public function index()
    {
        $categories = Category::get();
        return view('pages.category', compact('categories'));
    }

    public function create()
    {
        return view('pages.create_category');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => ['required', 'string', 'max:255'],
            'cat_description' => ['required', 'string', 'max:1000'],
            'cat_image_path' => ['required','mimes:png,jpg,jpeg','max:2048'],
        ]);

        $imageName = time().'.'.$request->file('cat_image_path')->getClientOriginalExtension();
        $path = $request->file('cat_image_path')->storeAs('public/images',$imageName);
        
        $slug_name = $request->cat_name;
        $slug = Str::slug($slug_name, '_');

        try {

            $category = new Category();
            $category->cat_name = $request->cat_name;
            $category->cat_slug = $slug;
            $category->cat_description = $request->cat_description;
            $category->cat_image_path = $imageName;
            $category->save();

            $image = new Image();
            $image->image_path = $imageName;            
            $category->images()->save($image);

            return response()->json(['success'=>'Category saved successfully']);
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        // foreach ($categories->images as $value) {
        //     $image_path = $value->image_path;
        // }
        return view('pages.update_category', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cat_name' => ['required', 'string', 'max:255'],
            'cat_description' => ['required', 'string', 'max:1000'],
        ]);

        $input = $request->all();

        if ($request->file('cat_image_path')) {
            $request->validate([
                'cat_image_path' => ['required','mimes:png,jpg,jpeg','max:2048'],
            ]);

            $imageName = time().'.'.$request->file('cat_image_path')->getClientOriginalExtension();
            $path = $request->file('cat_image_path')->storeAs('public/images',$imageName);

        } else {
            unset($input['cat_image_path']);
        }

        $slug_name = $request->cat_name;
        $slug = Str::slug($slug_name, '_');

        try {

            $category = Category::find($id);
            $category->cat_name = $request->cat_name;
            $category->cat_slug = $slug;
            $category->cat_description = $request->cat_description;
            if(isset($imageName)) {
                $category->cat_image_path = $imageName;
                $category->images()->update(['image_path' =>$imageName]);
            }
            $category->save();

            return response()->json(['success'=>'Category updated successfully']);
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        Category::find($id)->delete();  
        return response()->json(['success'=>'Category Deleted Successfully!']);
    }
}
