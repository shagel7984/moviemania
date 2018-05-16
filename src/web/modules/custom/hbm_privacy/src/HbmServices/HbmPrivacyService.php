<?php
namespace Drupal\hbm_privacy\HbmServices;

use Drupal\Core\Datetime\DrupalDateTime;
use GuzzleHttp\Exception\RequestException;

/**
 * Class HbmPrivacyService
 * @package Drupal\hbm_privacy\HbmServices
 * requests a url and saves the content of the response html
 * into a file on the local file system
 */
class HbmPrivacyService {

  private $destinationFolder;
  private $fileName;

  public function __construct(){
    $this->destinationFolder = file_default_scheme() . '://hbm_privacy';
    if (!file_exists($this->destinationFolder)) {
      mkdir($this->destinationFolder, 0777, true);
    }
    $this->fileName = 'hbm_privacy.html';
  }

  /**
   * @return array
   * retrieves the
   */
  public function getPrivacyData(){

    $hbmPrivacyConfig = \Drupal::config('hbm_privacy.settings');
    $hbmPrivacyUrl = $hbmPrivacyConfig->get('privacy_url');
    $client = \Drupal::httpClient();
    $url = $hbmPrivacyUrl;
    $method = 'GET';

    $now = new DrupalDateTime('now', 'UTC');
    $lastExecutionTime = $now->format('c');

    $statusMessage = [
      'lastExecutionTime' => $lastExecutionTime,
    ];

    try {
      $response = $client->request($method, $url);
      $code = $response->getStatusCode();

      if ($code == 200) {
        $data = $response->getBody()->getContents();

        if (strlen ($data) > 100){
          $filePath = $this->destinationFolder . '/' . $this->fileName;

          $fileCreated = file_save_data($data, $filePath, $replace = FILE_EXISTS_REPLACE);

          if ($fileCreated){
            $statusMessage['status'] = t('File was created:') . $filePath;
            //return $statusMessage;
          }else{
            $statusMessage['status'] = t('File could not be created:') . $filePath;
            //return $statusMessage;
          }
        }else{
          $statusMessage['status'] = t('An error occured during the request: The response length was less than 100 signs');
          //return $statusMessage;
        }
      }else{
        $statusMessage['status'] = t('An error occured during the request:') . $code;
        //return $statusMessage;
      }
    }
    catch (RequestException $e) {
      watchdog_exception('hbm_privacy', $e);
      $statusMessage['status'] = t('An error occured:') . $e;
      //return $statusMessage;
    }

    \Drupal::state()->set('hbm_privacy_service.statusmessage', $statusMessage['lastExecutionTime'] .
      ' - Coordinated Universal Time (UTC) - ' .
      $statusMessage['status']);
    return $statusMessage;
  }

  public function providePrivacyData(){
    $privacyFilePath = $this->destinationFolder . '/' . $this->fileName;
    $privacyFileContent = file_get_contents($privacyFilePath);
    $privacyContent = (!empty($privacyFileContent)) ? $privacyFileContent : 'We are sorry, there is no privacy data available at the moment. Please contact our webmaster';

    return $privacyContent;
  }

}