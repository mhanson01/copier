<?php

namespace Copier\Command;

use Copier\Config\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class JobsCommand extends Command
{
    protected function configure()
    {
        $this->setName('jobs')
            ->setDescription('View all of the jobs configured');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = new Config(null, $output);

        $jobs = $config->parser->jobs();

        $table = new Table($output);

        $table->setHeaders(['Job Name'])
            ->setRows($jobs)
            ->render();
    }

}
