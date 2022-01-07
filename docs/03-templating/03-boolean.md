# Templating the Boolean Field

The Boolean field will add a switch for a true or false values for the content authors to pick from.

## Get the boolean value

Here is an example of how to retrieve the value from a Boolean field which has the API ID switch.

```
@php
$example = $document->data->switch
if ($example) echo 'This is printed if value is true.<br />';
@endphp
```
