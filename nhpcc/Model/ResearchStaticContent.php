<?php

namespace Model;


class ResearchStaticContent extends StaticContent {

    public function render () {
        $this->toArray();
        $content = $this->getContent();

        foreach (array_keys($content) as $idx)
            $content[$idx] = $this->merge($content, $idx);

        return $content;
    }

    public function parse ($params) {
        $this->toArray();
        $content = $this->getContent();

        foreach (array_keys($content) as $idx)
            $content = $this->modify($content, $idx, $params);

        $this->setContent($content);
        $this->save();
    }

    private function merge ($arr, $idx) {
        return array_merge($arr[$idx], array('id' => $idx, 'label' => $arr[$idx]['title']));
    }

    private function modify ($arr, $idx, $params) {
        if (isset($params[$idx.'_title']))
            $arr[$idx]['title'] = $params[$idx.'_title'];
        if (isset($params[$idx.'_content']))
            $arr[$idx]['content'] = $params[$idx.'_content'];
        return $arr;
    }

}