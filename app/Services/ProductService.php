<?php

namespace App\Services;

use DataTables;
use App\Models\Image;
use App\Models\Product;
use App\Models\Personalization;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function getData()
    {
        $data = Product::with('images')->get();
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                return '<a href="'.route('product.edit',$row->id).'" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                </a>
                <a href="#" onclick="deleteData('.$row->id.');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                </a>
                ';
            })
            ->addColumn('stock', function($data) {
                if($data->stock == 1){
                    return '<label class="badge badge-success">In Stock</label>';
                }else{
                    return '<label class="badge badge-danger">Out Stock</label>';
                }
            })
            ->editColumn('featured_image_url', function($data) {
                foreach($data->images as $item){
                    if($item->is_featured == 1){
                        $url= asset('uploads/products/'.$item->image_url);
                        return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                    }
                }
            })
            ->rawColumns(['stock','featured_image_url','action'])
            ->blacklist(['action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function storeProduct($request)
    {
        DB::beginTransaction();
        try
        {
            $prod_seq_count = Product::latest()->first();
            $prodSku = isset($prod_seq_count) ? "PROD-1000".($prod_seq_count->id + 1) : "PROD-1000". 1;

            $storeProduct = Product::create([
                'title' => $request->title,
                'slug' => \Str::slug($request->title).'-'.\Str::random(6),
                'price' => $request->price,
                'stock' => $request->stock,
                'qty' => $request->qty,
                'sku' => $prodSku,
                'total_page_number' => $request->total_page_number,
                'description' => $request->description,
                'best_for_age' => $request->best_for_age,
                'cover_type' => $request->cover_type,
                'shipping_day_from' => $request->shipping_day_from,
                'shipping_day_to' => $request->shipping_day_to
            ]);

            $storeProduct->families()->attach($request->family);
            $storeProduct->festivals()->attach($request->festival);
            $storeProduct->others()->attach($request->others);

            if($request->has('personalization_label')) {
                $this->personalizationInsert($request, $storeProduct->id);
            }

            if($request->hasfile('image_url')) {
                $this->uploadFeaturedImage($request, $storeProduct->id);
            }

            if($request->hasfile('imageFile')) {
                $this->bulkImageUpload($request, $storeProduct->id);
            }
            DB::commit();
            return redirect()->route('product')->with('success', 'Book has been created!');
        }catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    private function personalizationInsert($request,$storeId)
    {
        foreach($request->personalization_label as $single){
            Personalization::create([
                'product_id' => $storeId,
                'label' => $single
            ]);
        }
    }


    private function uploadFeaturedImage($request,$storeId)
    {
       $file = $request->image_url;
        $name = time().'-'.$file->getClientOriginalName();
        $file->move(public_path().'/uploads/products/', $name);
        $productId = $storeId;

        $multipleImage = new Image();
        $multipleImage->product_id = $productId;
        $multipleImage->is_featured = 1;
        $multipleImage->image_url = $name;
        $multipleImage->save();
    }

    private function bulkImageUpload($request,$storeId)
    {
        foreach($request->file('imageFile') as $file)
        {
            $name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path().'/uploads/products/', $name);
            $productId = $storeId;

            $multipleImage = new Image();
            $multipleImage->product_id = $productId;
            $multipleImage->image_url = $name;
            $multipleImage->save();
        }
    }

    public function updateProduct($request, $id)
    {
        DB::beginTransaction();
        try
        {

            $storeProduct = Product::findOrFail($id);
            $storeProduct->update([
                'title' => $request->title,
                'slug' => \Str::slug($request->title).'-'.\Str::random(6),
                'price' => $request->price,
                'stock' => $request->stock,
                'qty' => $request->qty,
                'total_page_number' => $request->total_page_number,
                'description' => $request->description,
                'best_for_age' => $request->best_for_age,
                'cover_type' => $request->cover_type,
                'shipping_day_from' => $request->shipping_day_from,
                'shipping_day_to' => $request->shipping_day_to
            ]);

            $storeProduct->families()->sync($request->family);
            $storeProduct->festivals()->sync($request->festival);
            $storeProduct->others()->sync($request->others);

            if($request->has('personalization_label')) {
                $this->personalizationInsert($request, $storeProduct->id);
            }

            if($request->hasfile('image_url')) {
                $this->uploadFeaturedImage($request, $storeProduct->id);
            }

            if($request->hasfile('imageFile')) {
                $this->bulkImageUpload($request, $storeProduct->id);
            }
            DB::commit();
        return redirect()->route('product')->with('success', 'Book has been updated!');
        }catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $product->families()->detach();
        $product->festivals()->detach();
        $product->others()->detach();

        if($product){
            echo 'success';
        }else{
            echo 'error';
        }
    }
}