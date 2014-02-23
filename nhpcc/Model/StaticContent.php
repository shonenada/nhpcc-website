<?php

namespace Model;

// A class to handle static content which stored in json file.
// Not a doctrine Model.

class StaticContent {

    const NONE_TEMPLATE = 'NONE';
    const FULL_TEMPLATE = 'full_static_template';
    const DOUBLE_COLUMN_TEMPLATE = 'double_column_static_template';

    protected $path;
    protected $title;
    protected $content;
    protected $template;

    public function getPath () {
        return $this->path;
    }

    public function setPath ($path) {
        $this->path = $path;
    }

    public function getTitle () {
        return $this->title;
    }

    public function setTitle ($title) {
        $this->title = $title;
    }

    public function getContent () {
        return $this->content;
    }

    public function setContent ($content) {
        $this->content = $content;
    }

    public function setTemplate ($template) {
        $this->template = $template;
    }

    public function getTemplate () {
        return $this->template;
    }

    public function saveTo ($filepath) {
        $contentToSave = array(
            'title' => $this->title,
            'template' => $this->template,
            'content' => $this->content,
        );
        $jsonContent = json_encode($contentToSave, JSON_PRETTY_PRINT);
        file_put_contents($filepath, $jsonContent);
    }

    public function save () {
        return $this->saveTo($this->path);
    }

    public function loadFrom ($filepath, $asArray=false) {
        $jsonContent = self::loadJson($filepath, $asArray);
        $this->setPath($filepath);

        if ($asArray){
            $this->setTitle($jsonContent['title']);
            $this->setContent($jsonContent['content']);
            $this->setTemplate($jsonContent['template']);
        }
        else {
            $this->setTitle($jsonContent->title);
            $this->setContent($jsonContent->content);
            $this->setTemplate($jsonContent->template);
        }

    }

    public function load ($asArray=false) {
        $this->loadFrom($this->path, $asArray);
    }

    public function toArray () {
        $this->load(true);
    }

    public function toObject () {
        $this->load(false);
    }

    static public function loadJson ($filepath, $asArray) {
        $fileContent = file_get_contents($filepath);
        $jsonContent = json_decode($fileContent, $asArray);
        return $jsonContent;
    }

    static public function loadFromFile ($filepath, $asArray=false) {
        $clsName = get_called_class();
        $return = new $clsName();
        $return->loadFrom($filepath, $asArray);
        return $return;
    }

    public function render () {
        return array(
            array(
                'id' => 'content',
                'title' => $this->getTitle(),
                'content'=> $this->getContent(),
            ),
        );
    }

    public function parse ($params) {
        if (isset($params['content_title']))
            $this->setTitle($params['content_title']);

        if (isset($params['content_content']))
            $this->setContent($params['content_content']);
    }

}