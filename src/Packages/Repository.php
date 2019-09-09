<?php

namespace JDD\Pacman\Packages;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Foundation\PackageManifest;

abstract class Repository
{
    protected $repository = '';
    protected $branch = 'master';
    protected $url = '';

    public function __construct($url)
    {
        $this->url = $url;
        $this->repository = $this->parseRepository();
        $this->branch = $this->getDefaultBranch();
        $this->json = json_decode($this->getContent('/composer.json'));
    }

    /**
     * Parse repository from url
     *
     * @return void
     */
    abstract protected function parseRepository();

    /**
     * Get repository file content
     *
     * @param string $path
     *
     * @return string
     */
    abstract protected function getContent($path);

    /**
     * Get default branch
     *
     * @return string
     */
    abstract protected function getDefaultBranch();

    protected function curlGet($endpoint, $query = [])
    {
        $client = new Client();
        $response = $client->request('GET', $endpoint, ['query' => $query]);
        return $response->getBody();
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getBranch()
    {
        return $this->branch;
    }

    public function getName()
    {
        return $this->json->name;
    }

    public function getDescription()
    {
        return $this->json->description;
    }

    public function getAuthors()
    {
        return isset($this->json->authors) ? $this->json->authors : [];
    }

    public function getIcon()
    {
        return isset($this->json->extra) && isset($this->json->extra->icon) ? $this->json->extra->icon : 'fas fa-box-open';
    }

    public function getStatus()
    {
        try {
            $manifest = app(PackageManifest::class);
            $installed = array_keys($manifest->manifest);
            return in_array($this->getName(), $installed) ? 'installed' : 'available';
        } catch (Exception $e) {
            return 'invalid';
        }
    }
}
