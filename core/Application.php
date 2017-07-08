<?php

namespace Core;

use Core\Config\Configuration;
use Core\Utils\Alias;

class Application
{
    private $_view;

    private $_alias;

    public function __construct()
    {
        $this->_view = new View();
        $this->_alias = new Alias();

        $this->boot();
    }

    public function view()
    {
        return $this->_view;
    }

    public function views()
    {
        $handle = opendir(views_path());
        $ignore = ['.', '..', 'assets', 'layout'];

        $files = [];

        while ($file = readdir($handle)) {
            if (!in_array($file, $ignore)) {
                $files[] = $file;
            }
        }

        closedir($handle);

        return $files;
    }

    private function boot()
    {
        $this->_alias->registerAliases();
    }
}
