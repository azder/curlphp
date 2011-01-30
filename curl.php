<?php

class Curl 
{
  private $ch;
  
  private $response;
  
  public static $USER_AGENT = 'php_curl_session';
  
  
  public function __construct()
  {
    $this->ch = curl_init();
    $this->initialize();
  }
  
  public function initialize()
  {
    curl_setopt($this->ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($this->ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($this->ch, CURLOPT_USERAGENT, self::$USER_AGENT); 
    // curl_setopt($this->ch, CURLOPT_COOKIEFILE, '/tmp/curl_client');
    // curl_setopt($this->ch, CURLOPT_COOKIEJAR, '/tmp/curl_client');
    // curl_setopt($this->ch, CURLOPT_HEADER, TRUE);
  }
  
  public function get($url)
  {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_HTTPGET, TRUE);
    $this->response = curl_exec($this->ch);
  }
  
  public function post($url, $params = array())
  {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_POST, TRUE);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
    $this->response = curl_exec($this->ch);
  }
  
  public function put($url, $params = array())
  {
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
    $this->response = curl_exec($this->ch);
  }
  
  public function delete($url, $params)
  {
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
    $this->response = curl_exec($this->ch); 
  }
  
  public function authenticate($username, $password)
  {
    curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($this->ch, CURLOPT_USERPWD, "{$username}:{$password}"); 
  }
  
  public function set_headers($headers = array())
  {
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers); 
  }
  
  public function set_debug_mode()
  {
    curl_setopt($this->ch, CURLOPT_VERBOSE, TRUE); 
    curl_setopt($this->ch, CURLOPT_HEADER, TRUE);
    curl_setopt($this->ch, CURLOPT_NOPROGRESS, FALSE);
  }
  
  
}


// eof php
