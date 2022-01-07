# Templating the Image field

The Image field allows content writers to upload an image that can be configured with size constraints and responsive image views.

## Output an image in your template

Here's an example of integrating an image. In this case the Image field has the API ID of `illustration`.

```
<img
    src="{{ $document->data->illustration->url }}"
    alt="{{ $document->data->illustration->alt }}"
/>
```

> Note that the `alt` attribute is mandatory in HTML5 for image element. We advise to always write an alternative text for each image uploaded to your Prismic's media library.

Here's an example of integrating an illustration with a caption. In this case we have an Image field with the API ID of `illustration` and a Rich Text field with an API ID of `caption`.

```html
@php use Prismic\Dom\RichText; @endphp

<figure>
  <img
    src="{{ $document->data->illustration->url }}"
    alt="{{ $document->data->illustration->alt }}"
  />
  <figcaption>{{ RichText::asText($document->data->caption) }}</figcaption>
</figure>
```

## Get a responsive image view

Here is how to add responsive images using the HTML picture element. In this example we have an Image field with the API ID of `responsive_image`. This Image field has the default image view along with views named `tablet` and `mobile`.

```
@php
    $mainView = $document->data->responsive_image;
    $tabletView = $document->data->responsive_image->tablet;
    $mobileView = $document->data->responsive_image->mobile;
@endphp

<picture>
    <source media="(max-width: 400px)", srcset="{{ $mobileView->url }}" /> 
    <source media="(max-width: 900px)", srcset="{{ $tabletView->url }}" /> 
    <source srcset="{{ $mainView->url }}" />
    <image src="{{ $mainView->url }}" alt="{{ $mainView->alt }}" />
</picture>
```

## Get the image width & height

You can retrieve the main image's width or height. In this example we have an Image field with the API ID of `featured_image`.

```java
@php
    $width = $document->data->featured_image->dimensions->width;
    $height = $document->data->featured_image->dimensions->height;
@endphp
```

Here is how to retrieve the alt, width, and height value for a responsive image view. In this case the Image field has the API ID of `featured_image`.

```java
@php
    $mobileView = $document->data->featured_image->mobile;
    $alt = $mobileView->alt;
    $width = $mobileView->dimensions->width;
    $height = $mobileView->dimensions->height;
@endphp
```
