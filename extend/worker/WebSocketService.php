<?php


namespace worker;


use workerman\Connection\ConnectionInterface;
use workerman\WebSocketServiceInterface;
use Workerman\Worker;

/**
 * Class WebSocketService
 *
 * @author  linnzh
 * @created 2023/2/7 11:55
 */
abstract class WebSocketService extends \think\worker\Server implements WebSocketServiceInterface
{
    /**
     * @var string 服务协议
     * @support tcp udp unix http websocket text
     */
    protected $protocol = 'websocket';
    /**
     * @var int 监听端口
     */
    protected $port = 2345;

    /**
     * @var string[] 支持 workerman 的所有配置参数
     */
    protected $option = [
        'name' => 'Websocket',
    ];

    public function onWorkerStart(Worker $worker)
    {
        echo sprintf('%s worker status is %s' . PHP_EOL, date('Y-m-d H:i:s'), 'onWorkerStart');
    }

    public function onWorkerReload(Worker $worker)
    {
        echo sprintf('%s worker status is %s' . PHP_EOL, date('Y-m-d H:i:s'), 'onWorkerReload');
    }

    public function onConnect(ConnectionInterface $connection)
    {
        echo sprintf('%s worker status is %s' . PHP_EOL, date('Y-m-d H:i:s'), 'onConnect');
        $connection->send('成功连接！' . date('Y-m-d H:i:s'));
    }

    public function onMessage(ConnectionInterface $connection, $data)
    {
        echo sprintf('%s worker status is %s' . PHP_EOL, date('Y-m-d H:i:s'), 'onMessage');
    }

    public function onClose(ConnectionInterface $connection)
    {
        echo sprintf('%s worker status is %s' . PHP_EOL, date('Y-m-d H:i:s'), 'onClose');
        $connection->send('连接已关闭');
    }

    public function onError(ConnectionInterface $connection, $code, $msg)
    {
        echo sprintf('%s worker status is %s' . PHP_EOL, date('Y-m-d H:i:s'), 'onError');
        echo sprintf('Error [%d] $s' . PHP_EOL, $code, $msg);
        $connection->send('连接出错');
    }
}