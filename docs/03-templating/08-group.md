# Templating the Group Field

The Group field is used to create a repeatable collection of fields.

## Repeatable Group

### Looping through the Group content

Here's how to integrate a repeatable Group field into your templates. First get the group which is an array. Then loop through each item in the group as shown in the following example.

This example uses a Group field with an API ID of `references`. The group field consists of a Link field with an API ID of `link` and a Rich Text field with the API ID of `label`.

```
@php
    use Prismic\Dom\Link;
    use Prismic\Dom\RichText;
@endphp

<ul>
    @foreach ($document->data->references as $item)
        <li>
            <a href="{{ Link::asUrl($item->link) }}">
                {{ RichText::asText($item->label) }}
            </a>
        </li>
    @endforeach
</ul>
```

### Example 2

Here's another example that shows how to integrate a group of images (e.g. a photo gallery) into a page.

This example has a Group field with the API ID of `photo_gallery`. The group contains an Image field with the API ID of `photo` and a Rich Text field with the API ID of `caption`.

```
@php
    use Prismic\Dom\RichText;
@endphp

@foreach ($document->data->photo_gallery as $item)
    <figure>
        <img src="{{ $item->photo->url }}" alt="{{ $item->photo->alt }}" />
        <figcaption>{{ RichText::asText($item->caption) }}</figcaption>
    </figure>
@endforeach
```

## Non-repeatable Group

Even if the group is non-repeatable, the Group field will be an array. You simply need to get the first (and only) group in the array and you can retrieve the fields in the group like any other.

Here is an example showing how to integrate the fields of a non-repeatable Group into your templates. In this case the Group field has an API ID of `banner_group`. The group consists of an Image field `banner_image`, a Rich Text field `banner_desc`, a Link field `banner_link`, and a Rich Text field `banner_link_label`.

```
@php
    use Prismic\Dom\RichText;
    use Prismic\Dom\Link;

    $bannerGroup = $document->data->banner_group[0];
    $bannerImage = $bannerGroup->banner_image;
    $bannerDesc = RichText::asHtml($bannerGroup->banner_desc);
    $bannerLinkUrl = Link::asUrl($bannerGroup->banner_link);
    $bannerLinkLabel = RichText::asText($bannerGroup->banner_link_label);
@endphp

<div class="banner">
    <img class="banner-image" src="{{ $bannerImage->url }}" alt="{{ $bannerImage->alt }}" />
    <p class="banner-desc">{!! $bannerDesc !!}</p>
    <a class="banner-link" href="{{ $bannerLinkUrl }}">{{ $bannerLinkLabel }}</a>
</div>
```
