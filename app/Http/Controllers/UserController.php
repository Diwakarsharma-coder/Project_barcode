<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //home page
    public function welcome()
    {
        $data = User::where('status','1')->get();
        return view('welcome',compact('data'));
    }

    // // User list
    // public function list()
    // {
    //     $data = User::where('status','1')->get();
    //     return view('list',compact('data'));
    // }

    // open register page
    public function register(){

        return view('register');

    }

    //store user details
    public function store(Request $request)
    {
          $this->validateRequest();

            $input=$request->all();

            $insert = new User();
            $insert->first_name =$input['firstName'];
            $insert->last_name =$input['lastName'];
            $insert->email =$input['email'];
            $insert->password =Hash::make($input['password']);
            $insert->save();
                    
             $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
                        
            Session::put('success', "Register and Login successfully.");

            return response()->json(['success' => true]);

           // return redirect()->route('list')->with('success', 'Record Added successfully.');

    }



    // Start Display User Details
    public function view($id)
    {   
        $data = User::find($id);
        return view('view',compact('data'));
    }
    // End Display User Details



    // Start Open User Details For Edit
    public function edit($id)
    {
        if(Auth::user()->id == $id)
        {
            $data = User::find($id);
            return view('edit',compact('data'));
        }
        else
        {
            return redirect("/home");

        }
        
    }


    // Start Update User Details
    public function update(Request $request, $id){

         $this->validateRequest($id);

            $input=$request->all();
            $images=array();
            $image_data = $input['old_image'];
            if($files=$request->file('image')){
                    $name=rand().'.'.$files->extension();
                    $files->move(public_path('uploads'),$name);
                    $images=$name;
                
                $image_data = $images;
            }


            $insert = User::find($id);
            $insert->first_name =$input['firstName'];
            $insert->last_name =$input['lastName'];
            $insert->image=   $image_data;
            $insert->save();

                Session::put('success', "Record updated successfully.");

                // $_SESSION["success"] = "true";
            
             return response()->json(['success' => true]);

              // return redirect()->route('list')->with('success', 'Record updated successfully.');

       

    }


    //validation for register user
    public function validateRequest($id = "")
    {
        if ($id != "") {
            $validateData = request()->validate([
                
                'firstName' => 'required',
                'lastName' => 'required',


            ], [
                'firstName.required'=>'Please enter first name',
                'lastName.required'=>'Please enter last name',
               
            ]);
        } else {
            $validateData = request()->validate([
                
                'email' => [
                    'required', 'email',
                    Rule::unique('users')->ignore($id)->where(function ($query) use ($id) {
                        return $query->where('status', '!=', '2');
                    }),
                ],
                'firstName' => 'required',
                'lastName' => 'required',
                'password' => ' required | min:8',
                'confirmPassword' => 'required_with:password|same:password|min:8',
                
            ], [

                'firstName.required'=>'Please enter first name',
                'lastName.required'=>'Please enter last name',
                'email.required'=>'Please enter email',
                'password.required'=>'Please enter password',
                'confirmPassword.required'=>'Please enter confirm password',
            ]);
        }
        return $validateData;

    }

    //open login page
    public function login()
    {

        return view('login');
    }

    //login user 
    public function datalogin(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required'=>'Please enter user name',
            'password.required'=>'Please enter password',

        ]);
        

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {

                    Session::put('success', "login successfully.");

                    return response()->json(['success' => true]);
                }    
                else
                {
                     return response()->json(['success' => false]);

                }

    }




    public function editProfile(){

        return view('editbarcode');
    }

    // Open Dashboard
    public function dashboard()
    {
            if(Auth::check()){
                return view('dashboard');
            }
      
            return redirect("login")->withErrors('Opps! You do not have access');
    }

    // logout
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }
}
