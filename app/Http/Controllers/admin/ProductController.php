<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    //
    public function products()
    {
        $products = Product::with(
            [
                'section' => function ($query) {
                    $query->select('id', 'name');
                },
                'category' => function ($query) {
                    $query->select('id', 'category_name');
                }
            ]
        )->get()->toArray();
        //dd($products);
        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'id' => $data['product_id']]);
        }
    }

    public function addEditProduct(Request $request, $id = null)
    {
        Session::put('page', 'products');
        if ($id == '') {
            $title = "Add Product";
            $product = new Product;
            //$getProducts = array();
            $message = "product added successfully";
        } else {
            $title = "Edit Product";
            $product = Product::find($id);
            //$getProducts = Product::where(['category_id' => $product['category_id'], 'section_id' => $product['section_id']])->get();
            $message = "category updated successfully";
        }



        $categories = Section::with('categories')->get()->toArray();
        $brands = Brand::where(['status' => 1])->get()->toArray();
        // dd($categories);
        // echo "<pre>";
        //     print_r($categories);
        //     die;

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r(Auth::guard('admin')->user());
            // die;
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^\w+$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',

            ];
            $customMessage = [
                'product_name.required' => 'Product Name is required',
                'product_name.regex' => 'Valid Product Name is required',
                'category_id.required' => 'Category ID is required',
                'product_code.required' => 'Product Code is required',
                'product_code.regex' => 'Valid Product Code is required',
                'product_price.required' => 'Product Price is required',
                'product_price.numeric' => 'Valid Product Price is required',
                'product_color.required' => 'Product Color is required',
                'product_color.regex' => 'Valid Product Color is required',
            ];

            $this->validate($request, $rules, $customMessage);
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            //
            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;
            //
            $product->admin_type = $adminType;
            $product->admin_id = $admin_id;
            if ($adminType == "vendor") {
                $product->vendor_id = $vendor_id;
            } else {
                $product->vendor_id = 0;
            }
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = 'No';
            }
            $product->status = 1;
            $product->save();

            return redirect('admin/products')->with('success_message', $message);
        }

        return view('admin.products.add_edit_product')->with(compact('title', 'product', 'categories', 'brands'));
    }
}