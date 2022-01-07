# Templating the Select Field

The Select field will add a dropdown select box of choices for the content writers to pick from.

## Get the Select field value

Here's an example of how to integrate the selected text value. In this case the Select field has the API ID of `category`.

```html
<p>{{ $document->data->category }}</p>
```
