<?php

return array(
    "home" => array("title" => "首页", "url" => "/", "id" => "home"),
    "overview" => array("title" => "实验室概况", "url" => "/overview/introduction", "sub" => array(
            "introduction" => array("title" => "实验室简介", "url" => "/overview/introduction"),
            // "academic" => array("title" => "学术委员会", "url" => "/overview/academic"),
            // "team" => array("title" => "研究队伍", "url" => "/overview/team")
        )),
    "research" => array("title" => "研究方向", "url" => "/research",// "sub" => array(
        // "system" => array('title' => '普及型高性能计算机体系结构', 'url' => "/research/system"),
        // "theory" => array('title' => '普及型高性能计算机系统软件及理论', 'url' => "/research/theory"),
        // "security" => array('title' => '普及型高性能计算安全防护', 'url' => "/research/security"),
        // "sustain" => array('title' => '普及型高性能计算机应用基础理论和支撑技术', 'url' => "/research/sustain"),
        // )
    ),
    "team" => array("title" => "研究队伍", "url" => "/overview/team", "sub" => array(
    // "projects" => array("title" => "承担项目", "url" => "/projects", "sub" => array(
            // "l" => array("title" => "纵向课题", "url" => "/projects/l"),
            // "t" => array("title" => "横向课题", "url" => "/projects/t")
        )),
    "achievements" => array("title" => "项目成果", "url" => "/achievements", "sub" => array(
            "theies" => array("title" => "论文", "url" => "/achievements/theies"),
            "monographs" => array("title" => "专著", "url" => "/achievements/monographs"),
            "awards" => array("title" => "获奖", "url" => "/achievements/awards"),
            "patents" => array("title" => "专利", "url" => "/achievements/patents"),
            "projects" => array("title" => "项目", "url" => "/projects"),
        )),
    "exchange" => array("title" => "学术交流", "url" => "/exchange", "sub" => array(
        )),
    "foundation" => array("title" => "开放基金", "url" => "/foundation", "sub" => array(
            "guide" => array("title" => "指南通告", "url" => "/foundation/guide"),
            "manage" => array("title" => "管理规定", "url" => "/foundation/manage"),
            "funding" => array("title" => "历年资助", "url" => "/foundation/funding"),
            // "contract" => array("title" => "开放课题合同书", "url" => "/foundation/contract"),
            // "list" => array("title" => "开放课题目录", "url" => "/foundation/list"),
        )),
    "train" => array("title" => "人才培养", "url" => "/train", "sub" => array(
            // "teachers" => array("title" => "导师名单", "url" => "/train/teachers"),
            "graduate" => array("title" => "研究生名单", "url" => "/train/graduate"),
            "loongson" => array("title" => "龙芯奖学金", "url" => "/train/loongson"),
        )),
    "rules" => array("title" => "规章制度", "url" => "/rules"),
    "finding" => array("title" => "广纳贤才", "url" => "/finding"),
    "download" => array("title" => "下载中心", "url" => "/download"),
);
