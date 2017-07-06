<?php

namespace Core;

class TemplateHelper extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            'views_path' => new \Twig_SimpleFunction('views_path'),
        ];
    }
}
