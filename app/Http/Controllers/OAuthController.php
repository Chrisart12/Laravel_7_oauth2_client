<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OAuthController extends Controller
{
    public function redirect()
    {
        $queries = http_build_query([
            'client_id' => '4',
            'redirect_uri' => 'http://127.0.0.1:8001/oauth/callback',
            'response_type' => 'code'
        ]);
    
        return redirect('http://localhost:8000/oauth/authorize?'. $queries);
    }


    public function callback(Request $request)
    {

        $response = Http::post('http://127.0.0.1:8000/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => '4',
            'client_secret' => 'xmLjntdv3wQRccx4MDLL1UW5VL8YcjOArtCLNFxA',
            'redirect_uri' => 'http://127.0.0.1:8001/oauth/callback',
            'code' => $request->code
        ]);
        
        $response = $response->json();

        // dd($response);
        $request->user()->token()->delete();

        // dd($response);
        auth()->user()->token()->create([
            'access_token' => $response['access_token']
        ]);

        return redirect('/home');
    }
}
