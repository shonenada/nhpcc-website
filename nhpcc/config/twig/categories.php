<?php

return array(
    "home" => array("title" => "首页", "url" => "/", "id" => "home"),
    "overview" => array("title" => "实验室概况", "url" => "/overview", "sub" => array(
            array("title" => "实验室简介", "url" => "/overview/introduction"),
            array("title" => "学术委员会", "url" => "/overview/academic"),
            array("title" => "研究队伍", "url" => "/overview/team")
        )),
    "research" => array("title" => "研究方向", "url" => "/research"),
    "projects" => array("title" => "承担项目", "url" => "/projects", "sub" => array(
            array("title" => "纵向课题", "url" => "/projects/l"),
            array("title" => "横向课题", "url" => "/projects/t")
        )),
    "achievements" => array("title" => "科研成果", "url" => "/achievements", "sub" => array(
            array("title" => "论文", "url" => "/achievements/theies"),
            array("title" => "专著", "url" => "/achievements/monographs"),
            array("title" => "获奖", "url" => "/achievements/awards"),
            array("title" => "专利", "url" => "/achievements/patents")
        )),
    "exchange" => array("title" => "学术交流", "url" => "/exchange", "sub" => array(
            array("title" => "学术活动", "url" => "/exchange/activities"),
            array("title" => "学术报告", "url" => "/exchange/reports")
        )),
    "foundation" => array("title" => "开放基金", "url" => "/foundation", "sub" => array(
            array("title" => "开放课题管理办法", "url" => "/foundation/manage"),
            array("title" => "开放课题申请指南", "url" => "/foundation/guide"),
            array("title" => "开放课题目录", "url" => "/foundation/list"),
            array("title" => "开放课题合同书", "url" => "/foundation/contract"),
        )),
    "train" => array("title" => "人才培养", "url" => "/train", "sub" => array(
            array("title" => "导师名单", "url" => "/train/teachers"),
            array("title" => "研究生名单", "url" => "/train/graduate"),
            array("title" => "导师名单", "url" => "/train/loongson"),
        )),
    "rules" => array("title" => "规章制度", "url" => "/rules"),
    "finding" => array("title" => "广纳贤才", "url" => "/finding"),
    "download" => array("title" => "下载中心", "url" => "/download"),
);
