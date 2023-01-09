<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorBusinessDetail;
use App\Models\VendorBankDetail;
use Image;

class AdminController extends Controller
{
    public function dashboard(){
        
        return view('admin.dashboard');
    }

    public function login(Request $request){
        //echo $password = Hash::make(123456789); die;
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $customMessage =[
                'email.required' => 'Email is required!',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required!',
            ];
            $this-> validate($request,$rules,$customMessage);
            
            if(Auth::guard('admin')->attempt(['email' => $data['email'],'password' => $data['password'],'status' => 1])){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message','Invalid Email or Password ');
            }
        }
        return view('admin.login');
    }

    public function updateAdminPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
                if($data['confirm_password']== $data['new_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(
                        ['password' => bcrypt($data['new_password'])]
                    );
                    return redirect()->back()->with('success_message','Password has been update successfully!');
                }else{
                    return redirect()->back()->with('error_message',' New Password and Confirm Password does not match!');
                }
            }else{
                 return redirect()->back()->with('error_message','Your Current Password is Incorrect!');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }

    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>" ; print_r($data); die;
            $rules =[
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
            ];
            $customMessage =[
                "admin_name.required" => "Name is required",
                "admin_name.regex" => "Valid Name is required",
                "admin_mobile.required" => "Mobile is required",
                "admin_mobile.numeric" => "Valid Mobile is required",
            ];
            $this->validate($request ,$rules, $customMessage);
            // upload image 
            if($request->hasFile("admin_image")){
                $image_tmp = $request->file("admin_image");
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    Image::make($image_tmp)->save($imagePath);
                }
            }else if(!empty($data['current_admin_image'])){
                $imageName = $data['current_admin_image'];
            }else{
                $imageName = "";
            }

            Admin::where('id',Auth::guard('admin')->user()->id)->update(
                ['name' => $data['admin_name'],'mobile' => $data['admin_mobile'] , 'image' => $imageName]
            );
            return redirect()->back()->with('success_message','Name and Mobile has been update successfully!');
        }
       // $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view ('admin.settings.update_admin_details');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updateVendorDetails($slug,Request $request){
        
        if($slug == "personal"){
            if($request->isMethod('POST')){
                //dd('$request->all()');
                $data = $request->all();
                //  echo "<pre>"; print_r($data); die;
                $rules =[
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric',
                ];
                $customMessage =[
                    "vendor_name.required" => "Name is required",
                    "vendor_name.regex" => "Valid Name is required",
                    "vendor_cityrequired" => "City is required",
                    "vendor_city.regex" => "Valid City is required",
                    "vendor_mobile.required" => "Mobile is required",
                    "vendor_mobile.numeric" => "Valid Mobile is required",
                ];
                $this->validate($request ,$rules, $customMessage);
                // upload image 
                if($request->hasFile("vendor_image")){
                    $image_tmp = $request->file("vendor_image");
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'admin/images/photos/'.$imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                }else if(!empty($data['current_vendor_image'])){
                    $imageName = $data['current_vendor_image'];
                }else{
                    $imageName = "";
                }
    
                Admin::where('id',Auth::guard('admin')->user()->id)->update(
                    ['name' => $data['vendor_name'],'mobile' => $data['vendor_mobile'] , 'image' => $imageName]
                );
                Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update(
                    ['name' => $data['vendor_name'],'mobile' => $data['vendor_mobile'] ,'address' => $data['vendor_address'] ,
                    'city' => $data['vendor_city'] , 'country' => $data['vendor_country'] ,'state' => $data['vendor_state'] ,
                    'pincode' => $data['vendor_pincode'] , ]
                );
                return redirect()->back()->with('success_message','Name and Mobile has been update successfully!');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }else if($slug == "business"){
            if($request->isMethod('POST')){
                //dd($request->all());
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;
                $rules =[
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    'address_proof' => 'required',
               

                ];
                $customMessage =[
                    "shop_name.required" => "Name is required",
                    "shop_name.regex" => "Valid Name is required",
                    "shop_city.required" => "City is required",
                    "shop_city.regex" => "Valid City is required",
                    "shop_mobile.required" => "Mobile is required",
                    "shop_mobile.numeric" => "Valid Mobile is required",
                   

                ];
                $this->validate($request ,$rules, $customMessage);
                // upload image 
                if($request->hasFile("address_proof_image")){
                    $image_tmp = $request->file("address_proof_image");
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'admin/images/proofs/'.$imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                }else if(!empty($data['current_address_proof'])){
                    $imageName = $data['current_address_proof'];
                }else{
                    $imageName = "";
                }
    
               
                VendorBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(
                    ['shop_name' => $data['shop_name'],'shop_mobile' => $data['shop_mobile'] ,'shop_address' => $data['shop_address'] ,
                    'shop_city' => $data['shop_city'] , 'shop_country' => $data['shop_country'] ,'shop_state' => $data['shop_state'] ,
                    'shop_pincode' => $data['shop_pincode'] ,'business_license_number' => $data['business_license_number'] ,
                    'gst_number' => $data['gst_number'] ,'pen_number' => $data['pen_number'] ,'address_proof' => $data['address_proof'] ,
                    'address_proof_image' => $imageName , ]
                );
                return redirect()->back()->with('success_message','Name and Mobile has been update successfully!');
            }
            $vendorDetails = VendorBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }else if($slug == "bank"){
            if($request->isMethod('POST')){
                //dd($request->all());
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;
                $rules =[
                    'acount_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required',
                    'acount_number' => 'required|numeric',
                    'bank_ifsc_code' => 'required',
               

                ];
                $customMessage =[
                    "acount_holder_name.required" => "Account Holder Name is required",
                    "acount_holder_name.regex" => "Valid Account Holder Name is required",
                    "bank_name.required" => "Bank Name is required",
                    "acount_number.required" => "Account Number is required",
                    "acount_number.numeric" => "Valid Account Number is required",
                    "bank_ifsc_code.required" => "Bank IFSC Code is required",
                   ];
                $this->validate($request ,$rules, $customMessage);
            
    
               
                VendorBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(
                    ['acount_holder_name' => $data['acount_holder_name'],'bank_name' => $data['bank_name'] ,'acount_number' => $data['acount_number'] ,
                    'bank_ifsc_code' => $data['bank_ifsc_code'] ,  ]
                );
                return redirect()->back()->with('success_message','Name and Mobile has been update successfully!');
            }
            $vendorDetails = VendorBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }

        return view('admin.settings.update_vendor_details')->with(compact('slug','vendorDetails'));
    }

    public function admins($type=null){
        $admins = Admin::query();
        if(!empty($type)){
            $admins = $admins->where('type',$type);
            $title = ucfirst($type)."s";
        }else{
            $title = "All Admins/Subadmins/Vendors";
        }
        $admins = $admins->get()->toArray();
        //dd($admins);
        return view('admin.admins.admins')->with(compact('admins','title'));
    }
}
