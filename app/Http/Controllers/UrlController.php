<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use App\Models\UrlClick;

class UrlController extends Controller
{
    public function add(Request $request)
    {
        $input = $request->validate([
            'url' => 'required|url',
            'valid_until' => 'nullable|date|after:now'
        ]);

        if (empty($input['valid_until'])) {
            $input['valid_unlimited'] = true;
        }

        $url = Url::create($input);

        return response()->json([
            'code' => 'OK',
            'data' => [
                'short_url' => route('go', ['slug' => $url->slug]),
            ],
        ]);
    }

    public function go($slug)
    {
        $url = Url::where('slug', $slug)->first();
        if (empty($url) || !$url->isValid()) {
            return redirect()->route('home')->with('error', 'Url not found!');
        }

        UrlClick::create([
            'registered_at' => date('Y-m-d H:i:s'),
            'url_id' => $url->id,
            'visitor_ip' => request()->ip(),
            'visitor_info' => json_encode(['user-agent' => request()->header('User-Agent')]),
        ]);
        return redirect()->away($url->url);
    }
}
