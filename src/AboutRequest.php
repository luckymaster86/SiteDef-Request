<?php
namespace LuckyMaster\SiteDef\Request;
/*
 * Данные о запросе к сайту
 * Автор: LuckyMaster
 */
class AboutRequest {
    
    private $userAgent = '';
    private $ip = '';
    private $url = '';
    private $cookie = '';
    private $remotePort = '';
    private $remoteAddress = '';
    private $requestMethod = '';
    private $requestTime = '';
    private $PHPSESSID = '';
    private $referer = '';


    public function __construct() {
        
        // Вызываем методы для заполнения данных пользователя
        $setMethods = array(
                            'setUserAgent',
                            'setIp',
                            'setUrl',
                            'setCookie',
                            'setRemotePort',
                            'setRemoteAdrress',
                            'setRequestMethod',
                            'setRequestTime',
                            'setPHPSESSID',
                            );
        foreach($setMethods as $method) {
            $this->$method();
        }
    }
   
    private function setUserAgent(){
        $this->userAgent = (@$_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : '';
    }

        private function setIp() {
        $this->ip = substr($_SERVER['REMOTE_ADDR'], 0, 50);
        return True;
    }
    
    private function setUrl(){
        $this->url = @$_SERVER['REQUEST_URI'];
    }
    
    private function setCookie(){
        $this->cookie = serialize($_COOKIE);
        if(strlen($this->cookie) > 1024){
            $this->cookie = 'cookie was too long to store! sorry!';
        }
    }
    
    
    private function setPHPSESSID(){
       
        if ( isset($_COOKIE['PHPSESSID']) ){
            
            if ( strlen($_COOKIE['PHPSESSID']) > 1024 ){
                $this->PHPSESSID = substr($_SESSION['PHPSESSID'], 0, 1024);
                
                return;
            }
            
            $this->PHPSESSID = $_COOKIE['PHPSESSID'];
        }
    }


    
    private function setRemotePort(){
        $this->remotePort = @$_SERVER['REMOTE_PORT'];
    }
   
    private function setRemoteAdrress(){
        $this->remoteAddress = @$_SERVER['REMOTE_ADDR'];
    }
    
    private function setRequestMethod(){
        $this->requestMethod = @$_SERVER['REQUEST_METHOD'];
    }
    
    private function setRequestTime(){
        $this->requestTime = @$_SERVER['REQUEST_TIME'] ? @$_SERVER['REQUEST_TIME']: '';
    }

    private function setReferer(){
        $this->referer = @$_SERVER['HTTP_REFERER'];
    }

    

    //=============================================================
    public function getUserAgent() {
        return $this->userAgent;
    }
    public function getIp() {
        return $this->ip;
    }
    
    public function getUrl(){
        return $this->url;
    }
    
    public function getCookie(){
        return $this->cookie;
    }
    
    public function getPHPSESSID(){
        return $this->PHPSESSID;
    }

    public function getRemotePort(){
        return $this->remotePort;
    }
   
    public function getRemoteAdrress(){
        return $this->remoteAddress;
    }
    
    public function getRequestMethod(){
        return $this->requestMethod;
    }
    
    public function getRequestTime(){
        return $this->requestTime;
    }
    
    public function getReferer(){
        return $this->referer;
    }
}