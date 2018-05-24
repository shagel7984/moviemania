<?php

namespace Drupal\hbm_privacy\HbmServices;

use Drupal\Core\Datetime\DrupalDateTime;
use GuzzleHttp\Exception\RequestException;

/**
 * Class HbmPrivacyService.
 *
 * @package Drupal\hbm_privacy\HbmServices
 * Requests a url and saves the content of the response html
 * into a file on the local file system
 */
class HbmPrivacyService {

  /**
   * The destination folder of the hbm_privacy file.
   *
   * @var string
   */
  protected $destinationFolder;

  /**
   * The file name.
   *
   * @var string
   */
  protected $fileName;

  /**
   * HbmPrivacyService constructor.
   */
  public function __construct() {

    $this->destinationFolder = file_default_scheme() . '://hbm_privacy';
    if (!file_exists($this->destinationFolder)) {
      mkdir($this->destinationFolder, 0777, TRUE);
    }
    $this->fileName = 'hbm_privacy.json';
  }

  /**
   * Function getPrivacyData()
   *
   * @return array
   *   retruns a success or error status message
   */
  public function getPrivacyData() {

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

        if (strlen($data) > 100) {
          $filePath = $this->destinationFolder . '/' . $this->fileName;

          $fileCreated = file_save_data($data, $filePath, $replace = FILE_EXISTS_REPLACE);

          if ($fileCreated) {
            $statusMessage['success'] = TRUE;
            $statusMessage['status'] = t('File was created:') . $filePath;
          }
          else {
            $statusMessage['success'] = FALSE;
            $statusMessage['status'] = t('File could not be created:') . $filePath;
          }
        }
        else {
          $statusMessage['success'] = FALSE;
          $statusMessage['status'] = t('An error occured during the request: The response length was less than 100 signs');
        }
      }
      else {
        $statusMessage['success'] = FALSE;
        $statusMessage['status'] = t('An error occured during the request:') . $code;
      }
    }
    catch (RequestException $e) {
      watchdog_exception('hbm_privacy', $e);
      $statusMessage['success'] = FALSE;
      $statusMessage['status'] = t('An error occured:') . $e;
    }

    \Drupal::state()->set('hbm_privacy_service.statusmessage', $statusMessage['lastExecutionTime'] .
      ' - Coordinated Universal Time (UTC) - ' .
      $statusMessage['status']);

    return $statusMessage;

  }

  /**
   * Function providePrivacyData()
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup|string
   *   Returns the privacy data.
   */
  public function providePrivacyData() {

    $privacyFilePath = $this->destinationFolder . '/' . $this->fileName;
    $privacyContent['success'] = FALSE;

    if (file_exists($privacyFilePath)) {
      $privacyFileContent = file_get_contents($privacyFilePath);
      if ($privacyFileContent) {
        $privacyJson = json_decode($privacyFileContent, TRUE);
        if (isset($privacyJson['html'])) {
          $privacyContent['success'] = TRUE;
          $privacyContent['content'] = $privacyJson['html'];
          if (isset($privacyJson['js'])) {
            $privacyContent['content'] .= '<script type="text/javascript">' . $privacyJson['js'] . '</script>';
          }
        }
      }
    }
    else {
      /* If the file does not exists try again to generate the file */
      $statusMessage = $this->getPrivacyData();
      if ($statusMessage['success']) {
        $privacyContent = $this->providePrivacyData();
      }
    }

    return $privacyContent;
  }

}
