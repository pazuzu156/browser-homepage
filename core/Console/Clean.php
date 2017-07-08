<?php

namespace Core\Console;

use Core\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Clean extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('clean')
        ->setDescription('Cleans rendered output and view cache');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handle = opendir(views_cache());
        $ignore = ['.', '..', '.gitkeep', 'assets'];

        while ($file = readdir($handle)) {
            if (!in_array($file, $ignore)) {
                unlink(views_cache().'/'.$file);
            }
        }

        closedir($handle);
        $handle = opendir(base_path().'/docs');

        while ($file = readdir($handle)) {
            if (!in_array($file, $ignore)) {
                unlink(base_path().'/docs/'.$file);
            }
        }

        $output->writeln('<info>Done</>');
    }
}
