<?php

/** 
 * @Entity 
 * @Table(name="article")
 *
 * @property integer     $id
 * @property string      $title
 * @property string      $author
 * @property string      $content
 * @property datetime    $created
 * @property integer     $readCount
 * @property integer     $category
 * @property integer     $deleted
 **/

class Article extends ModelBase {

    static public $categories = array(
        'INDEX' => array('首页', array(
            'NEWS' => array(1, '新闻简报'),
            'ANNOUNCE' => array(5, '通知公告'),
            'ACTIVATY' => array(9, '学术交流'),
            )),
        'PROJECT' => array('承担项目', array(
            'L' => array(11, '纵向课题'),
            'T' => array(12, '横向课题'),
            )),
        'ACHIE' => array('科研成果', array(
            'THESIS' => array(21, '论文'),
            'MONOGRAPH' => array(22, '专著'),
            'AWARD' => array(23, '获奖'),
            'PATENT' => array(24, '专利'),
            )),
        'EXCHANGE' => array('学术交流', array(
            'ACTIVATY' => array(31, '学术活动'),
            'REPORT' => array(32, '学术报告'),
            )),
        'FOUNDATION' => array('开放基金', array(
            'MANAGE' => array(41, '管理规定'),
            'GUIDE' => array(42, '指南通告'),
            // 'LIST' => array(43, '开放课题目录'),
            // 'CONTRACT' => array(44, '开放课题合同书'),
            'FUNDING' => array(45, '历年资助'),
            )),
        'TRAIN' => array('人才培养', array(
            'TEACHERS' => array(51, '导师'),
            'GRADUATE' => array(52, '研究生'),
            'LOONGSON' => array(53, '龙芯奖学金'),
            )),
        'RULES' => array('规章制度', array(
            'RULES' => array(61, '规章制度 '),
            )),
        'FINDING' => array('招纳贤才', array(
            'FINDING' => array(71, '招纳贤才'),
            )),
        );

    /**
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue
     **/
    private $id;

    /**
     * @Column(name="title", type="string", length=50)
     **/
    private $title;

    /**
     * @Column(name="author")
     **/
    private $author;

    /**
     * @Column(name="content", type="text")
     **/
    private $content;

    /**
     * @Column(name="created", type="datetime")
     **/
    private $created;

    /**
     * @Column(name="category", type="integer")
     **/
    private $category;

    /**
     * @Column(name="readCount", type="integer")
     **/
    private $readCount;

    /**
     * @Column(name="deleted", type="integer")
     **/
    private $deleted;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($a) {
        $this->author = $a;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getReadCount() {
        return $this->readCount;
    }

    public function setReadCount($rc) {
        $this->readCount = $rc;
    }

    public function getDelete() {
         return $this->deleted;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($cat) {
        $this->category = $cat;
    }

    public function setDeleted() {
        $this->deleted = 1;
    }

    public function setNotDeleted() {
        $this->deleted = 0;
    }

    public function __construct($title, $author, $content) {
        $this->title = $title;
        $this->author = $author;
        $this->content = $content;
        $this->category = 0;
        $this->readCount = 0;
        $this->deleted = 0;
    }

    static public function getCat ($input) {
        $arr = explode('_', $input);
        return Article::$categories[$arr[0]][1][$arr[1]][0];
    }

    static public function getList($page=1, $pagesize=20, $asc=false) {
        $dql = sprintf(
            'SELECT n FROM %s n WHERE n.deleted = 0 '.
            'ORDER BY n.created %s',
            get_called_class(),
            $asc ? 'ASC' : 'DESC'
        );
        $query = static::em()->createQuery($dql)->setMaxResults($pagesize)->setFirstResult($pagesize*($page-1));
        return $query->useQueryCache(false)->getResult();
    }

    static public function getSpecList($cat, $page=1, $pagesize=20, $asc=false) {
        $dql = sprintf(
            'SELECT n FROM %s n WHERE n.deleted = 0 and n.category = %d'.
            'ORDER BY n.created %s',
            get_called_class(),
            $cat,
            $asc ? 'ASC' : 'DESC'
        );
        $query = static::em()->createQuery($dql)->setMaxResults($pagesize)->setFirstResult($pagesize*($page-1));
        return $query->useQueryCache(false)->getResult();
    }

}
