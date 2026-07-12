<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Auth\Events\Registered;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
        public function store(Request $request,
        CreatesNewUsers $creator)
    {
        if (config('fortify.lowercase_usernames')) {
            $request->merge([
                Fortify::username() => Str::lower($request->{Fortify::username()}),
            ]);
        }

        event(new Registered($user = $creator->create($request->all())));

        // 🔥 登録直後にログインさせる
        \Auth::login($user);

        // 🔥 初回プロフィール設定画面へ遷移
        return redirect()->route('mypage.profile.first');
    }
}
