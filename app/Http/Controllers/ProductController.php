<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();
        $sections = Section::all();
        return view("products.index", compact('products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
   
        $validated = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'section_id' => 'numeric|required',
            'description' => 'required',
        ], [
            'product_name.required' => 'يرجى ادخال المنتج',
            'product_name.unique' => 'الاسم مسجل مسبقا',
            'section_id.required' => 'اختر القسم',
            'section_id.numeric' => 'اختر القسم',
            'description.required' => 'يرجى ادخال الوصف',
        ]);
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('description');
        $product->section_id = $request->input('section_id');
        $product->save();
        return redirect()->route("products.index")->with('success', 'تم انشاء المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'section_id' => 'required',
            'description' => 'required',
        ], [
            'product_name.required' => 'يرجى ادخال المنتج',
            'product_name.unique' => 'الاسم مسجل مسبقا',
            'section_id' => 'اختر القسم',
            'description.required' => 'يرجى ادخال الوصف',
        ]);
        $products = DB::table('products')
            ->where('id', $request->product_id)
            ->update(
                [
                    'product_name' =>  $request->product_name,
                    'description' =>  $request->description,
                    'section_id' => $request->section_id,
                ]
            );
        return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // return $request;
        DB::table('products')->where('id', '=', $request->product_id)->delete();
        return redirect()->route('products.index')->with('success', 'تم الحذف المنتج بنجاح');
    }
}
