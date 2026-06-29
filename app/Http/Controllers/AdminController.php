<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Admin;

class AdminController extends Controller
{

    private function getAdmin()
    {
        return Admin::where(
            'name',
            session(
                'admin_name'
            )
        )->first();
    }



    public function dashboard()
    {

        $admin =
            $this->getAdmin();

        if (!$admin) {

            return redirect(
                '/admin/login'
            );

        }



        try {

            $productsCount =
                Product::where(
                    'shop_id',
                    $admin->shop_id
                )
                ->count();

        } catch (\Exception $e) {

            $productsCount =
                0;

        }



        try {

            $usersCount =
                User::count();

            $users =
                User::latest()
                ->take(8)
                ->get();

        } catch (\Exception $e) {

            $usersCount =
                0;

            $users =
                collect([]);

        }



        return view(
            'admin.dashboard',
            compact(
                'productsCount',
                'usersCount',
                'users',
                'admin'
            )
        );

    }




    public function users()
    {

        $users =
            User::all();

        return view(
            'admin.users',
            compact(
                'users'
            )
        );

    }

}
