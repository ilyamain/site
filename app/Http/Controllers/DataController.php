<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\Formats;

class DataController extends Controller
{
    /**
     * It returns formatted user balance or empty string.
     *
     * @param Request $request
     *
     * @return string
     */
    public function userBalance(Request $request)
    {
        $output = '';

        if (!$request->has('user_id')) {
            return $output;
        }

        $response = Http::post(env('APP_RPC_URL'), [
            'jsonrpc' => '2.0',
            'method' => 'balance.userBalance',
            'params' => ['user_id' => $request->input('user_id')],
            'id' => 1,
        ])->json();

        if (!isset($response['result'])) {
            return $output;
        }

        $output = Formats::money($response['result']['balance']);

        return $output;
    }

    /**
     * It returns last X transactions.
     *
     * @param Request $request
     *
     * @return array
     */
    public function history(Request $request)
    {
        $output = [];

        $limit = ($request->has('limit')) ? $request->input('limit') : 50;

        $response = Http::post(env('APP_RPC_URL'), [
            'jsonrpc' => '2.0',
            'method' => 'balance.history',
            'params' => ['limit' => (int)$limit],
            'id' => 2,
        ])->json();

        if (isset($response['result'])) {
            foreach ($response['result'] as $item) {
                $item['value'] = Formats::money($item['value']);
                $item['balance'] = Formats::money($item['balance']);
                $item['created_at'] = Formats::dateRU($item['created_at']);
                $output[] = $item;
            }
        }

        return $output;
    }
}
