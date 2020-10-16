<?php

namespace App\Observers;

use App\Models\Url;
use Illuminate\Support\Str;
use App\Exceptions\UrlException;

class UrlObserver
{
    /**
     * handle the url "creating" event.
     *
     * @param  \app\models\url  $url
     * @return void
     */
    public function creating(Url $url)
    {
        $checkLimit = 10;
        do {
            if ($checkLimit-- <= 0) {
                throw new UrlException();
            }
            $url->slug = Str::random(8);
        } while (Url::where('slug', $url->slug)->exists());
    }
}
