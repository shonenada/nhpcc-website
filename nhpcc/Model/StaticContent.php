<?php

namespace Model;

// A class to handle static content which stored in json file.
// Not a doctrine Model.

class StaticContent {

    const NONE_TEMPLATE = 'NONE';
    const FULL_TEMPLATE = 'full_static_template';
    const DOUBLE_COLUMN_TEMPLATE = 'double_column_static_template';

    private $title;
    private $content;
    private $template;

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
        $jsonContent = json_encode($contentToSave);
        file_put_contents($filepath, $jsonContent);
    }

    static public function loadFromFile ($filepath, $asArray=false) {
        $fileContent = file_get_contents($filepath);
        $jsonContent = json_decode($fileContent, $asArray);
        $return = new StaticContent();
        if ($asArray){
            $return->setTitle($jsonContent['title']);
            $return->setContent($jsonContent['content']);
            $return->setTemplate($jsonContent['template']);    
        }
        else {
            $return->setTitle($jsonContent->title);
            $return->setContent($jsonContent->content);
            $return->setTemplate($jsonContent->template);
        }
        return $return;
    }

}