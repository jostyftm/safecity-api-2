<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CityService
{

    /**
     * @var string $keyCache
     */
    private string $keyCache = 'city';

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * List City
     * 
     * @param Request $request
     * @return Collection
     */
    public function list(Request $request): Collection | AbstractPaginator
    {
        $cities = City::all();

        return $cities;
    }

    /**
     * Get City
     * 
     * @param City $city
     * @return City
     */
    public function get(City $city): ?City
    {
        $cityResponse = Cache::remember("{$this->keyCache}_{$city->id}", 86400, function () use ($city) {
            return $city;
        });

        return $cityResponse;
    }

    /**
     * Save City
     * 
     * @param Request $request
     * @return City
     */
    public function save(Request $request): City
    {
        $city = City::create($request->validated());

        return $city;
    }

    /**
     * Update City
     * 
     * @param Request $request
     * @return City
     */
    public function update(Request $request, City $city): City
    {
        $city->update($request->validated());

        return $city;
    }

    /**
     * Delete City
     * 
     * @param City $city
     * @return void
     */
    public function delete(City $city): void
    {
        $city->delete();
    }
}
