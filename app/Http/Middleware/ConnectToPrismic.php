<?php

namespace App\Http\Middleware;

use Closure;
use Prismic\Api;
use App;

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
        // Define the link resolver
        $request['endpoint'] = config('prismic.url');
        $request['linkResolver'] = new App\PrismicLinkResolver();
        
        // Connect to the prismic.io repository
        if (config('prismic.url') != 'https://your-repo-name.prismic.io/api') {
            $request['api'] = Api::get(config('prismic.url'), config('prismic.token'));
        }
        
        // Return the request
        return $next($request);
    }
}
