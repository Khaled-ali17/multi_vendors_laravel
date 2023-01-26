@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Catalogue Management</h3>
                            <h6 class="font-weight-normal mb-0">Products</h6>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">January - March</a>
                                        <a class="dropdown-item" href="#">March - June</a>
                                        <a class="dropdown-item" href="#">June - August</a>
                                        <a class="dropdown-item" href="#">August - November</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error : </strong> {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success : </strong> {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form class="forms-sample"
                            @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else
                        action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif
                            method="post" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="category_id">Section Category</label>
                                <select id="category_id" name="category_id" class="form-control" style="color: #000;">
                                    <option value="">Select</option>
                                    @foreach ($categories as $section)
                                        <optgroup label="{{ $section['name'] }}"></optgroup>
                                        @foreach ($section['categories'] as $category)
                                            <option value="{{ $category['id'] }}">
                                                &nbsp;&nbsp;&nbsp;--&nbsp;{{ $category['category_name'] }} </option>
                                            @foreach ($category['subcategories'] as $subcategories)
                                                <option value="{{ $subcategories['id'] }}">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---&nbsp;{{ $subcategories['category_name'] }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Section Brand</label>
                                <select id="brand_id" name="brand_id" class="form-control" style="color: #000;"
                                    size="">
                                    <option value="">Select</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Producty Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    placeholder="Enter Product Name"
                                    @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}"
                                    @else
                                    value="{{ old('product_name') }}" @endif>
                                <span id="check_password"></span>
                            </div>
                            <div class="form-group">
                                <label for="product_code">Producty Code</label>
                                <input type="text" class="form-control" id="product_code" name="product_code"
                                    placeholder="Enter Product Code"
                                    @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}"
                                    @else
                                    value="{{ old('product_code') }}" @endif>
                                <span id="check_password"></span>
                            </div>
                            <div class="form-group">
                                <label for="product_color">Producty Color</label>
                                <input type="text" class="form-control" id="product_color" name="product_color"
                                    placeholder="Enter Product Color"
                                    @if (!empty($product['product_color'])) value="{{ $product['product_color'] }}"
                                    @else
                                    value="{{ old('product_color') }}" @endif>
                                <span id="check_password"></span>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Product Price</label>
                                <input type="text" class="form-control" id="product_price" name="product_price"
                                    placeholder="Enter Product Price"
                                    @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}"
                                    @else
                                    value="{{ old('product_price') }}" @endif>
                            </div>

                            <div class="form-group">
                                <label for="product_discount">Product Discount(%)</label>
                                <input type="text" class="form-control" id="product_discount" name="product_discount"
                                    placeholder="Enter Product Discount"
                                    @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}"
                                    @else
                                    value="{{ old('product_discount') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_weight">Product Weight</label>
                                <input type="text" class="form-control" id="product_weight" name="product_weight"
                                    placeholder="Enter Product Weight"
                                    @if (!empty($product['product_weight'])) value="{{ $product['product_weight'] }}"
                                    @else
                                    value="{{ old('product_weight') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_desdcription">Product Description</label>
                                <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                    placeholder="Enter Meta Title"
                                    @if (!empty($product['meta_title'])) value="{{ $product['meta_title'] }}"
                                    @else
                                    value="{{ old('meta_title') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description"
                                    placeholder="Enter Meta Description"
                                    @if (!empty($product['meta_description'])) value="{{ $product['meta_description'] }}"
                                    @else
                                    value="{{ old('meta_description') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                    placeholder="Enter Meta Keywords"
                                    @if (!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}"
                                    @else
                                    value="{{ old('meta_keywords') }}" @endif>
                            </div>

                            <div class="form-group">
                                <label for="product_image">Product Image</label>
                                <input type="file" class="form-control" id="product_image" name="product_image">
                                @if (!empty($product['product_image']))
                                    <a target="_blank"
                                        href="{{ url('admin/images/product_images/' . $product['product_image']) }}">View
                                        Image</a>&nbsp;|&nbsp;
                                    <a href="javascript:void(0)" class="confirmDelete" module="product-image"
                                        moduleid="{{ $product['id'] }}">
                                        Delete Image</a>
                                @endif
                            </div>
                            <div class="form- group">
                                <label for="product_video">Product Video</label>
                                <input type="file" class="form-control" id="product_video" name="product_video">
                                @if (!empty($product['product_video']))
                                    <a target="_blank"
                                        href="{{ url('admin/images/product_images/' . $product['product_video']) }}">View
                                        Video</a>&nbsp;|&nbsp;
                                    <a href="javascript:void(0)" class="confirmDelete" module="product-video"
                                        moduleid="{{ $product['id'] }}">
                                        Delete Video</a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="is_featured">Featured Items</label>
                                <input type="checkbox" value="Yes" id="is_featured" name="is_featured"
                                    placeholder="Enter Featured Items"
                                    @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked="" @endif>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        @include('admin.layout.footer')
    </div>
@endsection
