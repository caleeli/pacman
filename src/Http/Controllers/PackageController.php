<?php

namespace JDD\Pacman\Http\Controllers;

use App\Http\Controllers\Controller;
use JDD\Pacman\Http\Resources\PackageCollection;
use JDD\Pacman\Packages\Factory;

class PackageController extends Controller
{
    /**
     * 
     * @return PackageCollection
     * 
     *  @OA\Get(
     *      tags={"jdd-pacman"},
     *      path="/api/pacman/package",
     *      summary="List of packages",
     *      @OA\Response(
     *          response=200,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/PacmanPackage"),
     *              )
     *          ),
     *          description="List of packages",
     *      )
     *  )
     */
    public function index()
    {
        $packages = [];
        foreach (config('pacman.repositories') as $repository) {
            $package = Factory::make($repository);
            $packages[] = $package;
        }
        return new PackageCollection(collect($packages));
    }
}
