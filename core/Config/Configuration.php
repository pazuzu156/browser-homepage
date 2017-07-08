<?php

namespace Core\Config;

class Configuration
{
    /**
     * Gets the config value.
     *
     * @param string $key        - The config item's key
     * @param string $configFile - Optional if you want to load a specific config file
     *
     * @return mixed
     */
    public function get($key)
    {
        $config = require base_path().'/config.php';
        return $this->sift($config, explode('.', $key));
    }

    /**
     * Sifts through given items to load config arrays/items.
     *
     * @param mixed $config
     * @param mixed $items
     *
     * @return mixed
     */
    private function sift($config, $items)
    {
        foreach ($items as $item) {
            if (is_array($config[$item])) {
                if (count($items) > 1) {
                    array_shift($items);

                    return $this->sift($config[$item], $items);
                }

                return $config[$item];
            } else {
                return $config[$item];
            }
        }
    }
}
