<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        
       
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get();
        $brands = Brand::get();
        return view('admin.product.create-edit', compact('category', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create New Products 
        $product = new Product;
        // dd($request->all());
        $product->product_name = $request->product_name ;
        $product->slug = $request->slug ;
        $product->category_id = $request->category_id ;
        $product->brand_id = $request->brand_id ;
        $product->short_description = $request->short_description ;
        $product->long_description = $request->long_description ;
        $product->product_code = $request->product_code ;
        $product->purchase_price = $request->purchase_price ;
        $product->sales_price = $request->sales_price ;
        $product->unit_amount = $request->unit_amount ;
        $product->unit_type = $request->unit_type ;
        $product->total_stock = $request->total_stock ;
        $product->color = $request->color ;
        $product->min_order = $request->min_order ;
        $product->featured = $request->featured;
        if ($request->file('product_img')) {
            // $file = $request->file('image');
            // $filename = date('YmdHi') . $file->getClientOriginalName();
            // $file->move(public_path('storage/uploads/'), $filename);


            $image = $request->file('product_img');
            // save  File name
            $input['file'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('storage/uploads/products');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['file']);
            // Resize and save to destination path
            // $image->move($destinationPath, $input['file']);
            $product->product_img = $input['file'];
        }
        $product->save();
        return redirect()->route('product.index')->with('success', 'Data Stored Successfully');
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
        $data = Product::find($id);
        $category = Category::get();
        $brands = Brand::get();
        return view('admin.product.create-edit', compact('category', 'brands', 'data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->product_img){ // jodi image thake 
            $img_path =  public_path().'/storage/uploads/products/'.$product->product_img;
            if(file_exists($img_path))  // file jodi thake taile unlink er kaj delete deoa
                unlink($img_path);
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Data Deleted Successfully');
    }
}
