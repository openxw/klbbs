<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
// use GuzzleHttp\ClientInterface;
// use Illuminate\Http\RedirectResponse;
// use Laravel\Socialite\Two\ProviderInterface;


class wx extends Controller
{

protected function getHttpClient(array $options = [])
    {
        return new Client($options);
    }

    public function register(Request $request)
    {
        # code...


        $code = $request->code;

        $URL = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WEIXIN_KEY')."&secret=" . env('WEIXIN_SECRET') . "&code=" . $code . "&grant_type=authorization_code";

        $response = $this->getHttpClient()->get($URL);
        $user = json_decode($response->getBody(), true);

        $accsee_token= $user['access_token'];
        $openid = $user['openid'];

        $userUrl = "https://api.weixin.qq.com/sns/userinfo?access_token=". $accsee_token ."&openid=". $openid . "&lang=zh_CN";
        $response1 = $this->getHttpClient()->get($userUrl);
        $userinfo = json_decode($response1->getBody(), true);

        dd($userinfo);
        return redirect($URL);
    }
}
