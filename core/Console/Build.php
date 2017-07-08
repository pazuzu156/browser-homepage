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
        $outputdir = base_path().'/docs';

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
    }
}
