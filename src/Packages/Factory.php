<?php

namespace JDD\Pacman\Packages;

class Factory
{
    private static $types = [
        Github::class,
        LocalGit::class,
    ];

    /**
     * Make a repository instance
     *
     * @param string $url
     *
     * @return Repository
     */
    public static function make($url)
    {
        foreach (self::$types as $class) {
            if ($class::is($url)) {
                return new $class($url);
            }
        }
    }
}
