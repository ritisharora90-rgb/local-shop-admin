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
        // Generate unique shop_id from name
        $shopId = 'shop_' . strtolower(
            str_replace(' ', '_', $request->name)
        ) . '_' . time();

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'shop_id'  => $shopId,   // ← auto generate shop_id
        ]);

        return redirect('/admin/login')
            ->with('success', 'Admin Registered Successfully');
    }

    public function login(Request $request)
    {
        $admin = Admin::where(
            'email',
            $request->email
        )->first();

        if (
            $admin &&
            Hash::check($request->password, $admin->password)
        ) {
            $request->session()->regenerate();

            session([
                'admin'      => true,
                'admin_name' => $admin->name,
                'shop_id'    => $admin->shop_id,  // ← store shop_id in session
            ]);

            return redirect('/admin');
        }

        return back()->with('error', 'Invalid Credentials');
    }

    public function dashboard()
    {
        // Get logged in admin
        $admin = Admin::where(
            'name',
            session('admin_name')
        )->first();

        // Count only this admin's products
        $productsCount = $admin
            ? Product::where('shop_id', $admin->shop_id)->count()
            : 0;

        return view(
            'admin.dashboard',
            compact('productsCount')
        );
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/admin/login');
    }
}