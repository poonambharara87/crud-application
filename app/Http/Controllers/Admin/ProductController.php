<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Support\Carbon;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        return view('admin.products.index',['categories' => $categories, 'products' => $products]);
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
        if(!$request->file('files')){
            foreach($request->file('files') as $file){
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                $file->move(public_path('uploads'), $fileName);
                $files[] = ['name' => $fileName];
            }
        }
       
        Product::updateOrCreate([
            'id' => $request->product_id
        ],
        [
            'name' => $request->name, 
            'detail' => $request->detail
        ]); 
        $product = Product::updateOrCreate(
                    

                    ['id'  => $request->product_id],
                    [
                        'name' => $request->product_name,
                        'images' =>  $files,
                        'category_id' => $request->category,
                        'status' => $request->status,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);

                    ProductCategory::create([
                        'category_id' => $product->category_id,
                        'product_id' => $product->id,
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
        $data = Product::with('category')->where('id', $id)->first();
        $category = Category::where('id',$data->category_id)->first();
        $data->category_name = $category->name;
        // $data = json_decode($product);
        return response()->json($data);
        // return view('admin.products.edit', ['product' => $product]);
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
        $product = Product::find($id);
        $product->delete();
        return redirect()->back();
    }
}
