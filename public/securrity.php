
<?php
require_once "/home/andrew/PHP_Progects/stihi/model/model_user.php";
class Securrity
{

public $role; 
public $typ;
public $userId;
public $nick;

function __construct($role='user', $typ ='acess', $userId, $nick)
{
$this->role = $role;
$this->typ = $typ;   
$this->userId = $userId;
$this->nick = $nick;
}

private function createHeader()
{$typ = $this -> typ;
return array('alg'=>'md5', 'typ' => $typ);
}

private function createOpenToken()
{
$role = $this -> role;
$userId = $this -> userId;
return array("role"=> $role, "userid" => $userId);
}

function createToken()
{ 
$userId = $this->userId;
$cipher = 'rc4-hmac-md5';
$token64 = self::createOpenAcessToken();
$ivlen = openssl_cipher_iv_length($cipher);
$ivKey = openssl_cipher_iv_length($cipher);
$iv = openssl_random_pseudo_bytes($ivlen);
$key = openssl_random_pseudo_bytes($ivKey);
file_put_contents($userId.'-iv', $iv);
file_put_contents($userId.'-key', $key);
self::createSign($token64, $userId);
$publicKey = file_get_contents($userId.'-'.'publicKey.pem');
return openssl_encrypt($token64.'.'.$publicKey, $cipher, $key, 0, $iv);
}

function createRefreshToken($password){
$refreshToken = self::createOpenRefreshToken($password);
$userId = $this->userId;
$userNick = $this->nick;
$cipher = 'rc4-hmac-md5';
$ivlen = openssl_cipher_iv_length($cipher);
$ivKey = openssl_cipher_iv_length($cipher);
$iv = openssl_random_pseudo_bytes($ivlen);
$key = openssl_random_pseudo_bytes($ivKey);
file_put_contents($userId.'-'.$userNick.'-iv', $iv);
file_put_contents($userId.'-'.$userNick.'-key', $key);
self::createSign($refreshToken, $userId.'-'.$userNick);
$publicKey = file_get_contents($userId.'-'.$userNick.'-'.'publicKey.pem');
return openssl_encrypt($refreshToken.'.'.$publicKey, $cipher, $key, 0, $iv);
}

function createOpenRefreshToken($password)
{
    $userNick = $this-> nick;
    $userId = $this->userId;
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $array = array("userAgent" => $userAgent, "userNick" => $userNick, "password" => $password);
    $header= self::createHeader();
    $data = array('header'=>$header,'data' => $array);
    $$data = json_encode($data);
    return base64_encode($$data);
}

function decryptToken($cookieToken)
{
$userId = $this -> userId;
$cipher = 'rc4-hmac-md5'; 
$ivFromDecrypt = file_get_contents($userId.'-iv');
$keyFromDecrypt = file_get_contents($userId.'-key');
return openssl_decrypt($cookieToken, $cipher, $keyFromDecrypt, 0, $ivFromDecrypt);
}

private function createOpenAcessToken(){
$header = self::createHeader();
$openToken = self::createOpenToken();
$openAcessToken = array('header'=>$header,'openToken'=>$openToken);
$$openAcessToken = json_encode($openAcessToken);
return base64_encode($$openAcessToken);
}


}