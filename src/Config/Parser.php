<?php  namespace Copier\Config;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Parser as BaseParser;

class Parser extends BaseParser {

    protected $config;
    /**
     * @var int
     */
    private $job;
    /**
     * @var OutputInterface
     */
    private $output;

    function __construct($job = null, OutputInterface $output)
    {
        $this->config = $this->parse(file_get_contents(__DIR__ . '/../../config/config.yaml'));
        $this->job = $job;
        $this->output = $output;
    }

    public function source()
    {
        return $this->load('source');
    }

    public function destination()
    {
        return $this->load('destination');
    }

    private function load($type)
    {
        if ( ! isset($this->config['jobs'][$this->job])) {
            $this->output->writeln("<error>Job not found</error>");;
            exit(1);
        }

        $path       = $this->config['jobs'][$this->job][$type]['path'];
        $connection = $this->config['jobs'][$this->job][$type]['connection'];

        $host       = $this->config['connections'][$connection]['host'];
        $username   = $this->config['connections'][$connection]['username'];
        $password   = $this->config['connections'][$connection]['password'];
        $client     = $this->config['connections'][$connection]['client'];

        return compact('path', 'host', 'username', 'password', 'client');
    }

    public function jobs()
    {
        return $this->extract('jobs');
    }

    public function connections()
    {
        return $this->extract('connections');
    }

    public function extract($type)
    {
        $array = array_keys($this->config[$type]);

        foreach($array as $name)
        {
            $collection[] = [$name];
        }

        return $collection;
    }
}