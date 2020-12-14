<?php
namespace App\Common;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class Jwt{

	private $iss = 'http://www.2001.com';
	private $aud = 'http://www.2001.com';
	private static $instance; //存放静态实例

	private $uid;
	private $secret='!@#$%^&*123456789';
	public $token;
	public $decodetoken;

	private function  __construct(){

	}
	private function  __clone(){

	}

	public static function instance(){
	  if (self::$instance === null) {
	   self::$instance = new self();
	  }
	  return self::$instance;
	}

	//生成token;
	/**
	 * ⦁	iss: jwt签发者
⦁	sub: jwt所面向的用户
⦁	aud: 接收jwt的一方
⦁	exp: jwt的过期时间，这个过期时间必须要大于签发时间
⦁	nbf: 定义在什么时间之前，该jwt都是不可用的.
⦁	iat: jwt的签发时间
⦁	jti: jwt的唯一身份标识，主要用来作为一次性token,从而回避重放攻击。
	 * [encode description]
	 * @return [type] [description]
	 */
	public function encode(){
		$time = time();
		$signer = new Sha256();
		$token = (new Builder())->setHeader('alg','HS256')
		                        ->issuedBy($this->iss) // Configures the issuer (iss claim)
		                        ->permittedFor($this->aud) // Configures the audience (aud claim)
		                        ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
		                        ->issuedAt($time) // Configures the time that the token was issue (iat claim)
		                        ->canOnlyBeUsedAfter($time) // Configures the time that the token can be used (nbf claim)
		                        ->expiresAt($time + 7200) // Configures the expiration time of the token (exp claim)
		                        ->withClaim('uid', $this->uid) // Configures a new claim, called "uid"
		                        ->sign($signer,new Key($this->secret))
		                        ->getToken(); // Retrieves the generated token
		                       // dd($token);
		$this->token =  $token;                    
		return $this;
	}

	public function  setuid($uid){
		$this->uid = $uid;
		return $this;
	}

	public function gettoken(){
		return (string)$this->token;
	}

	public function decode($token){
		$token = (new Parser())->parse((string) $token); // Parses from a string
		
		$this->decodetoken = $token;
		return $this;
	}
	/**
	 * 验证
	 * exp: jwt的过期时间，这个过期时间必须要大于签发时间
	⦁	nbf: 定义在什么时间之前，该jwt都是不可用的.
	⦁	iat: jwt的签发时间
	 * @return [type] [description]
	 */
	public function validate(){
		$data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
		$data->setIssuer($this->iss);
		$data->setAudience($this->aud);
		$data->setId('4f1g23a12aa');
      //  dd($this->decodetoken->validate($data)); 
        
        //验证token是否有效 数据比对不成功
        if ($this->decodetoken->validate($data)) {
            return ['result' => false, 'errorMsg' => '签名错误'];
        }
        
        return true;
	}

	public function checksign(){
		$signer = new Sha256();
        //return $this->decodetoken->verify($signer, $this->secret); 
        return true;
	}

	public function getuid(){
		return $this->decodetoken->getClaim('uid');
	}


}