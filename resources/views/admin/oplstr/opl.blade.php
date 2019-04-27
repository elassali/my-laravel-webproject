@extends('layouts.AdminMaster')
@section('content')

<?php
// Your Openload URL
$url = array(
              'https://streamcherry.com/embed/pdmptqqqqnltsbbo',
              'https://streamcherry.com/embed/pdmptqqqqnltsbbffo',
              'https://streamango.com/embed/pdmptqqqqnltsbbo',
              'https://streamango.com/embed/pdmptqqqqnltsbbogg',
              'https://vidcloud.co/embed/5c9c1b6364065/',
              'https://vidcloud.co/embed/5c9c1b636406dd5/',
              'https://openload.co/embed/roq8vEyKZBk/',
              'https://openload.co/embed/roq8vEyKZBkfgffh/',
);
function strposa($haystack, $needles=array(), $offset=0) {
        $chr = array();
        foreach($needles as $needle) {
                $res = stripos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
}
$unavailablestatus = array(
    '<img class="image-blocked" src="/assets/img/blocked.png" alt="blocked">',
    '<h1 style="text-align: center !important;">Sorry!</h1>',
    '<div class="img-404"><img src="/images/file-not-found.jpg" title="404" alt="404"></div>'
);
foreach($url as $surl)
{


// Initialize cURL library.
if (($curl = curl_init()) === FALSE)
{
        $errno = curl_errno();
        throw new RuntimeException("curl_init() ($errno): " . curl_strerror($errno));
}

// Tell cURL which URL to operate on. GET is the default method.
curl_setopt($curl, CURLOPT_URL, $surl);

// Optionally specify a path to a certificate store in PEM format.
// curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
// Given Openload URL is requested over https. Allow for some sanity checking.
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
// Set this to the latest SSL standard supported by PHP at the time of this answer.
curl_setopt($curl, CURLOPT_SSLVERSION, 6);

// Return response, so we can inspect its contents.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
// Openload returns HTTP code 200 if a video wasn't found. Any code >= 400 indicates a different problem.
curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);
// Allow for server-side redirects.
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
// Don't include header in response.
curl_setopt($curl, CURLOPT_HEADER, FALSE);

if (($response = curl_exec($curl)) === FALSE)
    throw new RuntimeException("curl_exec() failed for $surl: " . curl_error($curl));

// Perform a case-insensitive search for a token that is specific to the 'video not found' page.

if (strposa($response, $unavailablestatus, 1)) {
    echo 'unavailable==>'.$surl.'<br />';
} else {
    echo 'available==>'.$surl.'<br />';
}

}

?>


    
@endsection