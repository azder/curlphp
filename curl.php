<?php

class Curl 
{
  /**
  * @var CURL session.
  */
  private $ch;
  
  /**
  * @var String curl response.
  */
  private $response;
  
  /**
  * @var String $USER_AGENT the default user agent.
  */
  public static $USER_AGENT = 'php_curl_session';
  
  /**
  * Creates and initializes new CURL session.
  *
  * @return void.
  */
  public function __construct()
  {
    $this->ch = curl_init();
    $this->initialize();
  }
  
  /**
  * Closes the created CURL session.
  *
  * @return void.
  */
  public function __destruct()
  {
    curl_close($this->ch); 
  }
  
  /**
  * Initializes the new CURL session.
  *
  * @return Curl self.
  */
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
    return $this;
  }
  
  /**
  * Performs GET request.
  *
  * @param String $url the request url.
  * @return Curl self.
  */
  public function get($url)
  {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_HTTPGET, TRUE);
    $this->response = curl_exec($this->ch);
    return $this;
  }
  
  /**
  * Performs POST request.
  *
  * @param String $url the request url.
  * @param array $params the post params.
  * @return Curl self.
  */
  public function post($url, $params = array())
  {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_POST, TRUE);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
    $this->response = curl_exec($this->ch);
    return $this;
  }
  
  /**
  * Performs PUT request.
  *
  * @param String $url the request url.
  * @param array $params the put params.
  * @return Curl self.
  */
  public function put($url, $params = array())
  {
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
    $this->response = curl_exec($this->ch);
    return $this;
  }
  
  /**
  * Performes DELETE request.
  *
  * @param String $url the request url.
  * @param array $params the delete params.
  * @return Curl self.
  */
  public function delete($url, $params)
  {
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
    $this->response = curl_exec($this->ch);
    return $this;
  }
  
  /**
  * Performs basic http authentication.
  *
  * @param String $username.
  * @param String $password.
  * @return Curl self.
  */
  public function authenticate($username, $password)
  {
    curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($this->ch, CURLOPT_USERPWD, "{$username}:{$password}");
    return $this;
  }
  
  /**
  * Sets custom headers.
  *
  * @param array $headers.
  * @return Curl self.
  */
  public function set_headers($headers = array())
  {
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    return $this;
  }
  
  /**
  * Moves the curl session in debug mode to display extra info.
  *
  * @return Curl self.
  */
  public function set_debug_mode()
  {
    curl_setopt($this->ch, CURLOPT_VERBOSE, TRUE); 
    curl_setopt($this->ch, CURLOPT_HEADER, TRUE);
    curl_setopt($this->ch, CURLOPT_NOPROGRESS, FALSE);
    return $this;
  }
  
  /**
  * Fetches the response from the request.
  *
  * @return String response or FALSE on error.
  */
  public function get_response()
  {
    return $this->response; 
  }
  
  /**
  * Checks if the request is successful.
  *
  * @return boolean
  */
  public function request_succeeded()
  {
    return curl_errno($this->ch) === 0;
  }
  
  /**
  * Fetches the error from the last request.
  *
  * @return String the error string.
  */
  public function get_error()
  {
    return curl_error($this->ch); 
  }
  
  
}


// eof php
