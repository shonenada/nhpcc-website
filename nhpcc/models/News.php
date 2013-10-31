<?php

/** 
 * @Entity 
 * @Table(name="news")
 *
 * @property integer     $id
 * @property string      $title
 * @property string      $author
 * @property string      $content
 * @property datetime    $created
 * @property integer     $readCount
 * @property integer     $deleted
 **/

class News extends ModelBase {
    
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

    public function getDelete() {
         return $this->deleted;
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
        $this->readCount = 0;
        $this->deleted = 0;
    }


    static public function getList($page=1, $pagesize=20, $asc=false) {
        $dql = sprintf(
            'SELECT n FROM %s n WHERE n.deleted = 0 '.
            'ORDER BY n.id %s', 
            get_called_class(),
            $asc ? 'ASC' : 'DESC'
        );
        $query = static::em()->createQuery($dql)->setMaxResults($pagesize)->setFirstResult($pagesize*($page-1));
        return $query->useQueryCache(false)->getResult();
    }

}
