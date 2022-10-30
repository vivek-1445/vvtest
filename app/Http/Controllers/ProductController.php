<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = __('Product List');
        return view('product.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = __('Product Add');
        $data['action'] = url('user/product');
        $data['actionBit'] = 0;
        return view('product.product-add-edit', $data);
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
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        try {
            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'created_by' => Auth::id()
            ]);
            if ($product){
                toastr()->success(__('Product Created Successfully'));
                return back();
            }else{
                toastr()->error(__('Product wasn\'t Created Successfully'));
                return back();
            }
        } catch (\Throwable $th) {
            Log::debug(__('Exception occured'. $th->getMessage()));
            toastr()->error(__('Something went wrong, Product wasn\'t Created Successfully'));
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data['title'] = __('Product Edit');
        $data['action'] = url('user/product/'. $product->id);
        $data['actionBit'] = 1;
        $data['product'] = $product;
        return view('product.product-add-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);
        try {
            $data = [
                'name' => $request->name,
                'category_id' => $request->category,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ];
            $product->fill($data);
            if ($product->save()){
                toastr()->success(__('Product updated Successfully'));
                return back();
            }else{
                toastr()->error(__('Product wasn\'t updated Successfully'));
                return back();
            }
        } catch (\Throwable $th) {
            Log::debug(__('Exception occured'. $th->getMessage()));
            toastr()->error(__('Something went wrong, Product wasn\'t updated Successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $userId = Auth::id();
        if ($request->ajax()) {
            $data = Product::with(['category'])->where('created_by', $userId)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $extra = "<a href='#' onclick='deleteProduct($row->id)' class='bg-green btn-sm ml-1'><i class='fa fa-trash' aria-hidden='true'></i></a>";
                    $btn = "<a href='/user/product/$row->id/edit' class='bg-green btn-sm'><i class='fa fa-pen' aria-hidden='true'></i></a>";

                    return $btn.$extra;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }
}
