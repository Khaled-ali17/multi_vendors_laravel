@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold"> Vendor Details</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{ url('admin/admins/vendor') }}">Back to Vendors</a>
                            </h6>
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

            <div class="row">
                {{-- Personal Details --}}
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> Personal Information</h4>

                            <div class="form-group">
                                <label>Email </label>
                                <input class="form-control" value="{{ $vendorDetails['vendor_personal']['email'] }}"
                                    readonly="">
                            </div>

                            <div class="form-group">
                                <label for="vendor_name">Name</label>
                                <input type="text" class="form-control" id="vendor_name" name="vendor_name"
                                    placeholder="Enter Name" value="{{ $vendorDetails['vendor_personal']['name'] }}"
                                    readonly="">
                                <span id="check_password"></span>
                            </div>
                            <div class="form-group">
                                <label for="vendor_mobile">Mobile</label>
                                <input type="text" class="form-control" id="vendor_mobile" name="vendor_mobile"
                                    placeholder="Enter Phone Number" value="{{ Auth::guard('admin')->user()->mobile }}"
                                    maxlength="12" minlength="12" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="vendor_address">Address</label>
                                <input type="text" class="form-control" id="vendor_address" name="vendor_address"
                                    placeholder="Enter Your Address"
                                    value="{{ $vendorDetails['vendor_personal']['address'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="vendor_city">City</label>
                                <input type="text" class="form-control" id="vendor_city" name="vendor_city"
                                    placeholder="Enter Your City" value="{{ $vendorDetails['vendor_personal']['city'] }}"
                                    readonly="">
                            </div>

                            <div class="form-group">
                                <label for="vendor_country">Country</label>
                                <input type="text" class="form-control" id="vendor_country" name="vendor_country"
                                    placeholder="Enter Your Country"
                                    value="{{ $vendorDetails['vendor_personal']['country'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="vendor_state">State</label>
                                <input type="text" class="form-control" id="vendor_state" name="vendor_state"
                                    placeholder="Enter State" value="{{ $vendorDetails['vendor_personal']['state'] }}"
                                    readonly="">
                            </div>
                            <div class="form-group">
                                <label for="vendor_pincode">Pincode</label>
                                <input type="text" class="form-control" id="vendor_pincode" name="vendor_pincode"
                                    placeholder="Enter Pincode" value="{{ $vendorDetails['vendor_personal']['pincode'] }}"
                                    readonly="">
                            </div>
                            @if (!empty($vendorDetails['image']))
                                <div class="form-group">
                                    <label for="vendor_image"> Photo</label>
                                    <br>

                                    <img width="200px" src="{{ url('admin/images/photos/' . $vendorDetails['image']) }}">


                                </div>
                            @endif
                            </form>
                        </div>
                    </div>

                </div>
                {{-- Business Details --}}
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> Business Information</h4>

                            <div class="form-group">
                                <label for="shop_name">Shop Name</label>
                                <input type="text" class="form-control" id="shop_name" name="shop_name"
                                    value="{{ $vendorDetails['vendor_business']['shop_name'] }}" readonly="">
                                <span id="check_password"></span>
                            </div>
                            <div class="form-group">
                                <label for="shop_mobile">Shop Mobile</label>
                                <input type="text" class="form-control" id="shop_mobile" name="shop_mobile"
                                    value="{{ $vendorDetails['vendor_business']['shop_mobile'] }}" maxlength="12"
                                    minlength="12" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Shop Address</label>
                                <input type="text" class="form-control" id="shop_address" name="shop_address"
                                    value="{{ $vendorDetails['vendor_business']['shop_address'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="shop_city">Shop City</label>
                                <input type="text" class="form-control" id="shop_city" name="shop_city"
                                    value="{{ $vendorDetails['vendor_business']['shop_city'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="shop_country">Shop Country</label>
                                <input type="text" class="form-control" id="shop_country" name="shop_country"
                                    value="{{ $vendorDetails['vendor_business']['shop_country'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="shop_state">Shop State</label>
                                <input type="text" class="form-control" id="shop_state" name="shop_state"
                                    value="{{ $vendorDetails['vendor_business']['shop_state'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="shop_pincode">Shop Pincode</label>
                                <input type="text" class="form-control" id="shop_pincode" name="shop_pincode"
                                    value="{{ $vendorDetails['vendor_business']['shop_pincode'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="business_license_number">Business License Number</label>
                                <input type="text" class="form-control" id="business_license_number"
                                    name="business_license_number"
                                    value="{{ $vendorDetails['vendor_business']['business_license_number'] }}"
                                    readonly="">
                            </div>
                            <div class="form-group">
                                <label for="gst_number">Gst Number</label>
                                <input type="text" class="form-control" id="gst_number" name="gst_number"
                                    value="{{ $vendorDetails['vendor_business']['gst_number'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="pen_number">Pen Number</label>
                                <input type="text" class="form-control" id="pen_number" name="pen_number"
                                    value="{{ $vendorDetails['vendor_business']['pen_number'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="pen_number">Address Proof</label>
                                <input type="text" class="form-control" id="pen_number" name="pen_number"
                                    value="{{ $vendorDetails['vendor_business']['address_proof'] }}" readonly="">
                            </div>

                            @if (!empty($vendorDetails['vendor_business']['address_proof_image']))
                                <div class="form-group">
                                    <label for="vendor_image"> Photo</label>
                                    <br>

                                    <img width="200px"
                                        src="{{ url('admin/images/proofs/' . $vendorDetails['vendor_business']['address_proof_image']) }}">


                                </div>
                            @endif
                            </form>
                        </div>
                    </div>

                </div>
                {{-- Bank Details --}}
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> Bank Information</h4>

                            <div class="form-group">
                                <label for="acount_holder_name">Account Holder Name</label>
                                <input type="text" class="form-control" id="acount_holder_name"
                                    name="acount_holder_name"
                                    value="{{ $vendorDetails['vendor_bank']['acount_holder_name'] }}" readonly="">
                                <span id="check_password"></span>
                            </div>
                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name"
                                    value="{{ $vendorDetails['vendor_bank']['bank_name'] }} " readonly="">
                            </div>
                            <div class="form-group">
                                <label for="acount_number">Account Number</label>
                                <input type="text" class="form-control" id="acount_number" name="acount_number"
                                    value="{{ $vendorDetails['vendor_bank']['acount_number'] }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="bank_ifsc_code">Bank IFSC Code</label>
                                <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code"
                                    value="{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}" readonly="">
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        @include('admin.layout.footer')
    </div>
@endsection
