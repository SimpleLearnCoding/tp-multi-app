<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        return json(['code' => 200, 'msg' => 'Successful', 'data' => ['app' => 'api']], 200, ['Content-Type' => 'application/json']);
    }
}
