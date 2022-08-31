<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\CurrencyService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class CurrencyController extends Controller
{

    /**
    * @param  \Illuminate\Http\Request $request
    * @param  \App\Service\CurrencyService $currencyService
    * @return \Illuminate\Http\JsonResponse
    * @throws \Throwable
    */
    public function index(Request $request, CurrencyService $currencyService): JsonResponse
    {
        try {
            $date = Carbon::parse($request->route('date'));

            $result = $currencyService->getData($date);
            if (is_null($result)) {
                return response()->json(['message' => 'Не найдено'], 404);
            }

            return response()->json(['data' => $result]);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ошибка сервиса валют' . $e->getMessage()
            ], 500);
        }
    }

}
