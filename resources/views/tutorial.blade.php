<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorial - Laravel starter for prismic.io</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link href="{{ asset('css/tutorial.min.css') }}" rel="stylesheet">
    <link href="{{ asset('img/punch.png') }}" rel="icon" type="image/png">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>
        $(document).ready(function () {
            $('pre code').each(function (i, block) {
                hljs.highlightBlock(block);
            });
        });
    </script>
</head>
<body>

    <header>
        <nav>
            <a href="#bootstrap"><strong>Configure a repository</strong></a>
            <a href="https://prismic.io/docs/php/getting-started/with-the-php-starter-kit" target="_blank" class="doc">Documentation<img src="{{ asset('img/open.svg') }}" alt="Open"></a>
        </nav>
        <div class="wrapper">
            <img src="{{ asset('img/rocket.svg') }}" alt="Rocket">
            <h1>High five, you deserve it!</h1>
            <p>Grab a well deserved cup of coffee, you're just a few steps away from creating a page with dynamic content.</p>
        </div>
        <div class="hero-curve"></div>
        <div class="flip-flap">
            <div class="flipper">
                <div class="guide">
                    <ul>
                        <li><a href="#bootstrap"><span>1</span>Bootstrap your project<img src="{{ asset('img/arrow.svg') }}" alt="Arrow"></a></li>
                        <li><a href="#custom-type"><span>2</span>Create a Custom Type "Page"<img src="{{ asset('img/arrow.svg') }}" alt="Arrow"></a></li>
                        <li><a href="#new-page"><span>3</span>Create your first page!<img src="{{ asset('img/arrow.svg') }}" alt="Arrow"></a></li>
                        <li><a href="#code"><span>4</span>Query the API and create the page template<img src="{{ asset('img/arrow.svg') }}" alt="Arrow"></a></li>
                        <li><a href="#done"><span>5</span>Well done!<img src="{{ asset('img/arrow.svg') }}" alt="Arrow"></a></li>
                    </ul>
                </div>
                <div class="gif"></div>
            </div>
        </div>
    </header>

    <section>
        <p>This is a tutorial page included in this Laravel Starter project, it has a few useful links and example snippets to help you get started. You can access this page at <a href="{{ Request::url() }}">{{ Request::url() }}</a>.</p>
        <h2>Follow these steps:</h2>

        <h3 id="bootstrap"><span>1</span>Bootstrap your project</h3>
        <h4>Create a prismic.io content repository</h4>
        <p>A repository is where your website’s content will live. Simply <a href="https://prismic.io/#create" target="_blank">create one</a> choosing a repository name and a plan. We’ve got a variety of plans including our favorite, Free!</p>
        <h4>Configure your project</h4>
        <p>Open the prismic.php configuration file (located at config/prismic.php) and assign the API endpoint for your prismic.io repository:</p>
        <div class="source-code">
            <pre><code>// In config/prismic.php
