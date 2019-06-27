<?php

namespace App\Http\Controllers;

use App\Models\attribute;
use App\Models\Category;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Attribute $attribute)
    {
        //

        $info = $attribute->with('category')->paginate(15);

        /*dd($info->category->name);
        dd($info);*/

        return view('attribute.index', compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categoryModel = new Category();

        $categoryList = $categoryModel->get();

        return view('attribute.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Attribute $attribute)
    {
        //
        $categoryId = $request->input('category');

        $name = $request->input('name');

        $attribute->category_id = $categoryId;

        $attribute->name = $name;

        $res = $attribute->save();

        if($res){
            return redirect()->route('attribute.index')->with('message', '写入成功');
        }else{
            return back()->with('errors', '写入失败');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(attribute $attribute)
    {
        //
    }
}
