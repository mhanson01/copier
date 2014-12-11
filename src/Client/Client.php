<?php

namespace Copier\Client;

abstract class Client {

    protected $connection;
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }
} 