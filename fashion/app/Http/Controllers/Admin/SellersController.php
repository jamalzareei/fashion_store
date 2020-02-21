<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;

class SellersController extends Controller
{
    //
    public function sellers(Request $request)
    {
        # code...
        $sellers = Seller::with('user')->paginate(1);

        return $sellers;
    }
}
