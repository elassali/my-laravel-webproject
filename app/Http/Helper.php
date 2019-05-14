<?php
use App\Apilogins;
class Helper{

  // delte files function for openload and vidcloud because theire only api who accept delete
  public static function deletefile($fileid,$hostedname)
  {
        if($hostedname == 'openload')
        {
          $url = 'https://api.openload.co/1/file/delete?login=c54cd983a54a8356&key=eUZoeKCx&file='.$fileid;
        } 
        else if($hostedname == 'verystream')
        {
          $url = 'https://api.verystream.com/file/delete?login=cd9384b495e21dc324d7&key=2khMPhTbrvH&file='.$fileid;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 7);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    
  }
  // function that check all the array
  public static function strposa($haystack, $needles=array(), $offset=0) {
    $chr = array();
    foreach($needles as $needle) {
            $res = stripos($haystack, $needle, $offset);
            if ($res !== false) $chr[$needle] = $res;
    }
    if(empty($chr)) return false;
    return min($chr);
}
  // function that give it file id and return if video available or not
  public static function videoavailable($files=array())
  {
    $urls = array();
    $validurls = array();
    if($files[0] == null)
    {return 0;}
    //////////////
    $i=0;
    $fileurls = array(
      "https://api.openload.co/1/remotedl/status?login=c54cd983a54a8356&key=eUZoeKCx&limit=1&id=".$files[0],
      "https://api.fruithosted.net/remotedl/status?login=XecbFWa41f&key=ANDLQnMp&limit=1&id=".$files[1],
      "https://api.verystream.com/remotedl/status?login=cd9384b495e21dc324d7&key=2khMPhTbrvH&limit=1&id=".$files[2]
    );
    //openload
    foreach($fileurls as $item)
    {
      $rn = curl_init($item);
      curl_setopt($rn, CURLOPT_TIMEOUT, 5);
      curl_setopt($rn, CURLOPT_CONNECTTIMEOUT, 5);
      curl_setopt($rn, CURLOPT_RETURNTRANSFER, true);
      $data = curl_exec($rn);
      curl_close($rn);
      $data = json_decode($data,true);
      $data["result"];
      $result=$data["result"];
        if(isset($result[$files[$i]])) 
        {
          $result=$result[$files[$i]];
          array_push($urls , $result["url"]);
        }       
      $i++;
    }
    
    // extract all available url
    $unavailablestatus = array(
      '<img class="image-blocked" src="/assets/img/blocked.png" alt="blocked">',
      '<h1 style="text-align: center !important;">Sorry!</h1>',
      // '<div class="img-404"><img src="/images/file-not-found.jpg" title="404" alt="404"></div>',
      '<img class="image-blocked" src="/images/abuse.png" alt="blocked">'
  );
  foreach($urls as $singleurl)
  {
  
  $singleurl = str_replace(array("/f/","/v/","/stream/"),array("/embed/","/embed/","/e/"),$singleurl);
  // Initialize cURL library.
  if (($curl = curl_init()) === FALSE)
  {
          $errno = curl_errno();
          throw new RuntimeException("curl_init() ($errno): " . curl_strerror($errno));
  }
  
  // Tell cURL which URL to operate on. GET is the default method.
  curl_setopt($curl, CURLOPT_URL, $singleurl);
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
  
  $response = curl_exec($curl);
  // if ($response === FALSE)
  //     throw new RuntimeException("curl_exec() failed for $singleurl: " . curl_error($curl));
  
  // Perform a case-insensitive search for a token that is specific to the 'video not found' page.
 if($response !="")
 {
  if (Helper::strposa($response, $unavailablestatus, 1)) {
    // to edit after finding what to do with it
     

    } 
else {
  array_push($validurls,$singleurl);
}

 }
  
 
  
      
  
  }//foreach

     return $validurls;
  }

  //get user ip
 public static function getUserIP()
  {
     if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
           return  $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      return   $ip_address = $_SERVER['REMOTE_ADDR'];
      }
                    
  }

}
