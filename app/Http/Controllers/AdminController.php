<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        try {
            $productsCount = Product::count();
        } catch (\Exception $e) {
            $productsCount = 0;
        }

        try {

            $usersCount = User::count();

            $users = User::latest()
                ->take(8)
                ->get();

        } catch (\Exception $e) {

            $usersCount = 0;

            $users = collect([]);
        }

        return view(
            'admin.dashboard',
            compact(
                'productsCount',
                'usersCount',
                'users'
            )
        );
    }


    public function users()
    {
        $users = User::all();

        return view(
            'admin.users',
            compact('users')
        );
    }
}