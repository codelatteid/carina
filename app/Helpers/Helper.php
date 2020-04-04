<?php 

namespace App\Helpers;

use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use Log;

class Helper
{
    public static function checkShell($url) {
        $crawler = new Crawler();
        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('GET', $url);

            $html = $r->getBody()->getContents();
            $crawler->addHTMLContent($html);
            $uname = $crawler->filterXpath('//*[@id="system_info"]');
            $data['url'] = $url;

            $data['domain'] = Helper::getDomain($url);

            foreach ($uname as $key => $value) {
                $data['server_info'] = trim($value->nodeValue);
            }
            $data['status'] = 'active';
            
            return $data;
        } catch (\Exception $e) {
            return false;   
        }
    }

    public static function getDomain($url) {
        $pecah_domain = explode('//', $url);
        $pecah_domain2 = explode('/', end($pecah_domain));

        $domain = $pecah_domain2[0];
        return $domain;
    }

    public static function vpsCheck($host, $port, $username, $password) {
        try {
            $connection = ssh2_connect($host, $port);    
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $data['status'] = 'inactive';
            return false;
        }
        
        try {
            ssh2_auth_password($connection, $username, $password);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        $stream = ssh2_exec($connection, "uname -a");
        $stream2 = ssh2_exec($connection, "awk '/^Mem/ {print $2}' <(free -m)");
        stream_set_blocking( $stream, TRUE);
        stream_set_blocking( $stream2, TRUE);
        $data['ip'] = $host;
        $data['port'] = $port;
        $data['user'] = $username;
        $data['password'] = $password;
        $data['server_info'] = str_replace("\n", '', stream_get_contents($stream));
        $data['status'] = 'active';

        return $data;
    }

    public static function cpanelCheck($domain, $port, $username, $password) {
        $url = (($port == '2083') ? 'https' : 'http')."://".$domain.":".$port."/login/?login_only=1";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "user=".$username."&pass=".$password."&goto=/");

        $r = curl_exec($ch);
        curl_close ($ch);
        $output['status'] = json_decode($r, TRUE)['status'];
        return $output;
    }
    
}