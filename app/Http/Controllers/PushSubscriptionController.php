<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PushSubscriptionController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        \Log::info('Push Subscription Request Received', $request->all());

        try {
            $request->validate([
                'endpoint' => 'required',
                'keys.auth' => 'required',
                'keys.p256dh' => 'required'
            ]);

            $endpoint = $request->endpoint;
            $key = $request->keys['p256dh'];
            $token = $request->keys['auth'];

            $request->user()->updatePushSubscription($endpoint, $key, $token);
            
            \Log::info('Push Subscription Saved for User: ' . $request->user()->id);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Push Subscription Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->validate(['endpoint' => 'required']);
        
        $request->user()->deletePushSubscription($request->endpoint);

        return response()->json(['success' => true]);
    }
}
