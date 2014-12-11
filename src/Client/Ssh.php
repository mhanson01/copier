<?php

namespace Copier\Client;

class Ssh extends Client {

    function __construct($config)
    {
        parent::__construct($config);

        $this->connect();
    }

    public function connect()
    {
        $this->connection = ssh2_connect($this->config['host']);
        ssh2_auth_password($this->connection, $this->config['username'], $this->config['password']);
    }

    public function download($file)
    {
        return ssh2_scp_recv($this->connection, $file, __DIR__.'/../../storage/test.txt');
    }

    public function upload($source, $destination)
    {
        return ssh2_scp_send($this->connection, $source, $destination);
    }

}