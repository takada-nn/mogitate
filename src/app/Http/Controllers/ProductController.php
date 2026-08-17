<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
        {
            $keyword = $request->keyword;

            $sort = $request->sort;

            if ($keyword === '') {
                $keyword = null;
            }

            if ($sort === '') {
                $sort = null;
            }

            

            if (!$keyword && !$sort && ($request->has('keyword') || $request->has('sort'))) {
            return redirect('/products');
            }

            $products = Product::when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%');
            })->when($sort, function ($query) use ($sort) {
            return $query->orderBy('price', $sort);
            })->paginate(6)->withQueryString();

            return view('products.index', compact('products', 'sort'));
        }

    public function search(Request $request)
        {
            return $this->index($request);
        }

    public function detail($id)
        {
            $product = Product::findOrFail($id);

            return view('products.detail', compact('product'));
        }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = [
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('products', 'public');

        $data['image'] = $imagePath;
        }

        $product->update($data);

        $product->seasons()->sync($request->season);

        return redirect('/products');
    }
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->seasons()->detach();

        $product->delete();

        return redirect('/products');
    }

    public function register()
        {
            return view('products.register');
        }

    public function store(ProductRequest $request)
    {
        $image = $request->file('image');

        $imagePath = $image->store('products', 'public');

        $seasonIds = $request->season;

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        $product->seasons()->attach($seasonIds);

        return redirect('/products');
    }
}
