<?php

namespace App\Console;

use Scara\Foundation\Application;
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
        $app = new Application();
        $app->boot();

        $this->_output = $output;
        $outputdir = base_path().'/docs';

        foreach ($this->views() as $view) {
            $viewname = str_replace('.blade.php', '', $view);
            $html = $outputdir.'/'.$viewname.'.html';

            $fh = fopen($html, 'w');
            $error = false;

            try {
                $view = new \Scara\Http\View();
                fwrite($fh, $view->compile($viewname));
                $output->writeln("View $viewname rendered to: $html");
            } catch (\Exception $ex) {
                $output->writeln("<error>Error rendering view: {$ex->getMessage()}</>");
                $error = true;
            }

            fclose($fh);

            if ($error) {
                unlink($html);
            }
        }
    }

    /**
     * Returns an array of renderable views.
     *
     * @return array
     */
    private function views()
    {
        $handle = opendir(app_path().'/views');
        $ignore = ['.', '..', 'layout', 'errors'];

        $files = [];

        while (false !== ($file = readdir($handle))) {
            if (!in_array($file, $ignore)) {
                $files[] = $file;
            }
        }

        closedir($handle);

        return $files;
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
                $f = "$from/$file";
                $t = "$to/$file";

                if (is_dir($f)) {
                    $this->_output->writeln("<info>Copying $f -> $t</>");
                    $this->copydir($f, $t);
                } else {
                    $this->_output->writeln("<info>Copying $f -> $t</>");
                    copy($f, $t);
                }
            }
        }

        closedir($dir);
    }
}
