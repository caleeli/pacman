<?php

namespace JDD\Pacman\Packages;

class Github extends Repository
{
    const gitUrl = 'https://github.com';
    const contentUrl = 'https://raw.githubusercontent.com';
    const apiUrl = 'https://api.github.com';

    protected function getContent($path)
    {
        $url = self::contentUrl . '/' . $this->repository . '/' . $this->branch . $path;
        return file_get_contents($url);
    }

    protected function getDefaultBranch()
    {
        $json = $this->api('/repos/' . $this->repository);
        return $json->default_branch;
    }

    protected function parseRepository()
    {
        return substr($this->url, strlen(self::gitUrl) + 1);
    }

    private function api($url)
    {
        return json_decode($this->curlGet(self::apiUrl . $url));
    }

    public static function is($url)
    {
        return substr($url, 0, strlen(self::gitUrl)) === self::gitUrl;
    }
}
