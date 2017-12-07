<!DOCTYPE html(lang='en')>
<head>
    <title>prismic.io help page</title>
    <link rel="stylesheet" href="/stylesheets/reset.css"/>
    <link rel="stylesheet" href="/stylesheets/style.css"/>
    <link rel="stylesheet" href="/stylesheets/vendors/help.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro:400,500,600" rel="stylesheet" type="text/css"/>
    <link rel="icon" type="image/png" href="/images/punch.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="/javascript/vendors/highlight.min.js"></script>
</head>
<body>
    <div id="prismic-help">
        <header>
            <nav>
                @if ($isConfigured)
                    <a href="{{ $repoURL }}" target="_blank" rel="noopener"><strong>Go to {{ $name }}</strong></a>
                @else
                    <a href="#config"><strong>Configure a repository</strong></a>
                @endif
                <a href="https://prismic.io/docs/php/getting-started/with-the-php-starter-kit"  target="_blank" rel="noopener" class="doc">Documentation<img src="images/open.svg" alt=""/></a>
            </nav>
            <div class="wrapper"><img src="images/rocket.svg" alt=""/>
                <h1>High five, you deserve it!</h1>
                <p>Grab a well deserved cup of coffee, you're <?= $isConfigured ? 'two' : 'three'; ?> steps away from creating a page with dynamic content.</p>
            </div>
            <div class="hero-curve"></div>
            <div class="flip-flap">
                <div class="flipper">
                    <div class="guide">
                        <ul>
                            @if ($isConfigured)
                                <li class="done"><span>1</span>Bootstrap your project</li>
                            @else
                                <li><a href="#config"><span>1</span>Bootstrap your project<img src="images/arrow.svg" alt=""/></a></li>
                            @endif
                            <li><a href="#query"><span>2</span>Query the API<img src="images/arrow.svg" alt=""/></a></li>
                            <li><a href="#done"><span>3</span>Fill a template<img src="images/arrow.svg" alt=""/></a></li>
                        </ul>
                    </div>
                    <div class="gif"></div>
                </div>
            </div>
        </header>
        <section>
            <p>This is a help page included in your project, it has a few useful links and example snippets to help you getting started. You can access this any time by pointing your browser to {{ $host }}/help.</p>
            
            <?php $stepNumberText = $isConfigured ? 'Two' : 'Three'; ?>
            <h2>{{ $stepNumberText }} more steps:</h2>
            
            @if (!$isConfigured)
                <h3 id="config"><span>1</span>Bootstrap your project</h3>
                <p>If you haven't yet, create a prismic.io content repository. A repository is where your website’s content will live. Simply <a href="https://prismic.io/#create" target="_blank">create one</a> by choosing a repository name and a plan. We’ve got a variety of plans including our favorite, Free!</p>
                <h4>Add the repository URL to your configuration</h4>
                <p>Replace the repository url in your prismic config file with <code class="tag">your-repo-name</code>.prismic.io.</p>
                <div class="source-code">
                    <pre><code>// In config/prismic.php
"url" => "https://your-repo-name.prismic.io/api",</code></pre>
                </div>
            @endif
            
            
            <h3 id="query"><span>2</span>Create a route and retrieve content</h3>
            <p>
                To add a page to your project, you need to first specify a route. The route contains the URL and performs queries for the needed content.
                <br/>
                <span class="note">Note that you will need to include a UID field in your Custom Type in order for this to work.</span>
                In the following example we set a <code class="tag">/page/:uid</code> URL to fetch content of your custom type by its UID. The route then calls the <code class="tag">page</code> template and passes it the retrieved content. Make sure to replace <code class="tag">&lt;your-custom-type-id></code> below with the API ID of your Custom Type.
            
            </p>
            <div class="source-code">
                <pre><code>// Add a new route in routes/web.php
Route::get('/page/{uid}', function ($uid, Request $request) {
    
    // Query the page by the uid by using the getByUID function
    $document = $request['api']->getByUID('&lt;your-custom-type-id>', $uid);
    // $document is the returned document object, or null if there is no match

    // Render the page. 'page' is the name of your blade template view (resources/views/page.blade.php)
    return view('page', [ 'document' => $document ]);
});</code></pre>
            </div>
            <p>To discover all the functions you can use to query your documents go to <a href="https://prismic.io/docs/php/query-the-api/how-to-query-the-api" target="_blank" rel="noopener">the prismic documentation</a>.</p>
        
            <h3 id="done"><span>3</span>Fill a template</h3>
            <p>
                Now all that's left to be done is to insert your content into the template.
                <br/>
                You can get the content using the <code class="tag">document</code> variable we defined above. Each content field is accessed using the custom type API-ID and the content field API ID defined in the custom type. For example if you had a custom type with the API ID of <code class="tag">page</code> which has an image field with the API ID <code class="tag">main_image</code>, then you would use <code class="tag">page.main_image</code>.
            </p>
            <div class="source-code">
                <pre><code>&#123;{-- Create template resources/views/page.blade.php --}}
&#64;extends('layout')

&#123;{-- Create a content section --}}
&#64;section('content')
    &lt;div>
        &#123;{-- This is how to get an image into your template --}}
        &lt;img src="&#123;{ $document->getImage('<strong>custom_type_id.image_field_id</strong>')->getUrl() }}" />

        &#123;{-- This is how to get structured text fields into your template --}}
        &#123;!! $document->getStructuredText('<strong>custom_type_id.title_field_id</strong>')->asHtml($linkResolver) !!}
        &#123;!! $document->getStructuredText('<strong>custom_type_id.description_field_id</strong>')->asHtml($linkResolver) !!}
    &lt;/div>
&#64;stop</code></pre>
            </div>
            <p>To discover how to get all the different content fields, go to <a href="https://prismic.io/docs/php/templating/the-response-object" target="_blank" rel="noopener">the prismic documentation</a>.</p>
        </section>
    </div>
</body>