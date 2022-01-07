# Templating the Embed field

The Embed field will let content writers paste an oEmbed supported service resource URL (YouTube, Vimeo, Soundcloud, etc.), and add the embedded content to your website.

## Display as HTML

Here's an example of how to integrate the Embed field into your templates. In this case the Embed field has an API ID of `video`.

```html
<div>{!! $document->data->video->html !!}</div>
```
