<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getUser($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function postUser(Request $request)
    {
        $user = new User;

        $user->username = $request->input('username');
        $user->password = $request->input('password');
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return response()->json($user);
    }

    public function getHistory($id)
    {
        $history = History::find($id);

        return response()->json($history);
    }

    public function postHistory(Request $request)
    {
        $history = new History;

        $history->username = $request->input('username');
        $history->nama_barang = $request->input('nama_barang');
        $history->jumlah_barang = $request->input('jumlah_barang');
        $history->total_harga = $request->input('total_harga');

        $history->save();

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
}
