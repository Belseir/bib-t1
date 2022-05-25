<?php

include(__DIR__ . "/WebSocketServer.php");

class OnlineUsersServer extends WebSocketServer
{

    function __construct($addr, $port, $bufferLength)
    {
        parent::__construct($addr, $port, $bufferLength);
    }

    //protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.

    protected function process($user, $message)
    {
        $this->send($user, $message);
    }

    protected function connected($user)
    {
        foreach ($this->users as $user) {
            $this->send($user, count($this->users));
        }
    }

    protected function closed($user)
    {
        // Do nothing: This is where cleanup would go, in case the user had any sort of
        // open files or other objects associated with them.  This runs after the socket 
        // has been closed, so there is no need to clean up the socket itself here.
    }
}

$server = new OnlineUsersServer("localhost", "9000", 1048576);

try {
    $server->run();
} catch (Exception $e) {
    $server->stdout($e->getMessage());
}
