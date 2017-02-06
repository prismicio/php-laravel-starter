<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Prismic\Api;
use Prismic\LinkResolver;
use Prismic\Predicates;
use Illuminate\Http\Request;

// Onboarding
$apiEndpoint = config('prismic.url');
$repoEndpoint = str_replace("/api", "", $apiEndpoint);
$url = $repoEndpoint . '/app/settings/onboarding/run';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("language=php&framework=laravel"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($ch);
curl_close($ch);

// INSERT YOUR ROUTES HERE

/**
 * Route for prismic.io preview functionality
 */
Route::get('/preview', function (Request $request) {
    $token = $request->input('token');
    $url = $request['api']->previewSession($token, $request['linkResolver'], '/');
    setcookie(Prismic\PREVIEW_COOKIE, $token, time() + 1800, '/', null, false, false);
    return response(null, 302)->header('Location', $url);
});

/**
 * Index Route
 */
Route::get('/', function () {
    return redirect('/help');
});


/**
* Help page
*/
Route::get('/help', function (Request $request) {
    $repoRegexp = '/^(https?:\/\/([\\-\\w]+)\\.[a-z]+\\.(io|dev))\/api$/';
    preg_match($repoRegexp, $request['endpoint'], $match);
    $repoURL = $match[1];
    $name = $match[2];
    $host = URL::to('/');
    $isConfigured = $name !== 'your-repo-name';
    return view('help', [
        'isConfigured' => $isConfigured,
        'repoURL' => $repoURL,
        'name' => $name,
        'host' => $host,
    ]);
});