'url' => 'https://your-repo-name.prismic.io/api/v2',
</code></pre>
        </div>
        <p>Next let's see how to create a page in your website filled with content retrieved from prismic.io!</p>

        <h3 id="custom-type"><span>2</span>Create a Custom Type "Page"</h3>
        <p>We will create a page containing a title, a paragraph and an image. Let's create a Custom Type in prismic.io with the corresponding fields. We'll add an additional UID (unique identifier) field for querying the page.</p>
        <p>Go to the repository backend you've just created (at https://your-repo-name.prismic.io). Then navigate to the <em>"Custom Types"</em> section (icon on the left navbar) and create a new Repeatable Type, for this tutorial let's name it "Page". Make sure that the system automatically assigns this an API ID of "page".</p>
        <p>Once the "Page" Custom Type is created, we have to define how we want to model it, that is to say a document containing a UID, a title, a paragraph and an image. Click on <em>"JSON editor"</em> (right sidebar) and paste the following JSON data into the Custom Type JSON editor. When you're done, hit <em>"Save"</em>.</p>
        <div class="source-code">
            <pre><code>{
    "Main" : {
        "uid" : {
            "type" : "UID",
            "config" : {
                "placeholder" : "UID"
            }
        },
        "title" : {
            "type" : "StructuredText",
            "config" : {
                "single" : "heading1",
                "placeholder" : "Title..."
            }
        },
        "description" : {
            "type" : "StructuredText",
            "config" : {
                "multi" : "paragraph,em,strong,hyperlink",
                "placeholder" : "Description..."
            }
        },
        "image" : {
            "type" : "Image"
        }
    }
}
</code></pre>
        </div>

        <h3 id="new-page"><span>3</span>Create your first page!</h3>
        <p>The "Page" Custom Type you've just created contains a title, a paragraph, an image and a UID (unique identifier). Now it is time to fill in your first page!</p>
        <p>Create a new "Page" content in your repository: go to <em>"Content"</em> and hit <em>"New"</em>.</p>
        <p>Fill the corresponding fields. Note the value you filled in the UID field, because it will be a part of the page URL, for that purpose let's type "<strong>hello-world</strong>".</p>
        <p>When you're done, hit <em>"Save"</em> then <em>"Publish"</em>.</p>

        <h3 id="code"><span>4</span>Query the API and create the page template</h3>
        <h4>Query the API for your "hello-world" page</h4>
        <p>Now that you've created your "hello-world" page in your prismic.io repository, go back to your local code. Let's make an API call to retrieve page content. For that, we will use the specified UID.</p>
        <p>
            Once we've retrieved the page, we render the template providing it with its content.
            <br>
            Add the following route to your routes/web.php file:
        </p>
        <div class="source-code">
            <pre><code>// In routes/web.php

// Get page by UID
Route::get('/page/{uid}', function ($uid, Request $request) {
    // Query the API
    $document = $request->attributes->get('api')->getByUID('page', $uid);

    // Display the 404 page if no document is found
    if (!$document) {
        return view('404');
    }

    // Render the page
    return view('page', ['document' => $document]);
});
</code></pre>
        </div>
        <h4>Create webpage with the retrieving content</h4>
        <p>Now all that's left to be done is to output on a webpage the content we fetched from the API. Create a new template file named "page.blade.php" inside the views folder (located at resources/views/page.blade.php). Here's an example that'll display a webpage "Page" with its title, description and image:</p>
        <div class="source-code">
            <pre><code>// Create file resources/views/page.blade.php

@@php
    use Prismic\Dom\RichText;
@@endphp

@@extends('layouts.app')

@@section('content')

    &lt;div data-wio-id="@{{ $document-&gt;id }}"&gt;
        &lt;h1&gt;@{{ RichText::asText($document-&gt;data-&gt;title) }}&lt;/h1&gt;
        &lt;div&gt;
            @{!! RichText::asHtml($document-&gt;data-&gt;description) !!}
        &lt;/div&gt;
        &lt;img src="@{{ $document-&gt;data-&gt;image-&gt;url }}" alt="@{{ $document-&gt;data-&gt;image-&gt;alt }}"&gt;
    &lt;/div&gt;

@@stop
</code></pre>
        </div>
        <p>In your browser go to <a href="{{ Request::root() }}/page/hello-world">{{ Request::root() }}/page/hello-world</a> and you're done! You've officially created a page that pulls content from prismic.io.</p>

        <h3 id="done"><span>5</span>Well done!</h3>
        <p>Sit back and enjoy the result.</p>
        <p>Basically in these few steps you've added content management to your page and thanks to the prismic.io Writing Room, you'll have:</p>
        <ol style="list-style-type: disc; padding-left: 20px;">
            <li>Full versioning of your content</li>
            <li>A nice rich editor to create and edit your content</li>
            <li>Collaboration with other users you choose to add to your repository</li>
            <li>Performance and scalability for your content using a Content Delivery Network around the world</li>
        </ol>

    </section>

</body>
</html>
