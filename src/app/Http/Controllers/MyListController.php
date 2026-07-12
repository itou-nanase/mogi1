<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;


class MyListController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = $user->likes()->with('product');

        if ($request->filled('keyword')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        $products = $query->get()->pluck('product');

        return view('products.mylist', compact('products'));
    }
}
