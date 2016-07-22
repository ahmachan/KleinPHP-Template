<?php
namespace SecretCrypt;
/**
 * Base64 加密实现类
 */
class Base64Crypt {

	/** @var string */
	private $privateKey;
	/** @var int */
	private $expireDate=0;
	
	/**
	 * 加密key
	 * @param string $strKey
	 */
	public function setPrivateKey($strKey)
	{
		$this->privateKey=$strKey;
	}
	
	/**
	 * 有效期（秒）
	 * @param unknown $expire
	 */
	public function setExpireDate($expire)
	{
		$this->expireDate=$expire;
	}
	
	
	/**
	 * 其中一种实例化方式
	 * @return Base64Crypt
	 */
	public function createInstance()
	{
		$b64Crypt = new Base64Crypt();
	    $b64Crypt->setPrivateKey($this->privateKey);
	    $b64Crypt->setExpireDate($this->expireDate);	
		return $b64Crypt;
	}
	
	/**
	 * 另外一种实例化方式
	 * Initialize new Base64Crypt object
	 */
	public function __construct($key='',$expire=1)
	{
		$this->privateKey=$key;
		$this->expireDate=$expire;
	}
	
	/**
	 * return array
	 */
	public function getGoodsQuery(){
		return array(
		  ['goodsId'=>1024,'goodsName'=>'g1024'],	
				['goodsId'=>1025,'goodsName'=>'g1025'],
				['goodsId'=>1026,'goodsName'=>'g1026'],
				['goodsId'=>1028,'goodsName'=>'g1028'],
		);
	}
	
	/**
	 * render
	 * @param unknown $val
	 */
	public function render($val){
		return self::encrypt($val);
	}
	
    /**
     * 加密字符串
     * @param string $str 字符串
     * @param string $key 加密key
     * @param integer $expire 有效期（秒）
     * @return string
     */
    public function encrypt($data) {
    	$key=$this->privateKey;
    	$expire=$this->expireDate;
        $expire = sprintf('%010d', $expire ? $expire + time():0);
        $key  = md5($key);
        $data = base64_encode($expire.$data);
        $x    = 0;
        $len  = strlen($data);
        $l    = strlen($key);
        $char = $str    =   '';

        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }

        for ($i = 0; $i < $len; $i++) {
            $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
        }
        return str_replace(array('+','/','='),array('-','_',''),base64_encode($str));
    }

    /**
     * 解密字符串
     * @param string $str 字符串
     * @param string $key 加密key
     * @return string
     */
    public function decrypt($data) {
    	$key=$this->privateKey;
        $key    = md5($key);
        $data   = str_replace(array('-','_'),array('+','/'),$data);
        $mod4   = strlen($data) % 4;
        if ($mod4) {
           $data .= substr('====', $mod4);
        }
        $data   = base64_decode($data);

        $x      = 0;
        $len    = strlen($data);
        $l      = strlen($key);
        $char   = $str = '';

        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }

        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data, $i, 1))<ord(substr($char, $i, 1))) {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            }else{
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        $data   = base64_decode($str);
        $expire = substr($data,0,10);
        if($expire > 0 && $expire < time()) {
            return '';
        }
        $data   = substr($data,10);
        return $data;
    }
}