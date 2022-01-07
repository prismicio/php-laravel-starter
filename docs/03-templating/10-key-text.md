# Templating the Key Text Field

The Key Text field allows content writers to enter a single string.

## Get the Key Text value

Here is an example that shows how to get the value of a Key Text field. In this case, the Key Text field has the API ID of `title`.

```html
<h1>{{ $document->data->title }}</h1>
```
