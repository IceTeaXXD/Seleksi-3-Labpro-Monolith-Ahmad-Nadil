<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;

class GetController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getUser($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function getHistory($id)
    {
        $history = History::find($id);

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
