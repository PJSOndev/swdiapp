<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function syncToAndroid()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Synced successfully!',
            'data' => [
                ['id' => 1, 'pantawidID' => 'P001', 'name' => 'Juan Dela Cruz', 'age' => 35],
                ['id' => 2, 'pantawidID' => 'P002', 'name' => 'Maria Clara', 'age' => 28]
            ]
        ]);
    }
}
