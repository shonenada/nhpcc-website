<?php

/** 
 * @Entity 
 * @Table(name="user")
 *
 * @property integer   $id
 * @property string    $username
 * @property string    $password
 * @property string    $name
 * @property datetime  $lastLogin
 * @property string    $ip
 * @property integer   $level
 **/

class User{
    
    /**
     * @Column(name="id", type="integer")
     * @Id
     * @GenerateValue(strategy="SEQUENCE")
     **/
    private $id;

    /**
     * @Column(name="username", type="string", length=50)
     **/
    private $username;

    /**
     * @Column(name="password", type="string", length=50)
     **/
    private $password;

    /**
     * @Column(name="name", type="string", length=10)
     **/
    private $name;

    /**
     * @Column(name="lastLogin", type="datetime")
     **/
    private $lastLogin;

    /**
     * @Column(name="ip", type="string", length=16)
     **/
    private $ip;

    /**
     * @Column(name="level", type="integer")
     **/
    private $level;

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getLastLogin() {
        return $this->lastLogin;
    }

    public function setLastLogin($ll){
        $this->lastLogin = $ll;
    }

    public function getIP() {
        return $this->ip;
    }

    public function setIP($ip){
        $this->ip = $ip;
    }

    public function getLevel() {
        return $this->level;
    }

    public function __construct($username) {
        $this->username = $username;
    }

    static public function validateToken($user, $token, $salt) {
        $ip = $user->getIP();
        $lastLogin = $user->getLastLogin()->format('Y-m-d H:i:s');
        $hash = md5($lastLogin . "{" . $salt . "}" . $ip);
        if($hash == $token){
            return $user;
        }else{
            return NULL;
        }
    }

    static public function hashPassword($passowrd, $salt){
        $hash = md5("{$salt}{$passowrd}{$salt}");
        return $hash;
    }

}
