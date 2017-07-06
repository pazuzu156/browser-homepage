<?php

namespace Core;

class Application
{
    private $_view;

    public function __construct()
    {
        $this->_view = new View();
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
}
