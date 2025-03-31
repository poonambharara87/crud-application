<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Carbon;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
       
        return view('admin.products.index',['categories' => $categories]);
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
        
        foreach($request->file('files') as $file){
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $file->move(public_path('uploads'), $fileName);
            $files[] = ['name' => $fileName];
        }

        Product::create([
            'name' => $request->username,
            'images' =>  $files,
            'category_id' => $request->category,
            'status' => $request->status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.products.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
