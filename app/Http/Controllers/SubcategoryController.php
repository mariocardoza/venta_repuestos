<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategory;
use App\Category;
use Storage;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('subcategories.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('subcategories.create', compact('categories'));
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
            'name' => 'required|max:200',
            'category_id' => 'required',
        ]);
        $subcategory = new Subcategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;

        $subcategory->save();
        return redirect()->route('subcategories.index');
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
        $subcategory = Subcategory::find($id);
        $categories = Category::all();
        return view('subcategories.edit',compact('subcategory','categories'));
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
            'name' => 'required|max:200',
            'category_id' => 'required',
        ]);
        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;

        $subcategory->save();
        return redirect()->route('subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with("success","Registro eliminado exitosamente");
    }

    public function list($id)
    {
        $subcategories = Subcategory::where('category_id',$id)->get();
        $options='<option selected value=""> Ninguno</option>';
        foreach ($subcategories as $subcategory) {
          $options.='<option value="' . $subcategory->id . '">' . $subcategory->name . '</option>';
        }
        return array(1, $subcategories, $options);
    }
}