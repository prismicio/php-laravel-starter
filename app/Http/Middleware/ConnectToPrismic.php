<?php

namespace App\Http\Middleware;

use Closure;
use App\LinkResolver;
use Prismic\Api;

class ConnectToPrismic
{
    /**
     * Connect to the prismic.io API.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Define the prismic.io repository API endpoint
        $request->attributes->set('endpoint', config('prismic.url'));

        // Define the link resolver
        $request->attributes->set('linkResolver', new LinkResolver());

        // Connect to the prismic.io repository
        if (config('prismic.url') !== 'https://your-repo-name.prismic.io/api/v2') {
            $request->attributes->set('api', Api::get(config('prismic.url'), config('prismic.token')));
        }

        // Return the request
        return $next($request);
    }
}
