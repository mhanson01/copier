<?php

namespace Copier\Config;

use Symfony\Component\Console\Output\OutputInterface;

class Config {

    protected $connections;

    protected $jobs;

    public function __construct($job = null, OutputInterface $output)
    {
        $this->parser = new Parser($job, $output);

        if ($job) {
            $this->source = $this->parser->source();
            $this->destination = $this->parser->destination();
        }
    }

    public function source()
    {
        return $this->parser->source();
    }

    public function destination()
    {
        return $this->parser->destination();
    }
} 