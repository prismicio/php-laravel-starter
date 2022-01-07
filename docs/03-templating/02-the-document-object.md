# The Document Object

Here we breakdown the document object returned from the Prismic API when developing with a Laravel project.

> **Before Reading**
>
> This article assumes that you have queried your API and saved the document object in a variable named `$document`.

## An example response

Let's start by taking a look at the Document Object returned when querying the API. Here is a simple example of a document that contains a couple of fields.

```json
{
  "id": "WKxlPCUEEIZ10AHU",
  "uid": "example-page",
  "type": "page",
  "href": "https://your-repo-name.prismic.io/api/v2/documents/search...",
  "tags": ["Tag 1", "Tag 2"],
  "first_publication_date": "2017-01-13T11:45:21.000Z",
  "last_publication_date": "2017-02-21T16:05:19.000Z",
  "slugs": ["example-page"],
  "linked_documents": [],
  "lang": "en-us",
  "alternate_languages": [
    {
      "id": "WZcAEyoAACcA0LHi",
      "uid": "example-page-french",
      "type": "page",
      "lang": "fr-fr"
    }
  ],
  "data": {
    "title": [
      {
        "type": "heading1",
        "text": "Example Page",
        "spans": []
      }
    ],
    "date": "2017-01-13"
  }
}
```

## Accessing Document Fields

Here is how to access each document field.

### ID

```bash
$document->id
```

### UID

```bash
$document->uid
```

### Type

```bash
$document->type
```

### API Url

```bash
$document->href
```

### Tags

```bash
$document->tags
// returns an array
```

### First Publication Date

```bash
$document->first_publication_date
```

### Last Publication Date

```bash
$document->last_publication_date
```

### Language

```bash
$document->lang
```

### Alternate Language Versions

```bash
$document->alternate_languages
// returns an array
```

You can read more about this in the [Multi-language Templating](../03-templating/12-multi-language-info.md) page.

## Document Content

To retrieve the content fields from the document you must specify the API ID of the field. Here is an example that retrieves a Date field's content from the document. Here the Date field has the API ID of `date`.

```bash
$document->data->date
```

Refer to the specific templating documentation for each field to learn how to add content fields to your pages.
