<?php

namespace Model;

function merge ($arr, $idx) {
    return array_merge($arr[$idx], array('id' => $idx, 'label' => $arr[$idx]['title']));
}

function modify ($arr, $idx, $params) {
    if (isset($params[$idx.'_title']))
        $arr[$idx]['title'] = $params[$idx.'_title'];
    if (isset($params[$idx.'_content']))
        $arr[$idx]['content'] = $params[$idx.'_content'];
    return $arr;
}

class ResearchStaticContent extends StaticContent {

    public function render () {
        $this->toArray();
        $content = $this->getContent();
        $content['system'] = merge($content, 'system');
        $content['theory'] = merge($content, 'theory');
        $content['security'] = merge($content, 'security');
        $content['sustain'] = merge($content, 'sustain');
        return $content;
    }

    public function parse ($params) {
        $this->toArray();
        $content = $this->getContent();

        $content = modify($content, 'system', $params);
        $content = modify($content, 'theory', $params);
        $content = modify($content, 'security', $params);
        $content = modify($content, 'sustain', $params);

        $this->setContent($content);
        $this->save();
    }

}