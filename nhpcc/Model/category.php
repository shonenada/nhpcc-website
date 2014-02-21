<?php

/** 
 * @Entity 
 * @Table(name="news")
 *
 * @property integer     $id
 * @property string      $title
 * @property text        $description
 **/

class UserModel{
    
    /**
     * @Column(name="id", type="integer")
     * @Id
     * @GenerateValue(strategy="SEQUENCE")
     **/
    private $id;

    /**
     * @Column(name="title", type="string", length=50)
     **/
    private $title;

    /**
     * @Column(name="description", type="text")
     **/
    private $description

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

}
