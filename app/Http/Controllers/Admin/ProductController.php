<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\brand;
use App\Models\product;
use App\Models\productimage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProductController extends Controller
{

	public function index()
	{
		$products = Product::with('category', 'brand', 'product_images')->get();
		$brands = Brand::get();
		$categories = Categories::get();

		return Inertia::render('Admin/Products/Index', [
			'products' => $products,
			'brands' => $brands,
			'categories' => $categories
		]);
	}

	public function store(Request $request)
	{

		$product = new Product;
		$product->title = $request->title;
		$product->price = $request->price;
		$product->quantity = $request->quantity;
		$product->description = $request->description;
		$product->category_id = $request->category_id;
		$product->brand_id = $request->brand_id;
		$product->save();

		if ($request->hasFile('product_images')) {
			$productimages = $request->file('product_images');
			foreach ($productimages as $image) {
				$uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
				$image->move('product_images', $uniqueName);

				ProductImage::create([
					'product_id' => $product->id,
					'image' => 'product_images/' . $uniqueName
				]);
			}
		}

		return redirect()->route('admin.products.index')->with('Sucesso', 'produto foi criado com sucesso.');
	}

	public function update(Request $request, $id)
	{
		$product = Product::findOrFail($id);
		$product->title = $request->title;
		$product->price = $request->price;
		$product->quantity = $request->quantity;
		$product->description = $request->description;
		$product->category_id = $request->category_id;
		$product->brand_id = $request->brand_id;

		if ($request->hasFile('product_images')) {
			$productimages = $request->file('product_images');

			foreach ($productimages as $image) {
				$uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
				$image->move('product_images', $uniqueName);

				ProductImage::create([
					'product_id' => $product->id,
					'image' => 'product_images/' . $uniqueName,
				]);
			}
		}

		$product->update();
	}

	public function deletaimage($id)
	{
		$image = ProductImage::where('id', $id)->delete();

		return redirect()->route('admin.products.index')->with('success', 'image deletada com sucesso!');
	}

	public function deleta($id)
	{
		$product = Product::findOrFail($id)->delete();
		return redirect()->route('admin.products.index')->with('success', 'product deletado com sucesso!');
	}
}
