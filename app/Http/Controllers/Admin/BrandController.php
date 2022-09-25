<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create-edit');
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
            'brand_name' => 'required',
            'brand_slug' => 'required',
            'image' => 'required'
        ]);

        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = $request->brand_slug;
        // dd($request->all());

        // Image Upload file 
        if ($request->file('image')) {
            // $file = $request->file('image');
            // $filename = date('YmdHi') . $file->getClientOriginalName();
            // $file->move(public_path('storage/uploads/'), $filename);


            $image = $request->file('image');
            // save  File name
            $input['file'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('storage/uploads/brands');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['file']);
            // Resize and save to destination path
            // $image->move($destinationPath, $input['file']);
            $brand->image = $input['file'];
        }
        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Data Stored Successfully');
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
        $data = Brand::find($id);
        return view('admin.brand.create-edit', compact('data'));
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
            'brand_name' => 'required',
            'brand_slug' => 'required',
            'image' => 'required'
        ]);
        // Eitar kaj holo brand e khujbe id ache kina 
        //http://localhost:8000/admin/brand/1 url e 1 deoa ache eita holo id er man 

        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = $request->brand_slug;
        // dd($request->all());

        // Image Upload file 
        if ($request->file('image')) {
            // $file = $request->file('image');
            // $filename = date('YmdHi') . $file->getClientOriginalName();
            // $file->move(public_path('storage/uploads/'), $filename);
            // Ei code ta bosano hoy jodi image update korte hoi tahole ager ta delete kore dite hobe folder theke
            if($brand->image){ // jodi image thake 
                $img_path =  public_path().'/storage/uploads/brands/'.$brand->image;
                if(file_exists($img_path))  // file jodi thake taile unlink er kaj delete deoa
                    unlink($img_path);
            }
            $image = $request->file('image');
            // save  File name
            $input['file'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('storage/uploads/brands');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['file']);
            // Resize and save to destination path
            // $image->move($destinationPath, $input['file']);
            $brand->image = $input['file'];
        }else{
            unset($brand->image);  //kono kichur change hobena
        }
        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Data update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if($brand->image){ // jodi image thake 
            $img_path =  public_path().'/storage/uploads/brands/'.$brand->image;
            if(file_exists($img_path))  // file jodi thake taile unlink er kaj delete deoa
                unlink($img_path);
        }
        $brand->delete();
        return redirect()->route('brand.index')->with('success', 'Data update Successfully');
    }
}
