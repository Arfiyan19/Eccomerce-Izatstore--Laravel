<?php

namespace App\Http\Controllers;

use File;
use App\bantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class bantuanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $bantuans = bantuan::all();

        return  view('bantuan.index2', compact('bantuans'));
    }

    public function create()
    {
        //QUERY UNTUK MENGAMBIL SEMUA DATA CATEGORY
        return view('bantuan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'content' => 'required',
            // 'image' =>'required',
            'image[]' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'vidio' =>'required',
            // 'image' => 'required|image|mimes:png,jpeg,jpg'
        ]);

        //JIKA FILENYA ADA
        $image = array();
        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $imaged_full_name = $image_name . '.' . $ext;
                $upload = 'storage/bantuans/';
                $img_url = $imaged_full_name;
                $file->move($upload, $imaged_full_name);
                $image[] = $img_url;
            }
        }

        bantuan::create([
            'image' => implode('|', $image),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect(route('bantuan.index'))->with(['success' => 'Produk Baru Ditambahkan']);
        // }
    }

    public function edit($id)
    {
        $bantuans = bantuan::find($id);
        return view('bantuan.edit', compact('bantuans'));
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
            // 'image' => 'nullable|image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
        ]);

        $bantuans = bantuan::find($id);
        $filename = $bantuans->image;

        //JIKA ADA FILE GAMBAR YANG DIKIRIM
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/bantuans', $filename);

            File::delete(storage_path('app/public/bantuans/' . $bantuans->image));
        }

        //================================tutup==================================================//

        $bantuans->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $filename,
        ]);
        return redirect(route('bantuan.index'))->with(['success' => 'Data Produk Diperbaharui']);
    }












    public function destroy($id)
    {
        $bantuans = bantuan::find($id);
        // File::delete(storage_path('app/public/storage/bantuans/' . $bantuans->image));
        File::delete(storage_path('app/public/bantuans/' . $bantuans->image));
        $bantuans->delete();
        return redirect(route('bantuan.index'))->with(['success' => 'Produk Sudah Dihapus']);
    }
}
