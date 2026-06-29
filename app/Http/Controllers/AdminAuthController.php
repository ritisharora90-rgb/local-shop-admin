<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
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

        $validated =
            $request->validate([

                'name' =>
                'required|min:3',

                'email' =>
                'required|email|unique:admins,email',

                'password' =>
                'required|min:6'

            ]);


        $shopId =
            'shop_' .
            strtolower(
                preg_replace(
                    '/[^a-zA-Z0-9]/',
                    '',
                    $validated['name']
                )
            );


        Admin::create([

            'name' =>
            $validated['name'],

            'email' =>
            $validated['email'],

            'password' =>
            Hash::make(
                $validated['password']
            ),

            'shop_id' =>
            $shopId

        ]);


        return redirect(
            '/admin/login'
        )->with(
            'success',
            'Admin Registered Successfully'
        );

    }




    public function login(Request $request)
    {

        $admin =
            Admin::where(
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

            $request
                ->session()
                ->regenerate();


            session([

                'admin' =>
                true,

                'admin_name' =>
                $admin->name,

                'shop_id' =>
                $admin->shop_id

            ]);


            return redirect(
                '/admin'
            );

        }


        return back()
            ->with(
                'error',
                'Invalid Credentials'
            );

    }




    public function dashboard()
    {

        $admin =
            Admin::where(
                'name',
                session(
                    'admin_name'
                )
            )
            ->first();


        $productsCount =
            $admin
            ?
            Product::where(
                'shop_id',
                $admin->shop_id
            )
            ->count()
            :
            0;


        return view(
            'admin.dashboard',
            compact(
                'productsCount',
                'admin'
            )
        );

    }




    public function logout(Request $request)
    {

        $request
            ->session()
            ->flush();

        return redirect(
            '/admin/login'
        );

    }

}
