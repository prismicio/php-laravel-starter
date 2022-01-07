# HTML Serializer

You can customize the HTML output of a Rich Text Field by incorporating an HTML Serializer into your project. This allows you to do things like adding custom classes to certain elements or adding a target element to all hyperlinks.

> **Before Reading**
>
> This page assumes that you have retrieved your content and stored it in a variable named `$document`.
>
> It is also assumed that you have set up a Link Resolver stored in the variable `$linkResolver`. When integrating a Link in your templates, a link resolver might be necessary as shown & discussed below. To learn more about this, check out our [Link Resolving](../04-beyond-the-api/01-link-resolving.md) page.

## Adding the HTML Serializer function

To be able to modify the HTML output of a Rich Text, you need to first create the HTML Serializer function.

It will need to identify the element by type and return the desired output.

> Make sure to add a default case that returns null. This will leave all the other elements untouched.

Here is an example of an HTML Serializer that will prevent image elements from being wrapped in paragraph tags and add a custom class to all hyperlink and paragraph elements.

```
<?php
$htmlSerializer = function ($element, $content) use ($linkResolver) {
    switch ($element->type) {
        // Add a class to paragraph elements
        case 'paragraph':
            return nl2br('<p class="paragraph-class">' . $content . '</p>');

        // Don't wrap images in a <p> tag
        case 'image':
            return '<img src="' . $element->url . '" alt="' . htmlentities($element->alt) . '">';

        // Add a class to hyperlinks
        case 'hyperlink':
            if ($element->data->link_type === 'Document') {
                $linkUrl = $linkResolver ? $linkResolver($element->data) : '';
            } else {
                $linkUrl = $element->data->url;
            }
            if ($linkUrl === null) {
                return $content;
            }
            $targetAttr = property_exists($element->data, 'target') ? ' target="' . $element->data->target . '" rel="noopener"' : null;
            return '<a class="link-class" href="' . $linkUrl . '" ' . $targetAttr . '>' . $content . '</a>';

        // Return null to stick with the default behavior for everything else
        default:
            return null;
    }
};
```

Note that if you want to change the output for the hyperlink element, you will need to use a Link Resolver. You can read more about this on the [Link Resolving](../04-beyond-the-api/01-link-resolving.md) page.

## Using the serializer function

To use it, all you need to do is pass the Serializer function into the `asHtml` method for a Rich Text element. Make sure to pass it in after the [Link Resolver](../04-beyond-the-api/01-link-resolving.md).

```
@php
    use Prismic\Dom\RichText;
@endphp

<div>
    {!! RichText::asHtml($document->data->rich_text, $linkResolver, $htmlSerializer) !!}
</div>
```

## Example with all elements

Here is an example that shows you how to change all of the available Rich Text elements.

```
<?php
$htmlSerializer = function ($element, $content) use ($linkResolver) {
    switch ($element->type) {
        // Headings
        case 'heading1':
            return nl2br('<h1>' . $content . '</h1>');
        case 'heading2':
            return nl2br('<h2>' . $content . '</h2>');
        case 'heading3':
            return nl2br('<h3>' . $content . '</h3>');
        case 'heading4':
            return nl2br('<h4>' . $content . '</h4>');
        case 'heading5':
            return nl2br('<h5>' . $content . '</h5>');
        case 'heading6':
            return nl2br('<h6>' . $content . '</h6>');

        // Paragraphs
        case 'paragraph':
            return nl2br('<p>' . $content . '</p>');

        // List Items
        case 'list-item':
        case 'o-list-item':
            return nl2br('<li>' . $content . '</li>');

        // Images
        case 'image':
            return (
                '<p class="block-img' . (property_exists($element, 'label') ? (' ' . $element->label) : '') . '">' .
                    '<img src="' . $element->url . '" alt="' . htmlentities($element->alt) . '">' .
                '</p>'
            );

        // Embeds
        case 'embed':
            $providerAttr = '';
            if ($element->oembed->provider_name) {
                $providerAttr = ' data-oembed-provider="' . strtolower($element->oembed->provider_name) . '"';
            }
            if ($element->oembed->html) {
                return (
                    '<div data-oembed="' . $element->oembed->embed_url . '" data-oembed-type="' . strtolower($element->oembed->type) . '"' . $providerAttr . '>' .
                        $element->oembed->html .
                    '</div>'
                );
            }
            return '';

        // Preformatted
        case 'preformatted':
            return '<pre>' . $content . '</pre>';

        // Strong
        case 'strong':
            return '<strong>' . $content . '</strong>';

        // Emphasis
        case 'em':
            return '<em>' . $content . '</em>';

        // Hyperlinks
        case 'hyperlink':
            if ($element->data->link_type === 'Document') {
                $linkUrl = $linkResolver ? $linkResolver($element->data) : '';
            } else {
                $linkUrl = $element->data->url;
            }
            if ($linkUrl === null) {
                return $content;
            }
            $targetAttr = property_exists($element->data, 'target') ? ' target="' . $element->data->target . '" rel="noopener"' : null;
            return '<a href="' . $linkUrl . '" ' . $targetAttr . '>' . $content . '</a>';

        // Custom Spans
        case 'label':
            return '<span class="' . (property_exists($element->data, 'label') ? $element->data->label : '') . '">' . $content . '</span>';

        // Default Case returns null
        default:
            return null;
    }
};
```

Note that if want to change the output for the hyperlink element, you will need to use a Link Resolver function. You can read more about this on the [Link Resolving](../04-beyond-the-api/01-link-resolving.md) page.
