<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PrismicComposer
{

    /**
     * Create a new prismic composer.
     *
     * @param  Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        // Define the menu content and link resolver
        $this->endpoint = $request['endpoint'];
        $this->linkResolver = $request['linkResolver'];
    }

    /**
     * Bind the link resolver and the menu content to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('endpoint', $this->endpoint);
        $view->with('linkResolver', $this->linkResolver);
    }
}
