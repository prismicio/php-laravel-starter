# Templating the Timestamp field

The Timestamp field allows content writers to add a date and time.

## Get the Timestamp value

Timestamp value is a string format as YYYY-MM-DDTHH:MM:SS+0000<br/>(example: 2017-02-17T15:45:00+0000).

Here is an example that retrieves the value of a Timestamp field with the API ID of `timestamp`.

```
<time>{{ $document->data->timestamp }}</time>
// Outputs: 2017-02-17T15:45:00+0000
```

## Format the Timestamp

You can also output the Timestamp in custom formats.

Here is an example that outputs a custom format for a Timestamp field with the API ID of `date_and_time`.

```
@php
    use Prismic\Dom\Date;

    $timestamp = Date::asDate($document->data->date_and_time);
@endphp

<time>{{ $timestamp->format('H:i:s - d/m/Y') }}</time>
// Outputs: 15:45:00 - 17/02/2017
```
