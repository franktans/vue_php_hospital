<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/17
 * Time: 11:58
 */

namespace app\common\behavior;

use think\Response;
class Cors
{
    public function run(&$dispatch){
        header("Access-Control-Allow-Origin:localhost:8080");
        $host_name = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : "*";
        $headers = [
            "Access-Control-Allow-Origin" => $host_name,
            "Access-Control-Allow-Credentials" => 'true',
            "Access-Control-Allow-Headers" => "Content-Type, Authorization, X-Requested-With"
        ];
        if($dispatch instanceof Response) {
            $dispatch->header($headers);
        } else if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            $dispatch['type'] = 'response';
            $response = new Response('', 200, $headers);
            $dispatch['response'] = $response;
        }
    }
}
