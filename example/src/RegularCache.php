<?php

namespace Example;

use Closure;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zend\Cache\Storage\StorageInterface;

class RegularCache extends Command
{
    /** @var StorageInterface */
    protected $cache;

    /** @var Closure */
    protected $calculation;

    public function __construct(StorageInterface $cache, Closure $calculation)
    {
        $this->cache = $cache;
        $this->calculation = $calculation;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('example:regular-cache')
            ->setDescription('Caches expansive calculation result with zend cache');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $startTime = microtime(true);
        $result = $this->getResult();
        $output->writeln("<info>Result:</info>\t\t$result");
        $elapsedTime = round(microtime(true) - $startTime, 4);
        $output->writeln("<info>Elapsed Time:</info>\t$elapsedTime</info>");
    }

    protected function getResult()
    {
        if ($this->cache->hasItem('result')) {
            return $this->cache->getItem('result');
        }

        // The bellow code do not work with zend
        // $this->cache->setItem('result', $this->calculation);
        // $result = $this->cache->getItem('result');

        $calculation = $this->calculation;
        $result = $calculation();
        $this->cache->setItem('result', $result);

        return $result;
    }
}
