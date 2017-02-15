<?php
namespace LuckyMaster\SiteDef\Request;

/**
 * Description of SiteVisitorLogger
 *
 * @author luckymaster
 */
class SiteRequestLogger {
    private static $db;
    private static $request;
    
    private function __construct() {
        
    }
    
    /*
     * добавление данных в бд
     */
    public static  function logRequestData(\PDO $pdo){
        self::$db = $pdo;
        self::$request = new \LuckyMaster\SiteDef\Request\AboutRequest();
        
        $sql = "INSERT INTO siteRequestLog(userAgent, ip, url, cookie, remotePort, remoteAddress, requestMethod, requestTime, PHPSESSID, referer) "
                . "values (:userAgent, :ip, :url, :cookie, :remotePort, :remoteAddress, :requestMethod, :requestTime, :PHPSESSID, :referer)";
        
        $stmt = self::$db->prepare($sql);
        $res = $stmt->execute(array(
                             ':userAgent' => self::$request->getUserAgent(),
                             ':ip' => self::$request->getIp(),
                             ':url' => self::$request->getUrl(),
                             ':cookie' => self::$request->getCookie(),
                             ':remotePort' => self::$request->getRemotePort(),
                             ':remoteAddress' => self::$request->getRemoteAdrress(),
                             ':requestMethod' => self::$request->getRequestMethod(),
                             ':requestTime' => self::$request->getRequestTime(),
                             ':PHPSESSID' => self::$request->getPHPSESSID(),
                             ':referer' =>  self::$request->getReferer()
                            )
                          );
    }
}