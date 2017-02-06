<?php

namespace App;

use Prismic\LinkResolver;

/**
 * The link resolver is the code building URLs for pages corresponding to
 * a Prismic document.
 *
 * If you want to change the URLs of your site, you need to update this class
 * as well as the routes in app.php.
 */
class PrismicLinkResolver extends LinkResolver
{
    /**
     * This function will be used to generate links to Prismic.io documents
     * As your project grows, you should update this function according to your routes
     *
     * @param object $link
     * @return string
     */
    public function resolve($link)
    {
        return '/';
    }
}
