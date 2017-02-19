<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeployController extends Controller
{

    public function deploy(){

        $target = '/var/www/http/wechat';
        //$token = '';

        //$json = json_decode(file_get_contents('php://input'), true);

        //if (empty($json['token']) || $json['token'] !== $token) {
        //    exit('error request');
        //}

        $cmd = "cd $target && git reset --hard origin/master && git clean -f && git pull 2>&1 && git checkout master";
        //$cmd = "cd $target && git pull origin master";
var_dump($cmd);
        $result = shell_exec($cmd);
var_dump($cmd);
    }



}
