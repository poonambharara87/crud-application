<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Brand::get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View" class="me-1 btn btn-info viewBrand" >View</a>';
                        $btn = $btn .'<a href="javascript:void(0)"  data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="me-1 btn btn-primary editBrand" >Edit</a>';
                        $btn = $btn .'<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger deleteBrand" >Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.brands.index');
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
        // dd($request->all());
       Brand::updateOrCreate(
        [
            'id' => $request->brand_id
        ],
        [
            'name' => $request->brand_name ?? '',
            'detail' => $request->brand_detail ?? '',
            'status' => $request->brand_status ?? '',

        ]
        );
        return response()->json(['success'=>'Product saved successfully.']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        $data = Brand::find($brand);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand): JsonResponse
    {
        $data = Brand::find($brand);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json('Brand successfully deleted!');
        
    }
}
