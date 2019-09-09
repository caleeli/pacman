<?php

namespace JDD\Pacman\Console\Commands;

use Illuminate\Console\Command;

class AddRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     *
     * @var string
     */
    protected $signature = 'pacman:add-repository {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a repository to composer.json';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url');
        $path = base_path('composer.json');
        $composer = json_decode(file_get_contents($path));
        isset($composer->repositories) ?: $composer->repositories = [];
        if (substr($url, 0, 7) === 'file://') {
            $this->addLocalPath($composer, $url);
        } else {
            $this->addVcsUrl($composer, $url);
        }
        file_put_contents($path, json_encode($composer, JSON_PRETTY_PRINT));
    }

    /**
     * Add a vcs repository
     *
     * @param object $composer
     * @param string $url
     *
     * @return void
     */
    private function addVcsUrl($composer, $url)
    {
        $this->addRepository($composer, [
            'type' => 'vcs',
            'url' => $url,
        ]);
    }

    /**
     * Add a local path repository
     *
     * @param object $composer
     * @param string $url
     *
     * @return void
     */
    private function addLocalPath($composer, $url)
    {
        $this->addRepository($composer, [
            'type' => 'path',
            'url' => substr($url, 7),
        ]);
    }

    /**
     * Add the repository if not registered
     *
     * @param object $composer
     * @param array $repository
     *
     * @return void
     */
    private function addRepository($composer, $repository)
    {
        if (strpos(json_encode($composer->repositories), json_encode($repository)) === false) {
            $composer->repositories[] = $repository;
        }
    }
}
