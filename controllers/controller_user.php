<?php
require_once '/home/andrew/PHP_Progects/stihi/model/model_user.php';
class Controller_user 
{
    public function __construct()
    {
        $this -> modelUser = new Model_user;
    }
    
    
    private function createPasswordhash($password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT); 
        return $hash;
    }
    
   private function createColumnset($biographyUpdateList)
    {
        $columns = '';
        foreach (array_keys($biographyUpdateList) as &$column)  {
            $columns.= str_replace("%column%",  $column, "%column%".","." ");
        }
        $columnSet = rtrim($columns, ",\ ");
        return $columnSet;
    }   
    
   private function getPlaceHoldersString($biographyUpdateList)
    {
        $qq='';
        foreach(array_keys($biographyUpdateList) as $q)
        {  
        $qq.= str_replace("%q%",  $q, ":"."%q%".","." ");
        }
        $placeHoldersString = rtrim($qq, ",\ ");
        return "(".$placeHoldersString.")";
    }
    
    
    private function createDataset($biographyUpdateList)
    {
        $data = '';
        foreach ($biographyUpdateList as &$value) {
            $data.= str_replace("%value%",  $value, "'"."%value%"."'".","." ");
        }
        $dataSet = rtrim($data, ",\ ");
        return $dataSet;
    }
    
   private function createPDOset($biographyUpdateList) {
        if (count($biographyUpdateList) >1)
        {
        $columnSet = $this -> createColumnset($biographyUpdateList);
        $dataSet = $this -> createDataset($biographyUpdateList);
        $PDOset = "(".$columnSet.")"." "."="." "."(".$dataSet.")"; 
        }
        else
        {
        $columnSet = $this -> createColumnset($biographyUpdateList);
        $dataSet = $this -> createDataset($biographyUpdateList);
        $PDOset = $columnSet." "."="." ".$dataSet;
        }
       return $PDOset; 
    }
    
    private function exchangeNullFromString($v){
            if ($v == '')
            {   
            $v = 'Пользователь предпочёл удалить эти сведения';
            }
        return $v;
    }
    
    private function createKeysForEncrypt()
    {
    $privateKey = openssl_pkey_new();
    $publicKeyPem = openssl_pkey_get_details($privateKey)['key'];
    $publicKey = openssl_pkey_get_public($publicKeyPem);
    return $publicKey;
    }
    
    
    function createJSWToken($openToken, $userId)
    {
    $token64 = base64_encode($openToken); 
    $cipher = 'rc4-hmac-md5';
    $ivlen = openssl_cipher_iv_length($cipher);
    $ivKey = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $key = openssl_random_pseudo_bytes($ivKey);
    file_put_contents($userId.'-iv', $iv);
    file_put_contents($userId.'-key', $key);
    $encrypted_data = openssl_encrypt($token64, $cipher, $key, 0, $iv);
    return $encrypted_data;
}
    
    function decryptToken($cookieToken, $userId)
    {
    $cipher = 'rc4-hmac-md5'; 
    $ivFromDecrypt = file_get_contents($userId.'-iv');
    $keyFromDecrypt = file_get_contents($userId.'-key');
    $cookieTokenDecode = openssl_decrypt($cookieToken, $cipher, $keyFromDecrypt, 0, $ivFromDecrypt);
    $token = base64_decode($cookieTokenDecode);
    return $token;
    }
    
    /*function createRefreshToken()
    {}*/
    
    function createOpenToken($role, $userId)
    {
    $array = array("role"=> $role, "userid" => $userId);
    $openToken = json_encode($array);
    return $openToken;    
    }
    
    function getToken($cookieToken)
    {
    $token = $this -> decryptToken($cookieToken);
    return $token;   
    }
    
    function sendToken($openToken, $userId){
    $token = $this -> createJSWToken($openToken, $userId);
    return $token;
    }
    
    function createOneArrayByArrays($arr)
    {
        $oneArray = array();
        foreach ($arr as $a)
        {
            foreach ($a as $column)
            {
                $oneArray[] = $column; 
            }
        return $oneArray;
        }
    }

    function getAllusersID()
        {
        $allId = $this -> modelUser -> getAllUsersID();
        
        return $allId;
        }
    
    function getAllusersNick()
    {
        $nicks = $this -> modelUser -> getAllUsersNick();
        return $nicks;
    }
    
    function getUserIdFromNick($nick)
    {
        $oneArray = array();
        $nameArr = array($nick);
        $idarr = $this -> modelUser -> selectUserFromNick($nameArr);
        $id = array_merge($oneArray, ...$idarr);
        $idStr = $id['id'];
        return $idStr;
    }
    
    function getUserFromId($id)
    {
        $oneArray = array();
        $idarr = array($id);
        $userArr = $this -> modelUser -> selectUserFromId($idarr);
        if (empty($userArr)){
            echo "user not found";
        }
        else {
        $user = array_merge($oneArray, ...$userArr);
        $userWithoutNull = array_map('Controller_user::exchangeNullFromString',$user);
        return $userWithoutNull;
        }
        
    }
    
    
    function update($biographyUpdateList, $id) {
            $idarr = array($id);
            $pdoSet = $this -> createPDOset($biographyUpdateList);
            $this -> modelUser -> updateUser($pdoSet, $idarr);
        }   
    
    function getUsers()
    {
    $users = $this -> modelUser -> get_all_users();
    return $users;
    }
    
    function entry ($nick, $password) {
        $nickArr = array($nick);
        $enter = $this -> modelUser -> entry_in_page($nickArr);
        foreach ($enter as $apass){
            $hash = $apass['password'];
            $veryfe = password_verify($password, $hash); #возможно есть решение лучше. Но работает    
        }
        switch  ($veryfe) {
            case TRUE: 
            $open = true;
                break;
            case FALSE:
                $open = false;
                break;
        }
    return $open;     
    }

    function createNewuser($newUser)
    {
        $hash = $this -> createPasswordhash($newUser['password']);
        $newUser['password'] = $hash;
        $newUserWithoutEmpty = array_filter($newUser);
        $columnSet = $this -> createColumnset($newUserWithoutEmpty);
        $placeHoldersString = $this -> getPlaceHoldersString($newUserWithoutEmpty);
        $this -> modelUser -> entryNewUser($columnSet, $newUserWithoutEmpty, $placeHoldersString);
    }
    
    
    function addPicture(){
        
        switch ($cD){
            case true: 
        break;
        }
        
    }
   
}
/*$newControllerUserObj = new Controller_user;
$id = $newControllerUserObj -> getUserIdFromNick('Mikel');
echo $id;*/