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
use Illuminate\Support\Facades\Hash;

class PostController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function postUser(Request $request)
    {
        $user = new User;

        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $userExists = User::where('username', $user->username)->exists();

        if ($userExists) {
            return redirect('/register')->withErrors(['register' => 'User already exists, try using a different username.']);
        } else {
            $user->save();
            return redirect('/login');
        }
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

    public function postLogin(Request $request)
    {
        // set the session username
        session(['username' => $request->input('username')]);
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                // User credentials are valid, generate a new JWT token
                $token = JWTAuth::fromUser($user);

                // Return the token in the response
                return redirect('/catalog')-> withCookie(cookie('token', $token, 60));
                
            } else {
                return redirect('/login')->withErrors(['login' => 'Invalid username or password.']);
            }
        } else {
            return redirect('/login')->withErrors(['login' => 'Invalid username or password.']);
        }
    }

    public function postPurchase(Request $request)
    {
        // get item id and quantity from the request
        $item_id = $request->input('item_id');
        $quantity = $request->input('quantity');
        $quantity = intval($quantity);
        echo $item_id;
        echo $quantity;

        // post the purchase request to the purchase service
        $url = env('BE_URL') . '/buy';

        // set the post data in json format
        $data = array(
            'id_barang' => $item_id,
            'jumlah_barang' => $quantity,
        );
    
        $postData = json_encode($data);

        // create a new curl resource
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);

        curl_close($ch);

        // convert the response to a PHP associative array
        $response_data = json_decode($response, true);

        // print the response data
        print_r($response_data);

        // check if the request was successful
        if ($response_data['status'] === "success") {
            // get the item data
            $item = $response_data['data'];

            // create a new history record
            $history = new History;

            $history->username = session('username');
            $history->nama_barang = $item['nama'];
            $history->jumlah_barang = $quantity;
            $history->total_harga = $item['harga'] * $quantity;

            $history->save();

            return redirect('/catalog');
        } else {
            return response()->json(['message' => 'Error purchasing item']);
        }
    }
}
