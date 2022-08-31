<?php

declare(strict_types=1);


namespace App\Http\Middleware;


use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DateApiValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response| \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse | Response
    {
        try {

            $date = Carbon::parse($request->route('date'));

            if ($date && $date > Carbon::now()) {
                return response()->json(['message' => 'Такой даты не существует'], 422);
            }

            return $next($request);

        } catch (InvalidFormatException $e) {
            return response()->json(['message' => 'Дата не верная'], 422);
        }
    }
}