<?php
define('AES_METHOD', 'aes-256-cbc');
class Encription_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
	$this->load->model('datatables_model','DT');
	$this->load->library('encryption');
	//$this->load->library('session');
	}
	// public function encrypt($plain_text) {
	// 	$ciphertext = $this->encryption->encrypt($plain_text);
	// 	return $ciphertext;
	// }

	public function encrypt($message) {
		$password = 'av3DYGLkwBsErphcyYp+imUW4QKs19hU';
		if (OPENSSL_VERSION_NUMBER <= 268443727) {
			throw new RuntimeException('OpenSSL Version too old, vulnerability to Heartbleed');
		}
		
		$iv_size        = openssl_cipher_iv_length(AES_METHOD);
		$iv             = openssl_random_pseudo_bytes($iv_size);
		$ciphertext     = openssl_encrypt($message, AES_METHOD, $password, OPENSSL_RAW_DATA, $iv);
		$ciphertext_hex = bin2hex($ciphertext);
		$iv_hex         = bin2hex($iv);
		return "$iv_hex:$ciphertext_hex";
	}

	public function decrypt($ciphered) {
		$password = 'av3DYGLkwBsErphcyYp+imUW4QKs19hU';
		$iv_size    = openssl_cipher_iv_length(AES_METHOD);
        $data       = explode(":", $ciphered);
        $iv         = hex2bin($data[0]);
        $ciphertext = hex2bin($data[1]);
        return openssl_decrypt($ciphertext, AES_METHOD, $password, OPENSSL_RAW_DATA, $iv);
	}

	public function encrypt_decrypt($action, $string) {
		//$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'FeriWasHere';
		$secret_iv = 'FeriWasHere1988';
		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'decrypt' ) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}
}