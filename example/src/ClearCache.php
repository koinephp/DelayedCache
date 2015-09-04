<?php

namespace Example;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearCache extends RegularCache
{
    protected function configure()
    {
        $this->setName('example:clear-cache')
            ->setDescription('Clears cache');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->cache->removeItem('result');
        $output->writeln('<info>Cache cleared.</info>');
    }
}
