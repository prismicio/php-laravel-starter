# Templating Slices

The Slices field is used to define a dynamic zone for richer page layouts.

> **Before Reading**
>
> This page assumes that you have retrieved your content and stored it in a variable named `$document`.
>
> It is also assumed that you have set up a Link Resolver stored in the variable `$linkResolver`. When integrating a Link in your templates, a link resolver might be necessary as shown & discussed below. To learn more about this, check out our [Link Resolving](../04-beyond-the-api/01-link-resolving.md) page.

## Example 1

You can retrieve Slices from your documents by accessing the data property containing the slices zone, named by default `body`.

Here is a simple example that shows how to add slices to your templates. In this example, we have two slice options: a text slice and an image gallery slice.

### Text slice

The "text" slice is simple and only contains one field, which is non-repeatable.

| Property                                                 | Description                                                         |
| -------------------------------------------------------- | ------------------------------------------------------------------- |
| <strong>Primary</strong><br/><code>non-repeatable</code> | <p>- A Rich Text field with the API ID of &quot;rich_text&quot;</p> |
| <strong>Items</strong><br/><code>repeatable</code>       | <p>None</p>                                                         |

### Image gallery slice

The "image_gallery" slice contains both a repeatable and non-repeatable field.

| Property                                                 | Description                                                          |
| -------------------------------------------------------- | -------------------------------------------------------------------- |
| <strong>Primary</strong><br/><code>non-repeatable</code> | <p>- A Title field with the API ID of &quot;gallery_title&quot;</p>  |
| <strong>Items</strong><br/><code>repeatable</code>       | <p>- An Image field with the API ID of &quot;gallery_image&quot;</p> |

### Integration

Here is an example of how to integrate these slices into a blog post.

```
@php
    use Prismic\Dom\RichText;

    $slices = $document->data->body;
@endphp

<div class="blog-content">
    @foreach ($slices as $slice)
        @switch ($slice->slice_type)
            @case ('text')
                {!! RichText::asHtml($slice->primary->rich_text, $linkResolver) !!}
                @break
            @case ('image_gallery')
                {!! '<h2 class="gallery-title">' . RichText::asText($slice->primary->gallery_title) . '</h2>' !!}
                @foreach ($slice->items as $item)
                    {!! '<img src="' . $item->gallery_image->url . '" alt="' . $item->gallery_image->alt . '" />' !!}
                @endforeach
                @break
            @endswitch
    @endforeach
</div>
```

## Example 2

The following is a more advanced example that shows how to use Slices for a landing page. In this example, the Slice choices are FAQ question/answers, featured items, and text sections.

### FAQ slice

The "faq" slice takes advantage of both the repeatable and non-repeatable slice sections.

| Property                                                 | Description                                                                                                                    |
| -------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------ |
| <strong>Primary</strong><br/><code>non-repeatable</code> | <p>- A Title field with the API ID of &quot;faq_title&quot;</p>                                                                |
| <strong>Items</strong><br/><code>repeatable</code>       | <p>- A Title field with the API ID of &quot;question&quot;</p><p>- A Rich Text field with the API ID of &quot;answer&quot;</p> |

### Featured Items slice

The "featured_items" slice contains a repeatable set of an image, title, and summary fields.

| Property                                                 | Description                                                                                                                                                                              |
| -------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| <strong>Primary</strong><br/><code>non-repeatable</code> | <p>None</p>                                                                                                                                                                              |
| <strong>Items</strong><br/><code>repeatable</code>       | <p>- An Image field with the API ID of &quot;image&quot;</p><p>- A Title field with the API ID of &quot;title&quot;</p><p>- A Rich Text field with the API ID of &quot;summary&quot;</p> |

### Text slice

The "text" slice contains only a Rich Text field in the non-repeatable section.

| Property                                                 | Description                                                         |
| -------------------------------------------------------- | ------------------------------------------------------------------- |
| <strong>Primary</strong><br/><code>non-repeatable</code> | <p>- A Rich Text field with the API ID of &quot;rich_text&quot;</p> |
| <strong>Items</strong><br/><code>repeatable</code>       | <p>None</p>                                                         |

### Integration

Here is an example of how to integrate these slices into a landing page.

```
@php
    use Prismic\Dom\RichText;

    $returnFaqSlice = function ($slice) use ($linkResolver) {
        $html = '<div class="slice-faq">'
            . RichText::asHtml($slice->primary->faq_title, $linkResolver);
        foreach ($slice->items as $item) {
            $html .= '<div>'
                . RichText::asHtml($item->question, $linkResolver)
                . RichText::asHtml($item->answer, $linkResolver)
                . '</div>';
        }
        $html .= '</div>';
        return $html;
    };

    $returnFeaturedItemsSlice = function ($slice) use ($linkResolver) {
        $html = '<div class="slice-featured-items">';
        foreach ($slice->items as $item) {
            $html .= '<div>'
                . '<img src="' . $item->image->url . '" alt="' . $item->image->alt . '" />'
                . RichText::asHtml($item->title, $linkResolver)
                . RichText::asHtml($item->summary, $linkResolver)
                . '</div>';
        }
        $html .= '</div>';
        return $html;
    };

    $returnTextSlice = function ($slice) use ($linkResolver) {
        $html = '<div class="slice-text">'
            . RichText::asHtml($slice->primary->rich_text, $linkResolver)
            . '</div>';
        return $html;
    };

    $slices = $document->data->body;
@endphp

<div class="page-content">
    @foreach ($slices as $slice)
        @switch ($slice->slice_type)
            @case ('faq')
                {!! $returnFaqSlice($slice) !!}
                @break
            @case ('featured_items')
                {!! $returnFeaturedItemsSlice($slice) !!}
                @break
            @case ('text')
                {!! $returnTextSlice($slice) !!}
                @break
        @endswitch
    @endforeach
</div>
```
