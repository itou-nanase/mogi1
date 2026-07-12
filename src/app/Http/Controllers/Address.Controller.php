<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Address.Controller extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'postal_code' => 'required',
            'address' => 'required',
            'building' => 'nullable',
        ]);

        $user = auth()->user();
        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->building = $request->building;
        $user->save();

        return redirect()->back()->with('success', '住所を更新しました');
    }
}
