<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use Auth;
use App\models\Admin;
use Image;

class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }

    public function settings(){
        Session::put('page','settings');
        $adminDetails=Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }
    
    

    public function login(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();

            // Default error message show code
            // $validated = $request->validate([
            //     'email' => 'required|email|max:255',
            //     'password' => 'required',
            // ]);

            //Custom error message display code start
            $rules=[
                'email' => 'required|email:rfc,dns|max:255',
                'password' => 'required',

            ];

            $customMessages=[
                'email.required'=>'Email address is required',
                'email.email:rfc,dns'=>'Email address is in incorrect form',
                'password.required'=>'Password is required',
            ];

            $this->validate($request,$rules,$customMessages);

            //Custom error message display code End

            //echo "<pre>"; print_r($data); die;
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                return redirect('admin/dashboard');
            }
            else{
                Session::flash('error_message','Incorrect email or password!');
                return redirect()->back();
            }
        }
       
        return view('admin.admin_login');
    }

    public function logout(){
        
            Auth::guard('admin')->logout();
            return redirect('/admin');
           
    }

    public function chkCurrentPassword(Request $request){
        $data=$request->all();
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            echo 'true';
        }
        else{
            echo 'false';
        }
        
    }

    public function updateCurrentPassword(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
                // Check if new and confirm password is matching
                if($data['new_pwd']==$data['confirm_pwd']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    Session::flash('success_message','Your set new password successfully');
                }
                else{
                    Session::flash('error_message','Your new password and confirm password is not matching');
                }
            }
            else{
                Session::flash('error_message','Your current password is incorrect');   
            }
            return redirect()->back();
        }

    }

    public function updateAdminDetails(Request $request){
        Session::put('page','update-admin-details');
        if($request->isMethod('post')){
            $data=$request->all();
                $rules=[
                    'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'admin_mobile' => 'required|numeric',
                    'admin_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    
                ];
    
                $customMessages=[
                    'admin_name.required'=>'Enter the name',
                    'admin_name.alpha'=>'Please Enter the valid name',
                    'admin_mobile.required'=>'Enter the mobile',
                    'admin_image.image'=>'Upload valid image',
                ];
    
                $this->validate($request,$rules,$customMessages);

                // Upload images

                if($request->hasFile('admin_image')){
                    $image_tmp=$request->file('admin_image');
                    if($image_tmp->isValid()){
                        $extension=$image_tmp->getClientOriginalExtension();
                        // Generate new image name
                        $imageName= rand(111,99999).".".$extension;
                        $imagePath='images/admin_images/admin_photos/'.$imageName;
                        // Upload the image
                        Image::make($image_tmp)->resize(300,400)->save($imagePath);
                    }
                    else if(!empty($data['current_admin_image'])){
                        $imageName= $data['current_admin_image'];
                    }
                    else{
                        $imageName= "";
                    }
                }

                Admin::where('email',Auth::guard('admin')->user()->email)
                ->update(['name' => $data['admin_name'],'mobile'=>$data['admin_mobile'],'image'=>$imageName]);
                Session::flash('success_message','Record updated successfully');
                return redirect()->back();
              
        }
        
        return view('admin.update_admin_details');
    }
}
