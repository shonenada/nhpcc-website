<?php

namespace Model;

/** 
 * @Entity 
 * @Table(name="user")
 *
 * @property integer   $id
 * @property string    $username
 * @property string    $password
 * @property string    $name
 * @property string    $email
 * @property string    $phone
 * @property datetime  $created
 * @property datetime  $lastLogin
 * @property string    $ip
 * @property text      $short_intro
 * @property text      $intro
 * @property integer   $level
 **/

class User extends ModelBase{

    const USER_LEVEL = 1;
    const STUDNET_LEVEL = 3;
    const TEACHER_LEVEL = 5;
    const SUPER_USER_LEVE = 9;
    const ADMIN_LEVEL = 15;
    
    /**
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue
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
     * @Column(name="email", type="string", length=50)
     **/
    private $email;

    /**
     * @Column(name="phone", type="string", length=11)
     **/
    private $phone;

    /**
     * @Column(name="created", type="datetime")
     **/
    private $created;

    /**
     * @Column(name="lastLogin", type="datetime")
     **/
    private $lastLogin;

    /**
     * @Column(name="ip", type="string", length=16)
     **/
    private $ip;

    /**
     * @Column(name="short_intro", type="text")
     **/
    private $shortIntro;

    /**
     * @Column(name="intro", type="text")
     **/
    private $intro;

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

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($raw, $salt) {
        $hashPassword = User::hashPassword($raw, $salt);
        $this->password = $hashPassword;
    }

    public function checkPassword($raw, $salt) {
        return ($this->password == self::hashPassword($raw, $salt));
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getLastLogin() {
        return $this->lastLogin;
    }

    public function setLastLogin($ll) {
        $this->lastLogin = $ll;
    }

    public function getIP() {
        return $this->ip;
    }

    public function setIP($ip) {
        $this->ip = $ip;
    }

    public function getShortIntro() {
        return $this->shortIntro;
    }

    public function setShortIntro($si) {
        $this->shortIntro = $si;
    }

    public function getIntro() {
        return $this->intro;
    }

    public function setIntro($intro){
        $this->intro = $intro;
    }

    public function getLevel() {
        return $this->level;
    }

    public function setLevel($level) {
        $this->level = $level;
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

    static public function hashPassword($password, $salt) {
        $hash = md5("{$salt}{$password}{$salt}");
        return $hash;
    }

    static public function getList($page=1, $pagesize=20, $asc=false) {
        $dql = sprintf(
            'SELECT n FROM %s n WHERE n.level > 0'.
            'ORDER BY n.id %s',
            get_called_class(),
            $asc ? 'ASC' : 'DESC'
        );
        $query = static::em()->createQuery($dql)->setMaxResults($pagesize)->setFirstResult($pagesize*($page-1));
        return $query->useQueryCache(false)->getResult();
    }

    static public function findByUsername($username) {
        return static::query()->findBy(array('username' => $username));
    }

    static public function getTeamList() {
        $dql = sprintf(
            'SELECT n FROM %s n WHERE n.level = %d or n.level = %d'.
            'ORDER BY n.created ASC',
            get_called_class(),
            User::TEACHER_LEVEL,
            User::SUPER_USER_LEVE
        );
        $query = static::em()->createQuery($dql);
        return $query->useQueryCache(false)->getResult();
    }

}
