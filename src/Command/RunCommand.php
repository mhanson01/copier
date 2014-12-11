<?php

namespace Copier\Command;

use Copier\Client\ClientFactory;
use Copier\Config\Config;
use Copier\Job\Job;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command
{
    protected function configure()
    {
        $this->setName('run')
            ->setDescription('Run the specified job')
            ->addArgument(
                'job',
                InputArgument::REQUIRED,
                'The job you want to run'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $job_name = $input->getArgument('job');

        $job = new Job($job_name, $output);

        $job->getFile();

        $job->writeFile();

        $job->cleanUp();

        $output->writeln('<info>Done!</info>');
    }

}
