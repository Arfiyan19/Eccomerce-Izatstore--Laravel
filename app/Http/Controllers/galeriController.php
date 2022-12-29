<?php

namespace App\Http\Controllers;

use File;
use App\galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class galeriController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $galeris = galeri::all();

        return  view('galeri.index2', compact('galeris'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'content' => 'required',
            'image[]' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $image = array();
        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $imaged_full_name = $image_name . '.' . $ext;
                $upload = 'storage/galeris/';
                $img_url = $imaged_full_name;
                $file->move($upload, $imaged_full_name);
                $image[] = $img_url;
            }
        }

        galeri::create([
            'image' => implode('|',$image),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect(route('galeri.index'))->with(['success' => 'Galeri Baru Berhasil Ditambahkan']);
        // }
    }

    public function edit($id)
    {
        $galeris = galeri::find($id);
        return view('galeri.edit', compact('galeris'));
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
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'content' => 'required',

        ]);

        $galeris = galeri::find($id);
        $filename = $galeris->image;

        //JIKA ADA FILE GAMBAR YANG DIKIRIM
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/galeris', $filename);

            File::delete(storage_path('app/public/galeris/' . $galeris->image));
        }

        //================================tutup==================================================//

        $galeris->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $filename,
        ]);
        return redirect(route('galeris.index'))->with(['success' => 'Data Produk Diperbaharui']);
    }












    public function destroy($id)
    {
        $galeris = galeri::find($id);
        // File::delete(storage_path('app/public/storage/galeris/' . $galeris->image));
        File::delete(storage_path('app/public/galeris/' . $galeris->image));
        $galeris->delete();
        return redirect(route('galeri.index'))->with(['success' => 'Galeri Sudah Dihapus']);
    }
}
