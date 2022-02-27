<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CSV Reader for CodeIgniter 3.x
 *
 * Library to read the CSV file. It helps to import a CSV file
 * and convert CSV data into an associative array.
 *
 * This library treats the first row of a CSV file
 * as a column header row.
 *
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      CodexWorld
 * @license     http://www.codexworld.com/license/
 * @link        http://www.codexworld.com
 * @version     3.0
 */
class EncDec {
    
    // Columns names after parsing
    private $fields;
    // Separator used to explode each line
    private $separator = ',';

    private $separatorInRow = ';';
    private $separatorInRowWithSpace = '; ';
    // Enclosure used to decorate each field
    private $enclosure = '"';
    // Maximum row size to be used for decoding
    private $max_row_size = 4096;
    
    /**
     * Parse a CSV file and returns as an array.
     *
     * @access    public
     * @param    filepath    string    Location of the CSV file
     *
     * @return mixed|boolean
     */
    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    function stringEncryption($action, $string){
        $output = false;
        
        $encrypt_method = 'AES-256-CBC';                // Default
        $secret_key = date("Y-m-d H").$this->getUserIpAddr();               // Change the key!
        $secret_iv = '!IV@_$2';  // Change the init vector!
        
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = json_decode(openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv));
        }
        
        return $output;
      }
        
}