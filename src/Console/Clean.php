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
        if (file_exists(base_path().'/output')) {
            $this->rmrf(base_path().'/output');
        }

        $handle = opendir(views_cache());
        $ignore = ['.', '..', '.gitkeep'];

        while ($file = readdir($handle)) {
            if (!in_array($file, $ignore)) {
                unlink(views_cache().'/'.$file);
            }
        }

        $output->writeln('<info>Done</>');
    }

    /**
     * Handled removing a directory recursively.
     *
     * @param string $dir - The directory to remove
     *
     * @return void
     */
    private function rmrf($dir)
    {
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) {
                continue;
            }

            if (is_dir("$dir/$file")) {
                $this->rmrf("$dir/$file");
            } else {
                unlink("$dir/$file");
            }
        }

        rmdir($dir);
    }
}
