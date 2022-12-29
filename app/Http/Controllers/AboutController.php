<?php

namespace App\Http\Controllers;

use File;
use App\bantuan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::all();
        return view('about.index2', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'header[]' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sideImage' => 'required',
            'content' => 'required',
            // 'vidio' =>'required',
            // 'image' => 'required|image|mimes:png,jpeg,jpg'
        ]);

        //JIKA FILENYA ADA
        $header = array();
        if ($files = $request->file('header')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $imaged_full_name = $image_name . '.' . $ext;
                $upload = 'storage/abouts/';
                $img_url = $imaged_full_name;
                $file->move($upload, $imaged_full_name);
                $header[] = $img_url;
            }
        }

        //JIKA FILENYA ADA

        About::create([
            'header' => implode('|', $header),
            'sideImage' => $request->sideImage,
            'content' => $request->content,
        ]);

        return redirect(route('about.index'))->with(['success' => 'About Telah Ditambahkan']);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        $about = About::find($id);
        return view('about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $this->validate($request, [
            'content' => 'required',
            'sideImage' => 'required',
            // 'image' => 'nullable|image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
        ]);

        $about = About::find($id);
        $filename = $about->header;

        //JIKA ADA FILE GAMBAR YANG DIKIRIM
        if ($request->hasFile('header')) {
            $file = $request->file('header');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/abouts', $filename);

            File::delete(storage_path('app/public/abouts/' . $about->header));
        }

        //================================tutup==================================================//

        $about->update([
            'header' => $filename,
            'sideImage' => $request->sideImage,
            'content' => $request->content,
        ]);
        return redirect(route('about.index'))->with(['success' => 'Data About Diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::find($id);
        $aboutimage = $about->header;
        // File::delete(storage_path('app/public/storage/bantuans/' . $bantuans->image));
        File::delete(storage_path('app/public/abouts/' . $aboutimage));
        $about->delete();
        return redirect(route('about.index'))->with(['success' => 'About Sudah Dihapus']);
    }
}
