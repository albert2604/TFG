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

    public function getFields($collection)
    {
        $items = $this->directusClient->fields($collection);

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

    public function updateItemById($collection, $id, $data)
    {
        try {
            $items = $this->directusClient->items($collection);

            // Crear elemento
            $item = $items->update($data, $id);
            return $item['data']['data'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteItemById($collection, $id, $data)
    {
        try {
            $items = $this->directusClient->items($collection);

            // Crear elemento
            $item = $items->update($data, $id);
            return $item['data']['data'];
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

    public function searchOneItem($collection, $filters)
    {
        try {
            $items = $this->directusClient->items($collection);

            // Crear elemento
            $item = $items->get($filters);

            if (count($item['data']['data']) == 1) {
                return $item['data']['data'][0];
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function searchManyItems($collection, $filters)
    {
        try {
            $items = $this->directusClient->items($collection);

            // Crear elemento
            $item = $items->get($filters);
            

            return $item['data']['data'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createFile($file)
    {
        try {

            $files = $this->directusClient->files();
            
            $new_file = $files->create([
                'name' => $file->getName(),
                'tmp_name' => $file->getTempName(),
            ]);

            return $new_file['data']['data']['id'];

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getFile($id)
    {
        try {

            $files = $this->directusClient->files();
            
            $file = $files->get($id);

            return $file['data']['data'];

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
