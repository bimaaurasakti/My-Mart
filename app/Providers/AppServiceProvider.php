<?php

namespace App\Providers;

use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('statusOk', function ($data, $messages = "") {
            if (empty($messages)) {
                return response()->json([
                    'error' => false,
                    'data' => $data
                ], 200);
            } else if (empty($data)) {
                return response()->json([
                    'error' => false,
                    'messages' => $messages
                ], 200);
            } else {
                return response()->json([
                    'error' => false,
                    'data' => $data,
                    'message' => $messages
                ], 200);
            }
        });

        Response::macro('statusError', function ($message, $code = 200) {
            return response()->json([
                'error' => true,
                'message' => $message
            ], $code);
        });
    }
}
