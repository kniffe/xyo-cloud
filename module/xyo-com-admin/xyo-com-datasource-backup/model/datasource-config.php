<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$layer = $this->getElementValue("layer", "xyo");
$connection = $this->getElementValue("connection", "db");
$date=date("YmdHis");
$stamp=md5(time().rand());
$this->setParameter("date", $date);
$this->setParameter("stamp", $stamp);

$configFileName = null;
$fileName = "config/config.ds.backup.php";
$moduleName = "";
if ($layer === "xyo") {    
    $moduleName = "xyo-mod-datasource-xyo";
} else
if ($layer === "csv") {
    $moduleName = "xyo-mod-datasource-csv";
} else
if ($layer === "mysql") {
    $moduleName = "xyo-mod-datasource-mysql";
} else
if ($layer === "postgresql") {
    $moduleName = "xyo-mod-datasource-postgresql";
} else
if ($layer === "sqlite") {
    $moduleName = "xyo-mod-datasource-sqlite";
} else {
    $this->setError("error", array("unknown_layer" => $layer));
    return;
}

$configFileName = $fileName;

$this->setParameter("config_file", $configFileName);

$fileHandle = null;
if ($fileName) {
    $fileHandle = fopen($fileName, "w");
};

if ($fileHandle) {
    fwrite($fileHandle, "<" . "?" . "php\r\n");
    fwrite($fileHandle, "defined('XYO_CLOUD') or die('Access is denied');\r\n");
    fwrite($fileHandle, "// \r\n");
    fwrite($fileHandle, "// Data Source Layer Config\r\n");
    fwrite($fileHandle, "// \r\n");

    if ($layer === "xyo") {
        fwrite($fileHandle, "\$this->setConnection" .
                "(\"backup\"," .
                "\"repository/datasource-backup/".$connection.".".$date.".".$stamp.".xyo/\");" .
                "\r\n");
		@mkdir("repository/datasource-backup/".$connection.".".$date.".".$stamp.".xyo");
		@copy($this->path."index.html","repository/datasource-backup/".$connection.".".$date.".".$stamp.".xyo/index.html");
    } else
    if ($layer === "csv") {
        fwrite($fileHandle, "\$this->setConnection" .
                "(\"backup\"," .
                "\"repository/datasource-backup/".$connection.".".$date.".".$stamp.".csv/\");" .
                "\r\n");
		@mkdir("repository/datasource-backup/".$connection.".".$date.".".$stamp.".csv");
		@copy($this->path."index.html","repository/datasource-backup/".$connection.".".$date.".".$stamp.".csv/index.html");
    } else
    if ($layer === "mysql") {
        fwrite($fileHandle, "\$this->setConnection(" .
                "\"backup\",\"" .
                addslashes($this->getElementValueStr("username")) .
                "\",\"" .
                addslashes($this->getElementValueStr("password")) .
                "\",\"" .
                addslashes($this->getElementValueStr("server")) .
                "\",\"" .
                addslashes($this->getElementValueStr("port")) .
                "\",\"" .
                addslashes($this->getElementValueStr("database")) .
                "\",\"" .
                addslashes($this->getElementValueStr("prefix")) .
                "\");\r\n");
        fwrite($fileHandle, "\$this->setConnectionOption(" .
                "\"backup\",\"debug\",true);\r\n");
        fwrite($fileHandle, "\$this->setConnectionOption(" .
                "\"backup\",\"log\",false);\r\n");
        fwrite($fileHandle, "\$this->setConnectionOption(" .
                "\"backup\",\"force_use\",false);\r\n");
    } else
    if ($layer === "postgresql") {
        fwrite($fileHandle, "\$this->setConnection(" .
                "\"backup\",\"" .
                addslashes($this->getElementValueStr("username")) .
                "\",\"" .
                addslashes($this->getElementValueStr("password")) .
                "\",\"" .
                addslashes($this->getElementValueStr("server")) .
                "\",\"" .
                addslashes($this->getElementValueStr("port")) .
                "\",\"" .
                addslashes($this->getElementValueStr("database")) .
                "\",\"" .
                addslashes($this->getElementValueStr("prefix")) .
                "\");\r\n");
        fwrite($fileHandle, "\$this->setConnectionOption(" .
                "\"backup\",\"debug\",true);\r\n");
        fwrite($fileHandle, "\$this->setConnectionOption(" .
                "\"backup\",\"log\",false);\r\n");
    } else
    if ($layer === "sqlite") {
        fwrite($fileHandle, "\$this->setConnection(\"backup\"," .                
                "\"repository/datasource-backup/".$connection.".".$date."." . $stamp . ".sqlite\",0666);\r\n");
        fwrite($fileHandle, "\$this->setConnectionOption(\"backup\",\"debug\"," .
                "true);\r\n");
        fwrite($fileHandle, "\$this->setConnectionOption(\"backup\",\"log\"," .
                "false);\r\n");
    };

    fwrite($fileHandle, "\r\n\r\n");
    fclose($fileHandle);
} else {
    $this->setError("error", array("config_not_writable" => $fileName));
    return;
}

$moduleDatasourceLayer = &$this->cloud->getModule($moduleName);
if ($moduleDatasourceLayer) {
    
} else {
    $this->setError("error", array("unknown_layer" => $layer));
    return;
};

$moduleDatasourceLayer->includeFile($configFileName);

if ($this->isError()) {
    
} else {

    $conDb = &$moduleDatasourceLayer->getConnection("backup");
    if ($conDb) {
        if ($conDb->open()) {
            $conDb->close();
        } else {
            $this->setError("error", array("connection_error" => "backup"));
            return;
        }
    } else {
        $this->setError("error", array("connection_unknown" => "backup"));
        return;
    }
}

