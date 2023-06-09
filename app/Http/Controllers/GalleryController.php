<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Product;
use Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $galleries = Gallery::all();
        return view('gallery.index', compact('galleries','products'));
    }
    
    public function create()
    {
        $products = Product::all();
        return view('gallery.create',compact('products'));
    }


    public function store(Request $request)
    {
        
        // $this->validate($request, [
        //     'product_id'   => 'required',
        //     'image'     => 'required|image|mimes:png,jpg,jpeg',
        //     'title'     => 'required',
        //     'description'   => 'required'
        // ]);


        //upload image
        $image = $request->file('image');
        $image->storeAs('public/galleries', $image->hashName());


        $gallery = Gallery::create([
            'product_id'     => $request->project_id,
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'description'   => $request->description
        ]);

        if($gallery){
            //redirect dengan pesan sukses
            return redirect()->route('galleries.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('galleries.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Gallery $gallery)
    {
        $products = Product::all();
        return view('gallery.edit', compact('gallery','products'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        // $this->validate($request, [
        //     'product_id'     => 'required',
        //     'image'     => 'required|image|mimes:png,jpg,jpeg',
        //     'title'     => 'required',
        //     'description'   => 'required'
        // ]);

        //get data Gallery by ID
        $gallery = Gallery::findOrFail($gallery->id);

        if($request->file('image') == "") {

            $gallery->update([
                'product_id'     => $request->project_id,
                'title'     => $request->title,
                'description'   => $request->description
            ]);

        } else {

            //hapus old image
            Storage::disk('local')->delete('public/galleries/'.$gallery->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/galleries', $image->hashName());

            $gallery->update([
                'image'     => $image->hashName(),
                'product_id'     => $request->project_id,
                'title'     => $request->title,
                'description'   => $request->description
            ]);

        }

        if($gallery){
            //redirect dengan pesan sukses
            return redirect()->route('galleries.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('galleries.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }


    public function destroy($id)
    {
    $gallery = Gallery::findOrFail($id);
    Storage::disk('local')->delete('public/galleries/'.$gallery->image);
    $gallery->delete();

    if($gallery){
        //redirect dengan pesan sukses
        return redirect()->route('galleries.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('galleries.index')->with(['error' => 'Data Gagal Dihapus!']);
    }
    }
}
