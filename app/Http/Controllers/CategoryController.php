<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('pages.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

             return response()->json(['success'=>'Category saved successfully']);
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::find($id);
        return view('pages.update_category', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            }
            $category->save();

            return response()->json(['success'=>'Category updated successfully']);
            
        } catch (Exception $e) {
            return $e->getMessage();
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();  
        return response()->json(['success'=>'Category Deleted Successfully!']);
    }
}
