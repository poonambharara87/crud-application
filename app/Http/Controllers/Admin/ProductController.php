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
        $files = [];
        if(!$request->file('files')){
            foreach($request->file('files') as $file){
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                $file->move(public_path('uploads'), $fileName);
                $files[] = ['name' => $fileName];
            }
        }
    
        $product = Product::updateOrCreate(
                    ['id'  => $request->product_id],
                    [
                        'name' => $request->name,
                        'images' =>  $files,
                        'category_id' => $request->category_id,
                        'status' => $request->status,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
        return response()->json(['data'=> 'Product Added Successfully!']);
                 
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

    public function getProductPost(){
        $products = Product::with('posts')->get();
        return view('admin.post.index', ['products' => $products]);
    }

    public function getProductCategory(Request $Request){
        $parent_id = $Request->get('parent_id');
        //Category who has same parenent_category_id and the product
        $data = Category::with('parent')->where('parent_id', $parent_id)->get();
        return response()->json($data);
    }

      public function getSubCategory(Request $Request){
            $parent_id = $Request->get('parent_id');
            //Category who has same parenent_category_id and the product
            $data = Category::with('childern')->where('parent_id', $parent_id)->get();
            return response()->json($data);
        }
    public function view_product(){
        $parent_category = Category::with('parent')->get();
        return view('admin.products.view_product', ['parent_category' => $parent_category]);
    }
    public function getProductCategoryById(Request $Request){
        $category_id = $Request->get('category_id');

        $data = Category::with('product')->where('id', $category_id)->get();
        // dd($data);
        return response()->json($data);    
     }
    }

