<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\ItemHistory;
use Carbon\Carbon;
use Engine\Request;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;

final class ItemController
{
    public function index()
    {
        echo Item::all();
        die();
    }

    public function show(Request $request)
    {
        $itemId = $request->data['routeInfo'][2]['id'];
        $item = Item::query()->find($itemId);
        if($item)  {
            echo $item;
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Item not found'
            ]);
        }
        die();
    }

    public function save(Request $request)
    {
        $fields = $request->data['fields'];

        $createItem = Item::query()->create($fields);

        if($createItem) {
            echo json_encode([
                'status' => 'success',
                'item' => $createItem,
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed'
            ]);
        }
        die();
    }

    public function update(Request $request)
    {
        $fields = $request->data['fields'];
        $itemId = $request->data['routeInfo'][2]['id'];

        $updateItem = Item::query()->find($itemId);

        if($updateItem) {
            try {
                DB::transaction(function () use ($updateItem, $fields) {
                    $updateItem->update($fields);

                    $updateItem->historyChange()->create([
                        'data' => $fields,
                        'created_at' => Carbon::now(),
                    ]);

                    echo json_encode([
                        'status' => 'success',
                        'message' => 'successfully updated'
                    ]);
                });
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ]);
            }

        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Item not found'
            ]);
        }
        die();
    }

    public function delete(Request $request)
    {
        $itemId = $request->data['routeInfo'][2]['id'];

        $deleteItem = Item::query()->find($itemId);

        if($deleteItem) {
            $deleteItem->delete();
            echo json_encode([
                'status' => 'success',
                'message' => 'successfully deleted'
            ]);
            die();
        }
        echo json_encode([
            'status' => 'error',
            'message' => 'Item not found'
        ]);
        die();
    }
}