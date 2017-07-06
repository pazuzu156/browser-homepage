<?php

if (!function_exists('base_path')) {
    /**
     * Gets the app's base path.
     *
     * @return string
     */
    function base_path()
    {
        return getcwd();
    }
}

if (!function_exists('storage_path')) {
    /**
     * Gets the app's storage path.
     *
     * @return string
     */
    function storage_path()
    {
        return base_path().'/storage';
    }
}

if (!function_exists('views_path')) {
    /**
     * Gets the app's views path.
     *
     * @return string
     */
    function views_path()
    {
        return base_path().'/html';
    }
}

if (!function_exists('views_cache')) {
    /**
     * Gets the app's view cache path.
     *
     * @return string
     */
    function views_cache()
    {
        return storage_path().'/cache';
    }
}
