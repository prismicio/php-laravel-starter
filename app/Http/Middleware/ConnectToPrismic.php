<?php

namespace App\Http\Middleware;

use Closure;
use App\LinkResolver;
use Prismic\Api;

include(app_path() . '/LinkResolver.php');

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
        $request['endpoint'] = config('prismic.url');

        // Define the link resolver
        $request['linkResolver'] = new LinkResolver();

        // Connect to the prismic.io repository
        if (config('prismic.url') !== 'https://your-repo-name.prismic.io/api/v2') {
            $request['api'] = Api::get(config('prismic.url'), config('prismic.token'));
        }

        // Return the request
        return $next($request);
    }
}
