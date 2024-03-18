<?php

namespace App\Http\Controllers;

use App\Models\User; // Userモデルをインポート
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);
        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        // 特定のユーザーを取得
        $user = User::findOrFail($id);
        // ユーザー詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
        ]);
    }
}
