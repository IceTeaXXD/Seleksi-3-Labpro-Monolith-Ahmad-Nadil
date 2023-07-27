<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class GetController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getUser($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function getHistory()
    {
        $username = session('username');
        $history = History::where('username', $username)->get();

        return response()->json($history);
    }

    public function getAllUser()
    {
        $user = User::all();

        return response()->json($user);
    }

    public function getAllHistory()
    {
        $history = History::all();

        return response()->json($history);
    }
    
    public function getLogout()
    {
        session()->flush();

        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);

        return redirect('/');
    }
}
