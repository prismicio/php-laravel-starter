# Templating the GeoPoint field

The GeoPoint field is used for Geolocation coordinates. It works by adding coordinates or by pasting a Google Maps URL.

## Get the latitude and longitude

Here's an example of how to integrate the GeoPoint field into your templates. In this case the GeoPoint field has the API ID of `location`.

```
@php
    $latitude = $document->data->location->latitude;
    $longitude = $document->data->location->longitude;
@endphp

<p>Location: {{ $latitude . ', ' . $longitude }}</p>
// Outputs: Location: 48.880401900547, 2.3423677682877
```
