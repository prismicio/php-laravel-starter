# Templating the Number Field

The Number field allows content writers to enter or select a number. You can set max and min values for the number.

## Get the number value

Here is an example of how to integrate a Number field into your template. In this case the Number field has the API ID of `price`.

```html
<div>{{ $document->data->price }}</div>
```
