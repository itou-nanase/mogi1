<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();

        return redirect()->route('products.index'); // ← 商品一覧へ固定

    }
}
