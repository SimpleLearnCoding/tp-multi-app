<?php

// +----------------------------------------------------------------------
// | Workerman设置 仅对 php think worker:server 指令有效
// +----------------------------------------------------------------------
return [
    /**
     * 以下信息可在 worker_class 服务类的类属性中配置
     */
    // 'protocol'       => 'websocket', // 协议 支持 tcp udp unix http websocket text
    // 'host'           => '0.0.0.0', // 监听地址
    // 'port'           => 2345, // 监听端口
    // 'socket'         => '', // 完整监听地址
    // 'context'        => [], // socket 上下文选项

    'worker_class'   => [
        \app\admin\controller\WebsocketController::class
    ], // 自定义Workerman服务类名 支持数组定义多个服务

    /**
     * 以下信息支持 workerman 的所有配置参数
     * 可以在 worker_class 服务类的 $option 中配置
     */
    'name'           => 'worker',
    'count'          => 4,
    'daemonize'      => false,
    'pidFile'        => '',
];
