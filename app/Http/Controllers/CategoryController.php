<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Storage;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::paginate(2);
        $filterKeyword = $request->get('name');

        if ($filterKeyword) {
            $categories = Category::where('name', 'LIKE', "%$filterKeyword%")->paginate(3);
        }

        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');

        $new_category = new Category;
        $new_category->name = $name;

        if ($request->file('image')) {
            $image_path = $request->file('image')->store('categories_images', 'public');
            
            $new_category->image = $image_path;
        }

        $new_category->created_by = Auth::user()->id;
        $new_category->slug = str_slug($name, '-');

        $new_category->save();

        return redirect()->route('categories.create')->with('status', 'Categori Berhasil Dibuat!');
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
        $category_to_edit = Category::findOrFail($id);

        return view('categories.edit', ['category' => $category_to_edit->id]);
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
        $name = $request->get('name');
        $slug = $request->get('slug');

        $category = Category::findOrFail($id);

        $category->name = $name;
        $category->slug = $slug;

      if ($request->file('image')) {
            if ($category->image && file_exists(storage_path('app/public/'.$category->image))) {
                Storage::delete('public/'.$category->image);
            }
            $new_image = $request->file('image')->store('categories_images', 'public');

            $category->image = $new_image;
        }
        $category->updated_by = Auth::user()->id;
        $category->slug = str_slug($name);
        $category->save();

        return redirect()->route('categories.edit', ['id' => $category->id])->with('status', 'Kategori berhasil di update');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}