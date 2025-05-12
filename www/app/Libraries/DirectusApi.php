<?php

namespace App\Libraries;

use AlanTiller\DirectusSdk\Directus;
use AlanTiller\DirectusSdk\Auth\ApiKeyAuth;
use AlanTiller\DirectusSdk\Storage\SessionStorage;
use PhpParser\Node\Stmt\TryCatch;

class DirectusApi
{
    private $directusClient;

    public function __construct()
    {
        $baseUrl = env('DIRECTUS_BASE_URL');
        $apiKey = env('DIRECTUS_API_KEY');
        $storage = new SessionStorage('directus_'); // Optional prefix
        $auth = new ApiKeyAuth($apiKey);

        $this->directusClient = new Directus(
            $baseUrl,
            $storage,
            $auth
        );
    }

    public function getAllItems($collection)
    {
        $items = $this->directusClient->items($collection);

        // Get all items
        $all_items = $items->get();

        return $all_items['data']['data'];
    }

    public function createItem($collection, $data)
    {
        try {
            $items = $this->directusClient->items($collection);

            // Crear elemento
            $created_item = $items->create($data);

            return $created_item['data']['data'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getItemById($collection, $id)
    {
        try {
            $items = $this->directusClient->items($collection);

            // Crear elemento
            $item = $items->get($id);
            return $item['data']['data'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function searchOneItem($collection, $filters){
        try {
            $items = $this->directusClient->items($collection);

            // Crear elemento
            $item = $items->get($filters);

            if(count($item['data']['data']) == 1){
                return $item['data']['data'][0];
            }
            else{
                return false;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function searchManyItems($collection, $filters){
        try {
            $items = $this->directusClient->items($collection);

            // Crear elemento
            $item = $items->get($filters);
            
            return $item['data']['data'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
