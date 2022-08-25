<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\IncomingInvoiceContent;
use App\Models\OutgoingInvoiceContent;
use App\Models\ProductAttachment;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductCountry;
use App\Models\ProductImage;
use App\Models\ProductMaterial;
use App\Models\ProductNote;
use App\Models\TransferContent;
use App\Models\WarehouseStockContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Product/Products', [
            "products" => Product::with(['product_category', 'product_type', 'product_brand', 'product_collection', 'product_model', 'product_color', 'product_material', 'product_country'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/CreateProduct', [
            "ProductCategory" => ProductCategory::all(),
            "ProductBrand" => ProductBrand::all(),
            "ProductColor" => ProductColor::all(),
            "ProductMaterial" => ProductMaterial::all(),
            "ProductCountry" => ProductCountry::all(),
            "product" => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image/product', 'public');
        } else {
            $image_path = 'no_image.png';
        }

        $product = Product::create([
            'product_category_id' => $request->category,
            'product_type_id' => $request->type,
            'product_brand_id' => $request->brand,
            'product_collection_id' => $request->collection,
            'product_model_id' => $request->model,
            'name' => $request->name,
            'product_color_id' => $request->color,
            'product_material_id' => $request->material,
            'description' => $request->description,
            'sku' => $request->sku,
            'product_country_id' => $request->country,
            'image' => $image_path,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);

        // Save Attachment Of Product
        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/products', 'public');
                ProductAttachment::create([
                    'attachment' =>  $attachment_path,
                    'product_id' => $product['id'],
                    'user_id' => Auth::id()
                ]);
            }
        }


        // Save The Notes Of Product
        for ($i = 0; $i <  count($request["note"]); $i++) {
            ProductNote::create([
                'note' => $request["note"][$i]["note"],
                'product_id' => $product['id'],
                'user_id' => Auth::id()
            ]);
        }

        // Save The Images Of Product
        for ($i = 0; $i <  count($request["images"]); $i++) {
            if ($request["images"][$i]["image"] != null) {
                $attachment_path = $request["images"][$i]["image"]->store('image/products', 'public');
                ProductImage::create([
                    'image' =>  $attachment_path,
                    'product_id' => $product['id'],
                    'user_id' => Auth::id()
                ]);
            }
        }


        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        $incomeIvoice = IncomingInvoiceContent::with(['incoming_invoice', 'incoming_invoice.people'])->where('product_id', $product->id)->get();
        $outgoingIvoice = OutgoingInvoiceContent::with(['outgoing_invoice', 'outgoing_invoice.people'])->where('product_id', $product->id)->get();
        $stratStock = WarehouseStockContent::with('warehouse_stock')->where('product_id', $product->id)->get();
        $transfer = TransferContent::with(['transfer', 'transfer.warehouse_from', 'transfer.warehouse_to'])->where('product_id', $product->id)->get();
        $stockData = [];

        //incomeIvoice
        for ($i = 0; $i < count($incomeIvoice); $i++) {
            $stockData[$i] = $incomeIvoice[$i];
            $stockData[$i]["type"] = "فاتورة وارده";
        }
        //outgoingIvoice
        for ($i = count($incomeIvoice), $x = 0; $i < (count($incomeIvoice) + count($outgoingIvoice)); $i++, $x++) {
            $stockData[$i] = $outgoingIvoice[$x];
            $stockData[$i]["type"] = "فاتورة صادره";
        }
        //stratStock
        for ($i = count($incomeIvoice) + count($outgoingIvoice), $x = 0; $i < (count($incomeIvoice) + count($outgoingIvoice) + count($stratStock)); $i++, $x++) {
            $stockData[$i] = $stratStock[$x];
            $stockData[$i]["type"] = "مخزون";
        }
        //transfer
        for ($i = (count($incomeIvoice) + count($outgoingIvoice) + count($stratStock)), $x = 0; $i < (count($incomeIvoice) + count($outgoingIvoice) + count($stratStock) + count($transfer)); $i++, $x++) {
            $stockData[$i] = $transfer[$x];
            $stockData[$i]["type"] = "نقله";
        }
        return Inertia::render('Product/ShowProduct', [
            "product" => Product::with(['product_category', 'product_type', 'product_brand', 'product_collection', 'product_model', 'product_color', 'product_material', 'product_country', 'product_notes', 'product_images', 'product_attachments'])->where('id', $product->id)->get(),
            "stockData" => $stockData,
            "incomeIvoice" => $incomeIvoice,
            "outgoingIvoice" => $outgoingIvoice,
            "stratStock" => $stratStock,
            "transfer" => $transfer,
            "note" => ProductNote::where('product_id', $product->id)->get(),
            "attachment" => ProductAttachment::where('product_id', $product->id)->get(),
            "image" => ProductImage::where('product_id', $product->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/EditProduct', [
            "ProductCategory" => ProductCategory::all(),
            "ProductBrand" => ProductBrand::all(),
            "ProductColor" => ProductColor::all(),
            "ProductMaterial" => ProductMaterial::all(),
            "ProductCountry" => ProductCountry::all(),
            "Product" => Product::with(['product_category', 'product_type', 'product_brand', 'product_collection', 'product_model', 'product_color', 'product_material', 'product_country', 'product_notes', 'product_images', 'product_attachments'])->where('id', $product->id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image/product', 'public');

        } else {
            Storage::delete("public/" . $request->image);
            $image_path = $request->oldImage;
        }

        $product = DB::table('products')->where('id', $product->id)->update([
            'product_category_id' => $request->category,
            'product_type_id' => $request->type,
            'product_brand_id' => $request->brand,
            'product_collection_id' => $request->collection,
            'product_model_id' => $request->model,
            'name' => $request->name,
            'product_color_id' => $request->color,
            'product_material_id' => $request->material,
            'description' => $request->description,
            'sku' => $request->sku,
            'product_country_id' => $request->country,
            'image' => $image_path,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
