<?php

namespace Copier\Command;

use Copier\Config\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class ConnectionsCommand extends Command
{
    protected function configure()
    {
        $this->setName('connections')
            ->setDescription('View all of the connections configured');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = new Config(null, $output);

        $connections = $config->parser->connections();

        $table = new Table($output);

        $table->setHeaders(['Connection Name'])
            ->setRows($connections)
            ->render();
    }

}
