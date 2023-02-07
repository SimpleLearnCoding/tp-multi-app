<?php


namespace app\admin\controller;


use think\response\Json;
use Workerman\Connection\ConnectionInterface;
use Workerman\Worker;

/**
 * Class WebsocketController
 *
 * @author  linnzh
 * @created 2023/2/7 11:02
 */
class WebsocketController extends \think\worker\Server
{
    protected $socket = 'websocket://0.0.0.0:2345';

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

        $couter = 0;
        while (true) {
            $connection->send($this->rawResponse(['message' => $data, 'time' => date('Y-m-d H:i:s')]));
            sleep(2);
            ++$couter;
            if ($couter > 20) {
                $connection->send($this->rawResponse(['message' => '超时，已离线', 'time' => date('Y-m-d H:i:s')]));
                $connection->close();
            }
        }

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

    private function rawResponse(array $data = null)
    {
        return Json::create($data)->getContent();
    }
}