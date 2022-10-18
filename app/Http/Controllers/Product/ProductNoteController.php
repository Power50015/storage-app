<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductNoteRequest;
use App\Http\Requests\Product\UpdateProductNoteRequest;
use App\Models\Product\ProductNote;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Request::input('id');
        $search = Request::input('search');
        return [
            "note" => ProductNote::with('user')->latest()->where('product_id', $product)->when(Request::input('search'), function ($query, $search) {
                $query->where('tag', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            "filters" => $search
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductNoteRequest $request)
    {
        $note = ProductNote::create([
            'note' => $request->note,
            'product_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductNote  $productNote
     * @return \Illuminate\Http\Response
     */
    public function show(ProductNote $productNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductNote  $productNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductNote $productNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductNoteRequest  $request
     * @param  \App\Models\ProductNote  $productNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductNoteRequest $request, ProductNote $productNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductNote  $productNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductNote $productNote)
    {
        $productNote->delete();

        return Redirect::back();
    }
}
