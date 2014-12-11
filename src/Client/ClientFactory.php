<?php

namespace Copier\Client;

class ClientFactory {

    public static function create($type, array $config)
    {
        if ($type == 'ssh')
        {
            return new Ssh($config);
        }
    }
} 