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
            'client_id' => '3',
            'redirect_uri' => 'http://127.0.0.1:8001/oauth/callback',
            'response_type' => 'code',
            'scope' => 'view-posts',
            // 'scope' => 'view-posts view-user'
        ]);
    
        return redirect('http://localhost:8000/oauth/authorize?'. $queries);
    }


    public function callback(Request $request)
    {

        $response = Http::post('http://127.0.0.1:8000/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => '3',
            'client_secret' => 'YJFHmUprsn0ih50KZ0xai2wQ9P7qpNSHUnqQBGGZ',
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
