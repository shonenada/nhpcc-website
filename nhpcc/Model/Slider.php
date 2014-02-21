<?php

namespace Model;
/** 
 * @Entity 
 * @Table(name="slider")
 *
 * @property integer   $id
 * @property string    $title
 * @property string    $pic
 * @property string    $url
 **/

class Slider extends ModelBase{

    /**
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue
     **/
    private $id;

    /**
     * @Column(name="title", type="string", length=50)
     **/
    private $title;

    /**
     * @Column(name="pic", type="string", length=250)
     **/
    private $pic;

    /**
     * @Column(name="url", type="string", length=250)
     **/
    private $url;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPic() {
        return $this->pic;
    }

    public function getUrl() {
        return $this->url;
    }

    public function __construct($title, $pic, $url) {
        $this->title = $title;
        $this->pic = $pic;
        $this->url = $url;
    }
}
