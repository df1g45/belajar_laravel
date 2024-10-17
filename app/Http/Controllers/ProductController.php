<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $products = Product::all();

        return response(view('products.index', ['products' => $products]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {

        $brands = Brand::orderBy('name', 'asc')->get()->pluck('name', 'id');
        $categories = Category::orderBy('name', 'asc')->get()->pluck('name', 'id');

        return response(view('products.create', ['brands' => $brands, 'categories' => $categories]));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {

        $params = $request->validated();
        // Memastikan ada file gambar yang diunggah
        if ($request->image) {
            // Mendapatkan file gambar
            $image = $request->image;

            // Menghasilkan nama file unik
            $imageName = \Str::slug($request->name, '-')
                . '-'
                . time()
                . '-'
                . $image->getClientOriginalExtension();

            // Menyimpan gambar ke storage publik dan mendapatkan path-nya
            $imagePath = $image->storeAs('public', $imageName, 'local');

            // Menyimpan path gambar ke dalam array validated
            $params['image'] = $imageName;
        }

        if ($product = Product::create($params)) {
            $product->categories()->sync($params['category_ids']);

            return redirect(route('products.index'))->with('success', 'Added!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        //get post by ID
        $product = Product::with('brand', 'categories')->findOrFail($id);
        //render view with post
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $product = Product::findOrFail($id);
        $brands = Brand::orderBy('name', 'asc')->get()->pluck('name', 'id');
        $categories = Category::orderBy('name', 'asc')->get()->pluck('name', 'id');

        return response(view('products.edit', ['product' => $product, 'brands' => $brands, 'categories' => $categories]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $params = $request->validated();

        if ($request->image) {
            Storage::disk('public')->delete($product->image);

            $imageName = \Str::slug($request->name, '-')
                . '-'
                . time()
                . '-'
                . $request->image->getClientOriginalExtension();

            $request->image->storeAs('public', $imageName, 'local');

            $params['image'] = $imageName;
        } else {
            $params['image'] = $product->image;
        }

        if ($product->update($params)) {
            $product->categories()->sync($params['category_ids']);

            return redirect(route('products.index'))->with('success', 'Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->delete()) {
            return redirect(route('products.index'))->with('success', 'Deleted!');
        }

        return redirect(route('products.index'))->with('error', 'Sorry, unable to delete this!');
    }
}
