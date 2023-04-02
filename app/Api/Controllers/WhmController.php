<?php

namespace App\Api\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;


class WhmController extends BaseController
{
    
    public function detail($domain) 
    {
        $cpanel = new \Gufy\CpanelPhp\Cpanel([
            'host'        =>  'https://linux.ekipisi.com:2087',
            'username'    =>  'root',
            'auth_type'   =>  'hash',
            'password'    =>   '4b76e06020618365fb839ee4604d8b4a
                                c1193a8c4003a53141d27453d418f869
                                b0227ff7a314c476ec6594a23bd73b9a
                                a3a096b067be90f1a726a277cd6641e1
                                a52c46bc7366fd5477b39619486da668
                                5337dda0681c062dac421bc23af99a06
                                eb157e893a37ef0cae49882254e39fe4
                                3fa1360c952662305d692aeb16b58782
                                8339737a9a1d8b24795e1f3516530b74
                                89a0ebf12f2ce776a463005d0aa75dc3
                                debb6630035913bd66fcfc9ec7464e8c
                                aaa34b211914dafec005ca4dab510d7d
                                9a2c92f522cdb519fcfcaf4492b396c5
                                227276821fb325534498cb305b7a6b68
                                a9013aea24e19a382d616bae1d9ff51c
                                f4e22fc8a2cd25aa735def376764fb9a
                                78a21cc554e169d4d4d13dc5574e6fff
                                9a538fa953bc9099b50141448ed91a06
                                84dae25fc46697712ccbb0bbe32bc116
                                e0691fe71409b221013258041e437528
                                14f38dbea1ee571db186d38d06f2f51e
                                bcacd12fba17e5119c5f0fb9c08dc6f7
                                9b7a938f1297573234575b33d0cd2f8d
                                8c15357553955e5d89ef204bb138a9a8
                                4a2c3b123c9245ad17824ccbca9c4859
                                8eb12af5a300be765decd0bc507d9ce9
                                34bf2a62868bda360f9312af91d2e891
                                addcf6da6db1ee7de2696bd3cec9e940
                                5f002cd03962b212f838ebfbaab720b1
                                a12c4b3af9f5e3369d971b4afd1f9db0'
        ]);
        // $accounts = json_decode($cpanel->listaccts());
        $result = json_decode($cpanel->cpanel('Stats', 'getmonthlydomainbandwidth', 'endamlibas'));
        $result = $result->cpanelresult->data;

        $list =[];

        var_dump($result);


    }


}
