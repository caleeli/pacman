<?php

namespace JDD\Pacman\Packages;

class LocalGit extends Repository
{
    const fileUrl = 'file://';

    protected function getContent($path)
    {
        $url = $this->repository . $path;
        return file_get_contents($url);
    }

    protected function getDefaultBranch()
    {
        $pwd = getcwd();
        chdir($this->repository);
        $branch = exec("git branch | grep \* | cut -d ' ' -f2");
        chdir($pwd);
        return $branch;
    }

    protected function parseRepository()
    {
        $path = substr($this->url, strlen(self::fileUrl));
        if (substr($path, 0, 1) !== '/') {
            $path = base_path($path);
        }
        return $path;
    }

    public static function is($url)
    {
        return substr($url, 0, strlen(self::fileUrl)) === self::fileUrl;
    }
}
