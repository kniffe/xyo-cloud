<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$this->set("application_title", "User groups");

$this->set("head_name", "User");
$this->set("head_user_group", "Group");
$this->set("head_enabled", "Enabled");
$this->set("head_id", "Id");

$this->set("search_name","User");
$this->set("search_user_group","Group");

$this->set("select_xyo_user_any", "- user -");
$this->set("select_xyo_user_group_any", "- user group -");

$this->set("label_id_xyo_user", "User");
$this->set("label_id_xyo_user_group", "User group");

$this->set("select_xyo_user_group_none","- none -");
