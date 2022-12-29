<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use File;
use Illuminate\Http\Request;
use App\Jobs\ProductJob;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with(['category'])->orderBy('created_at', 'DESC');

        if (request()->q != '') {
            $product = $product->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $product = $product->paginate(10);
        return view('products.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //QUERY UNTUK MENGAMBIL SEMUA DATA CATEGORY
        $category = Category::orderBy('name', 'DESC')->get();
        return view('products.create', compact('category'));
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
            'name' => 'required|string|max:100',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id', 
            'price' => 'required|integer',
            'weight' => 'required|integer',
            // 'image' =>'required',
            'image[]' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'vidio' =>'required',
            'vidio[]'  => 'mimes:mp4,mov,ogg | max:20000',
            // 'image' => 'required|image|mimes:png,jpeg,jpg'
             
        ]);

        //JIKA FILENYA ADA
      $image = array();
      if($files = $request->file('image')){
        foreach ($files as $file) {
            $image_name = md5(rand(1000,10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $imaged_full_name = $image_name.'.'.$ext;
            $upload = 'storage/products/';
            $img_url =$imaged_full_name;
            $file->move($upload, $imaged_full_name);
            $image[] = $img_url;
        }
    }
// ================gambar1====================
    $image2 = array();
    if($files = $request->file('image2')){
      foreach ($files as $file) {
          $image_name = md5(rand(1000,10000));
          $ext = strtolower($file->getClientOriginalExtension());
          $imaged_full_name = $image_name.'.'.$ext;
          $upload = 'storage/products/';
          $img_url =$imaged_full_name;
          $file->move($upload, $imaged_full_name);
          $image2[] = $img_url;
      }
  }

// ================gambar2,3,4,5====================

$image3 = array();
if($files = $request->file('image3')){
  foreach ($files as $file) {
      $image_name = md5(rand(1000,10000));
      $ext = strtolower($file->getClientOriginalExtension());
      $imaged_full_name = $image_name.'.'.$ext;
      $upload = 'storage/products/';
      $img_url =$imaged_full_name;
      $file->move($upload, $imaged_full_name);
      $image3[] = $img_url;
  }
}


$image4 = array();
if($files = $request->file('image4')){
  foreach ($files as $file) {
      $image_name = md5(rand(1000,10000));
      $ext = strtolower($file->getClientOriginalExtension());
      $imaged_full_name = $image_name.'.'.$ext;
      $upload = 'storage/products/';
      $img_url =$imaged_full_name;
      $file->move($upload, $imaged_full_name);
      $image4[] = $img_url;
  }
}
$image5 = array();
if($files = $request->file('image5')){
  foreach ($files as $file) {
      $image_name = md5(rand(1000,10000));
      $ext = strtolower($file->getClientOriginalExtension());
      $imaged_full_name = $image_name.'.'.$ext;
      $upload = 'storage/products/';
      $img_url =$imaged_full_name;
      $file->move($upload, $imaged_full_name);
      $image5[] = $img_url;
  }
}



// ===========tutup===========

    $vidio = array();
    if($vidioFile = $request->file('vidio')){
      foreach ($vidioFile as $vidioFiles) {
          $vidio_name = md5(rand(1000,10000));
          $ext = strtolower($vidioFiles->getClientOriginalExtension());
          $vidio_full_name = $vidio_name.'.'.$ext;
          $upload = 'storage/products/';
          $vidio_url =$vidio_full_name;
          $vidioFiles->move($upload, $vidio_full_name);
          $vidio[] = $vidio_url;
      }
  }


            // if ($request->hasFile('image')) {
        //     $file = $request->file('image');

        //     $filename = time() . Str::slug($request->name) . '.' . strtolower($file->getClientOriginalExtension());
        //     $filess =$file->storeAs('public/products', $filename);
        //     $image[] = $filess;


        
        Product::create([
        'image' => implode('|',$image),
        'image2' => implode('|',$image2),
        'image3' => implode('|',$image3),
        'image4' => implode('|',$image4),
        'image5' => implode('|',$image5),
        'vidio' => implode('|',$vidio),
                'name' => $request->name,
                'slug' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description,
                // 'image' => $filename, 
                'price' => $request->price,
                'weight' => $request->weight,
                
                'merek' => $request->merek,
                'model' => $request->model,
                'jenis_garansi' => $request->jenis_garansi,
                'sku' => $request->sku,
                'masa_garansi' => $request->masa_garansi,

                'status' => $request->status,
      ]);









        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');

        //     $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/products', $filename);

        //     $product = Product::create([
        //         'name' => $request->name,
        //         'slug' => $request->name,
        //         'category_id' => $request->category_id,
        //         'description' => $request->description,
        //         'image' => $filename, 
        //         'price' => $request->price,
        //         'weight' => $request->weight,
        //         'status' => $request->status
        //     ]);

            return redirect(route('product.index'))->with(['success' => 'Produk Baru Ditambahkan']);
        // }
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
        $product = Product::find($id); 
        $category = Category::orderBy('name', 'DESC')->get(); 
        return view('products.edit', compact('product', 'category')); 
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
            'name' => 'required|string|max:100',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'weight' => 'required|integer',
            // 'image' => 'nullable|image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
        ]);

        $product = Product::find($id);
        $filename = $product->image;
        $filename2 = $product->image2;
        $filename3 = $product->image3;
        $filename4 = $product->image4;
        $filename5 = $product->image5;
    
        //JIKA ADA FILE GAMBAR YANG DIKIRIM
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            
            $file->storeAs('public/products', $filename);

            File::delete(storage_path('app/public/products/' . $product->image));
        }

