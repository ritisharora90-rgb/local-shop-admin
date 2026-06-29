<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function showRegister()
{
    return view('admin.register');
}

public function register(Request $request)
{
    Admin::create([

        'name'=>$request->name,

        'email'=>$request->email,

        'password'=>Hash::make(
            $request->password
        )

    ]);

  return redirect('/admin/login')
->with(
'success',
'Admin Registered Successfully'
);
   
}

   public function login(Request $request)
{
    $admin = Admin::where(
        'email',
        $request->email
    )->first();

    if (
        $admin &&
        Hash::check(
            $request->password,
            $admin->password
        )
    ) {

       $request->session()->regenerate();

session([
    'admin' => true,
    'admin_name' => $admin->name
]);

        return redirect('/admin');
    }

    return back()
        ->with(
            'error',
            'Invalid Credentials'
        );
}
public function dashboard()
{
    $productsCount = 0;

     return view(
        'admin.dashboard',
        compact('productsCount')
    );
}
}