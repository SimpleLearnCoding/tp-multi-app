<?php


namespace workerman;


use Workerman\Connection\ConnectionInterface;

interface WebSocketServiceInterface
{
    public function onWorkerStart(Worker $worker);
    public function onWorkerReload(Worker $worker);
    public function onConnect(ConnectionInterface $connection);
    public function onMessage(ConnectionInterface $connection, $data);
    public function onClose(ConnectionInterface $connection);
    public function onError(ConnectionInterface $connection, $code, $msg);
}
