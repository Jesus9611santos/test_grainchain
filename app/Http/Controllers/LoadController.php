<?php
// app/Http/Controllers/LoadController.php
namespace App\Http\Controllers;

use Exception;
use App\Services\LoadService;
use App\Http\Requests\LoadsRequest;

class LoadController extends Controller
{
    private LoadService $service;

    public function __construct(LoadService $service)
    {
        $this->service = $service;
    }

    public function calculate(LoadsRequest $request)
    {
        try {
            $loads = $this->service->calculateTotalValue($request->validatedAttributes(), 'maize');
            return response()->json(['loads' => $loads], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'exception' => get_class($e),
            ], 400);
        }
    }
}
