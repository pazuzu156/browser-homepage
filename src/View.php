<?php

namespace Core;

use Philo\Blade\Blade;
use Symfony\Component\HttpFoundation\Response;

class View
{
    /**
     * The view to be loaded.
     *
     * @var \Illuminate\View\View
     */
    private $_view;

    /**
     * The data to pass on to the view.
     *
     * @var array
     */
    private $_data = [];

    /**
     * The Blade Templating object.
     *
     * @var \Philo\Blade\Blade
     */
    private $_blade;

    /**
     * The Blade parsing Factory class.
     *
     * @var \Illuminate\View\Factory
     */
    private $_factory;

    /**
     * Class Constructor // Creates new Blade and View instances
     * Creates View instance from parsed Blade instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->createBlade(views_path(), views_cache());
    }

    /**
     * Creates a new Blade instance.
     *
     * @param string $views - The views path
     * @param string $cache - The cache path
     *
     * @return void
     */
    public function createBlade($views, $cache)
    {
        $this->_blade = new Blade($views, $cache);
        $this->_view = $this->_blade->view();
    }

    /**
     * Adds data to pass onto the view.
     *
     * @param string $key   - The key of the data to pass through
     * @param string $value - The $key's value
     *
     * @return \Scara\Http\View
     */
    public function with($key, $value = null)
    {
        if (is_array($key)) {
            $this->_data = array_merge($this->_data, $key);
        } else {
            $this->_data[$key] = $value;
        }

        return $this;
    }

    /**
     * Renders the view.
     *
     * @param string $path - The path of the view
     *
     * @return mixed
     */
    public function render($path)
    {
        $this->parseContent($path, $this->_data);
        return $this->_factory->render();
    }

    /**
     * Parses the view using the Blade Factory.
     *
     * @param string $path - The path of the view to parse
     * @param string $data - Data to pass on to the view
     *
     * @return void
     */
    private function parseContent($path, $data)
    {
        $path = str_replace('.', '/', $path);
        $this->_factory = $this->_view->make($path, $data);
    }
}
