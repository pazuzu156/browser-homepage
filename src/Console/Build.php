<?php

namespace Core\Console;

use Core\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Build extends Command
{
    private $_output;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('build')
        ->setDescription('Builds the project');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->_output = $output;
        $app = new Application();
        $outputdir = base_path().'/output';

        if (!file_exists($outputdir) && !is_dir($outputdir)) {
            mkdir($outputdir, 0777);
        }

        foreach ($app->views() as $view) {
            $viewname = str_replace('.blade.php', '', $view);
            $html = $outputdir.'/'.$viewname.'.html';

            $fh = fopen($html, 'w');
            $error = false;

            try {
                fwrite($fh, $app->view()->render($viewname));
                $output->writeln('View '.$viewname.' rendered to: '.$html);
            } catch (\Exception $ex) {
                $output->writeln('<error>Error rendering view: '.$ex->getMessage().'</>');
                $error = true;
            }

            fclose($fh);

            if ($error) {
                unlink($html);
            }
        }

        $this->copydir(base_path().'/html/assets', base_path().'/output/assets');
    }

    /**
     * Handles copying entire directories.
     *
     * @param string $from - The directory to copy
     * @param string $to   - Where to place the directory
     *
     * @return void
     */
    private function copydir($from, $to)
    {
        $dir = opendir($from);
        @mkdir($to);
        $ignore = ['.', '..'];

        while (false !== ($file = readdir($dir))) {
            if (!in_array($file, $ignore)) {
                $f = $from.'/'.$file;
                $t = $to.'/'.$file;

                if (is_dir($from.'/'.$file)) {
                    $this->_output->writeln('<info>Copying '.$f.' -> '.$t.'</>');
                    $this->copydir($from.'/'.$file, $to.'/'.$file);
                } else {
                    $this->_output->writeln('<info>Copying '.$f.' -> '.$t.'</>');
                    copy($from.'/'.$file, $to.'/'.$file);
                }
            }
        }

        closedir($dir);
    }
}
