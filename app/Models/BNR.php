<?php

/*
namespace App\Models;
use Carbon\Carbon;
use Cache;
use Exception;
use SimpleXMLElement;

class Bnr {
  private static $xmlDocument = "";
  private static $date = "";
  private static $currency = array();
  private static $timezone = "Europe/Bucharest";
  private static $bnrHourUpdate = 13;

  private static $cacheTag = "";
  private static $currentTag = "EUR";
  private static $cacheFlushedAtTag = "bnrcachedate";

  const URL = "http://www.bnr.ro/nbrfxrates.xml";

  public static function curs($tag = "EUR"){
    date_default_timezone_set(self::$timezone);

    self::$cacheTag = "cursbnr" . $tag;
    self::$currentTag = $tag;
    self::checkUpdateHour();
    if(Cache::has(self::$cacheTag)){
      return Cache::get(self::$cacheTag);
    }
    return self::retrieve();
  }

  protected static function checkUpdateHour(){
    $updateTag = self::$cacheFlushedAtTag . self::$currentTag;
    $updatedAt = Carbon::now();

    // BNR Update time is daily at 13:00, but to make sure it's updated when we call it, we add 10 more minutes as waiting time
    // BNR is never updated at 13:00:00 FYI, it usually takes 2-3 minutes
    // Flush all currency cache (EUR, AUD, USD) once update time had passed
    $bnrUpdateTime = Carbon::now();
    $bnrUpdateTime->hour = self::$bnrHourUpdate;
    $bnrUpdateTime->minute = 10;
    $bnrUpdateTime->second = 0;

    if(Cache::has($updateTag)){
      $updatedAt = new Carbon(Cache::get($updateTag));
    } else {
      Cache::flush();
      Cache::add($updateTag, Carbon::now()->toDateTimeString(), Carbon::now()->addMinutes(1440));
      return;
    }

    if($updatedAt->isYesterday() && Carbon::now()->gte($bnrUpdateTime)){
      // is yesterday but BNR was updated for today
      Cache::flush();
      Cache::add($updateTag, Carbon::now()->toDateTimeString(), Carbon::now()->addMinutes(1440));
      return;
    } elseif($updatedAt->diffInDays() > 1){
      // more than 2 days
      //@TODO Check if is weekend. BNR doesn't update in weekends. Uses the friday update.
      Cache::flush();
      Cache::add($updateTag, Carbon::now()->toDateTimeString(), Carbon::now()->addMinutes(1440));
      return;
    } elseif($updatedAt->isSameDay(Carbon::now()) && Carbon::now()->gte($bnrUpdateTime) && $updatedAt->lt($bnrUpdateTime)){
      // check if same day and current time greater than or equal than bnr update and last update is lower than bnr update
      Cache::flush();
      Cache::add($updateTag, Carbon::now()->toDateTimeString(), Carbon::now()->addMinutes(1440));
      return;
    }
    return;
  }

  protected static function retrieve(){
    try{
      $value = self::makeBnrCall();
    } catch (Exception $e){
      return $e->getMessage();
    }
    $expiresAt = Carbon::now()->addMinutes(1440);
    Cache::add(self::$cacheTag, $value, $expiresAt);
    return Cache::get(self::$cacheTag);
  }

  protected static function makeBnrCall(){
    if((self::$xmlDocument = @file_get_contents(self::URL)) === false){
      throw new Exception('Connection error');
    }
    try{
      $xml = @new SimpleXMLElement(self::$xmlDocument);
    }catch (Exception $e){
      throw new Exception("BNR response is wrong");
    }
    self::$date = $xml->Header->PublishingDate;
    foreach($xml->Body->Cube->Rate as $line) {
      self::$currency[] = array("name" => $line["currency"], "value" => $line, "multiplier" => $line["multiplier"]);
    }
    foreach(self::$currency as $line) {
      if($line["name"]==self::$currentTag) {
        return (float)$line["value"];
      }
    }
    throw new Exception("Unidentified Currency", 1);

  }
}
*/
namespace App\Models;
use Carbon\Carbon;
use Dompdf\Image\Cache;
use Exception;
use Barryvdh\DomPDF\PDF;
use SimpleXMLElement;

class Bnr {
  private static $xmlDocument = "";
  private static $date = "";
  private static $currency = array();
  private static $timezone = "Europe/Bucharest";
  private static $bnrHourUpdate = 13;

  private static $cacheTag = "";
  private static $currentTag = "EUR";
  private static $cacheFlushedAtTag = "bnrcachedate";

  const URL = "http://www.bnr.ro/nbrfxrates.xml";

  public static function curs($tag = "EUR"){
    date_default_timezone_set(self::$timezone);

    self::$cacheTag = "cursbnr" . $tag;
    self::$currentTag = $tag;
    self::checkUpdateHour();
    if(Cache::has(self::$cacheTag)){
      return Cache::get(self::$cacheTag);
    }
    return self::retrieve();
  }

  protected static function checkUpdateHour(){
    $updateTag = self::$cacheFlushedAtTag . self::$currentTag;
    $updatedAt = Carbon::now();

    /* BNR Update time is daily at 13:00, but to make sure it's updated when we call it, we add 10 more minutes as waiting time */
    /* BNR is never updated at 13:00:00 FYI, it usually takes 2-3 minutes */
    /* Flush all currency cache (EUR, AUD, USD) once update time had passed */
    $bnrUpdateTime = Carbon::now();
    $bnrUpdateTime->hour = self::$bnrHourUpdate;
    $bnrUpdateTime->minute = 10;
    $bnrUpdateTime->second = 0;

   
    $xmlData = self::retrieveXMLData(); 

    

    echo $xmlData; 
  }

  protected static function retrieveXMLData(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => self::URL,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
  }
}






