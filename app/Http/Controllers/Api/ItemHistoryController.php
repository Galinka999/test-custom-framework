<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Engine\Request;

final class ItemHistoryController
{
    public function index(Request $request)
    {
        $itemId = $request->data['routeInfo'][2]['id'];
        $item = Item::query()->find($itemId);
        if($item) {
            $history = $item->historyChange;

            echo json_encode([
                'status' => 'success',
                'history' => $history,
            ]);
            die();
        }
        echo json_encode([
            'status' => 'error',
            'message' => 'Model not found'
        ]);
        die();
    }
}