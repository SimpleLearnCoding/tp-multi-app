<?php


namespace app\admin\controller;


use worker\WebSocketService;
use Workerman\Connection\ConnectionInterface;

/**
 * Class WebsocketController
 *
 * @author  linnzh
 * @created 2023/2/7 11:02
 */
class WebsocketController extends WebSocketService
{
    /**
     * @var string[] 支持 workerman 的所有配置参数
     */
    protected $option = [
        'name' => 'Demo',
    ];

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

    private function rawResponse(array $data = null)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}