// ==================================gambar 2,3,4,5=======================================================

if ($request->hasFile('image2')) {
    $file = $request->file('image2');
    $filename2 = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
    
    $file->storeAs('public/products', $filename2);

    File::delete(storage_path('app/public/products/' . $product->image2));
}

if ($request->hasFile('image3')) {
    $file = $request->file('image3');
    $filename3 = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
    
    $file->storeAs('public/products', $filename3);

    File::delete(storage_path('app/public/products/' . $product->image3));
}

if ($request->hasFile('image4')) {
    $file = $request->file('image4');
    $filename4 = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
    
    $file->storeAs('public/products', $filename4);

    File::delete(storage_path('app/public/products/' . $product->image4));
}

if ($request->hasFile('image5')) {
    $file = $request->file('image5');
    $filename5 = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
    
    $file->storeAs('public/products', $filename5);

    File::delete(storage_path('app/public/products/' . $product->image5));
}










//================================tutup==================================================//

        $product->update([
            'name' => $request->name,
            'slug' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'weight' => $request->weight,
            'image' => $filename,
            'image2' => $filename2,
            'image3' => $filename3,
            'image4' => $filename4,
            'image5' => $filename5,
            'status' => $request->status
        ]);
        return redirect(route('product.index'))->with(['success' => 'Data Produk Diperbaharui']);
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
        File::delete(storage_path('app/public/products/' . $product->image));
        $product->delete();
        return redirect(route('product.index'))->with(['success' => 'Produk Sudah Dihapus']);
    }

    public function massUploadForm()
    {
        $category = Category::orderBy('name', 'DESC')->get();
        return view('products.bulk', compact('category'));
    }

    public function massUpload(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|mimes:xlsx' 
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-product.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $filename); 

            //BUAT JADWAL UNTUK PROSES FILE TERSEBUT DENGAN MENGGUNAKAN JOB
            //ADAPUN PADA DISPATCH KITA MENGIRIMKAN DUA PARAMETER SEBAGAI INFORMASI
            //YAKNI KATEGORI ID DAN NAMA FILENYA YANG SUDAH DISIMPAN
            ProductJob::dispatch($request->category_id, $filename);
            return redirect()->back()->with(['success' => 'Upload Produk Dijadwalkan']);
        }
    }
}
