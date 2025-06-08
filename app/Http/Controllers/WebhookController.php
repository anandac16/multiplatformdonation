<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\WebhookToken;

class WebhookController extends Controller
{
    public function form()
    {
        return view('form');
    }

    public function save(Request $request)
    {
        $uuid = Str::uuid()->toString();

        WebhookToken::create([
            'id' => $uuid,
            'trakteer_token' => $request->trakteer,
            'saweria_token' => $request->saweria,
            'sociabuzz_token' => $request->sociabuzz,
            'tako_token' => $request->tako,
        ]);

        return redirect("/webhook/$uuid");
    }

    public function webhook(Request $request, $uuid)
    {
        $webhook = WebhookToken::findOrFail($uuid);

        if ($request->isMethod('post')) {
            $webhook->last_message = json_encode($request->all());
            $webhook->save();
            return response('OK');
        }

        return view('webhook', ['uuid' => $uuid]);
    }

    public function getWebhookData($uuid)
    {
        $webhook = WebhookToken::findOrFail($uuid);
        return response()->json(['message' => $webhook->last_message]);
    }
}
