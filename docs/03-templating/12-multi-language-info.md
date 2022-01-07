# Templating Multi-language Info

This page shows you how to access the language code and alternate language versions of a document.

## Get the document language code

You can get the language code of a document by accessing its `lang` property. This might give "en-us" (American english) or "fr-fr" (french) for example.

```
<?php
$lang = $document->lang;
```

## Get the alternate language versions

Next we will access the information about a document's alternate language versions.

You can get the alternate languages using the `alternate_languages` property. Then simply loop through the array and access the ID, UID, type and language code of each as shown below.

```
<?php
$altLangs = $document->alternate_languages;
foreach ($altLangs as $altLang) {
    $id = $altLang->id;
    $uid = $altLang->uid;
    $type = $altLang->type;
    $lang = $altLang->lang;
}
```

## Get a specific language version

If you need to get a specific alternate language version, use the `getAlternateLanguage` helper method.

Here's an example of how to get the french version ('fr-fr') of a document.

```
<?php
use Prismic\Document;

$frenchVersion = Document::getAlternateLanguage($document, 'fr-fr');

$id = $frenchVersion->id;
$uid = $frenchVersion->uid;
$type = $frenchVersion->type;
$lang = $frenchVersion->lang;
```
