# Fulltext Search with Laravel

You can use the Fulltext predicate to search a document for a given term or terms.

The `fulltext` predicate searches the term in any of the following fields:

- Rich Text
- Title
- Key Text
- UID
- Select

To learn more about this predicate checkout the [Query Predicate Reference](../02-query-the-api/02-query-predicate-reference.md) page.

> Note that the fulltext search is not case sensitive.

## Example Query

This example shows how to query for all the documents of the custom type "blog-post" that contain the word "news".

```
<?php
$response = $api->query(
    [ Predicates::at('document.type', 'blog-post'),
      Predicates::fulltext('document', 'news') ]
);
// $response contains the response object, $response->results holds the retrieved documents
```
