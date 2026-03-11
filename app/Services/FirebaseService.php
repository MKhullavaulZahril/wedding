<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));

        $this->database = $factory->createDatabase();
    }

    /**
     * Get a reference to a path.
     */
    public function getReference($path = '/')
    {
        return $this->database->getReference($path);
    }

    /**
     * Get data from a path.
     */
    public function getData($path)
    {
        return $this->database->getReference($path)->getValue();
    }

    /**
     * Set data at a path (overwrites).
     */
    public function setData($path, $data)
    {
        return $this->database->getReference($path)->set($data);
    }

    /**
     * Push data to a path (generates unique key).
     */
    public function pushData($path, $data)
    {
        return $this->database->getReference($path)->push($data);
    }

    /**
     * Update data at a path.
     */
    public function updateData($path, $data)
    {
        return $this->database->getReference($path)->update($data);
    }

    /**
     * Delete data at a path.
     */
    public function deleteData($path)
    {
        return $this->database->getReference($path)->remove();
    }

    /**
     * Get data with caching.
     */
    public function getCachedData($path, $durationMinutes = 10)
    {
        return \Illuminate\Support\Facades\Cache::remember("firebase_cache_" . str_replace(['/', '\\'], '_', $path), now()->addMinutes($durationMinutes), function () use ($path) {
            return $this->getData($path);
        });
    }

    /**
     * Get data with limit.
     */
    public function getDataLimited($path, $limit = 10)
    {
        return $this->database->getReference($path)->orderByKey()->limitToFirst($limit)->getValue();
    }

    /**
     * Get data with limit and caching.
     */
    public function getCachedDataLimited($path, $limit = 10, $durationMinutes = 10)
    {
        return \Illuminate\Support\Facades\Cache::remember("firebase_cache_ltd_{$limit}_" . str_replace(['/', '\\'], '_', $path), now()->addMinutes($durationMinutes), function () use ($path, $limit) {
            return $this->getDataLimited($path, $limit);
        });
    }

    /**
     * Get filtered data from Firebase.
     */
    public function getDataFiltered($path, $orderBy, $equalTo, $limit = 50)
    {
        return $this->database->getReference($path)
            ->orderByChild($orderBy)
            ->equalTo($equalTo)
            ->limitToFirst($limit)
            ->getValue();
    }

    /**
     * Get filtered data with caching.
     */
    public function getCachedDataFiltered($path, $orderBy, $equalTo, $limit = 50, $durationMinutes = 15)
    {
        $cacheKey = "firebase_cache_filtered_" . str_replace(['/', '\\'], '_', $path) . "_{$orderBy}_{$equalTo}_{$limit}";
        return \Illuminate\Support\Facades\Cache::remember($cacheKey, now()->addMinutes($durationMinutes), function () use ($path, $orderBy, $equalTo, $limit) {
            return $this->getDataFiltered($path, $orderBy, $equalTo, $limit);
        });
    }
}
