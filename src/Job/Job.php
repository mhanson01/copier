<?php

namespace Copier\Job;

use Copier\Client\ClientFactory;
use Copier\Config\Config;
use Symfony\Component\Console\Output\OutputInterface;

class Job {

    private $name;
    /**
     * @var OutputInterface
     */
    private $output;

    function __construct($name, OutputInterface $output)
    {
        $this->name = $name;
        $this->output = $output;

        $this->config = new Config($this->name, $output);

        $this->source = ClientFactory::create('ssh', $this->config->source());
        $this->destination = ClientFactory::create('ssh', $this->config->destination());
    }

    function cleanUp()
    {
        @unlink(__DIR__.'/../../storage/test.txt');
    }

    public function getFile()
    {
        $file = $this->config->source()['path'] . 'test.txt';
        $this->source->download($file);
        $this->output->writeln('<info>Source File Downloaded!</info>');

    }

    public function writeFile()
    {
        $local = __DIR__.'/../../storage/test.txt';
        $destination_file = $this->config->destination()['path'] . 'test.txt';
        $this->destination->upload($local, $destination_file);
        $this->output->writeln('<info>Destination File Uploaded!</info>');
    }
}