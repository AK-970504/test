<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function register(Request $request) {
        $validated = $request->validate ([
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
        ], [
        	'password.min' => 'パスワードは6文字以上で入力してください。',
        	'email.unique' => 'このメールアドレスは既に登録されています。',
		]);
		try {
			User::create([
				'password' => Hash::make($validated['password']),
				'email' => $validated['email'],
			]);
		} catch (\Exception $e) {
			Log::error('ユーザー登録失敗: ' . $e->getMessage());
			return back()->withErrors(['error' => 'ユーザー登録に失敗しました。']);
		};
        return redirect('user_login')->with('success', 'ユーザー登録が完了しました。ログインしてください。');
    }
	public function login(Request $request) {
		$credentials = $request->validate([
			'password' => 'required',
			'email' => 'required|email',
		]);
		Log::info(session()->getId());
		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();
			Log::info('ログイン成功', [
				'user' => Auth::user(),
				'session_id' => session()->getId(),
				'session_date' => session()->all(),
			]);
			Log::info('セッション確認', session()->all());
			Log::info('ログイン直後のセッション情報', session()->all());
			Log::info('認証状態', ['auth' => Auth::check()]);
			Log::info('現在のユーザー:', ['user' => Auth::user()]);
			Log::info(session()->getId());
			return redirect()->route('product_list');
		};
		if (Auth::check()) {
			Log::info('認証済みユーザー: ' . Auth::user()->email);
		} else {
			Log::info('未認証ユーザー');
		};
		return back()->withErrors([
			'email' => 'メールアドレスかパスワードが違います。',
		]);
	}
	protected function redirectTo($request) {
		if (! $request->expectsJson()) {
			Log::info('未認証のためリダイレクト', [
				'url' => $request->fullUrl(),
				'session' => session()->all(),
				'authenticated' => auth()->check(),
		]);
		return route('user_login')->with('message', 'ログインしてください');
	}
}
}
