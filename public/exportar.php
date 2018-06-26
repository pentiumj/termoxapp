<?php
/*
for($i=0;$i<128;$i++) {
    echo "$i>" . bin2hex(chr($i)) . "<" . PHP_EOL;
}
*/

error_reporting(E_ALL);

include_once("./libs/mysqldump.php");

use Ifsnop\Mysqldump as IMysqldump;

$dumpSettings = array(
    'exclude-tables' => array('/^travis*/'),
    'compress' => IMysqldump\Mysqldump::NONE,
    'no-data' => false,
    'add-drop-table' => true,
    'single-transaction' => true,
    'lock-tables' => true,
    'add-locks' => true,
    'extended-insert' => false,
    'disable-keys' => true,
    'skip-triggers' => false,
    'add-drop-trigger' => true,
    'routines' => true,
    'databases' => false,
    'add-drop-database' => false,
    'hex-blob' => true,
    'no-create-info' => false,
    'where' => ''
    );

$dump = new IMysqldump\Mysqldump(
    "mysql:host=localhost;dbname=termox",
    "root",
    "",
    $dumpSettings);

date_default_timezone_set('America/Bogota');

$t = time();
$dump->start("../backup/termox-" .date("Y-m-d H i s",$t). ".sql");

$dumpSettings['default-character-set'] = IMysqldump\Mysqldump::UTF8MB4;
$dumpSettings['complete-insert'] = true;

echo "<script>alert('La base de datos se ha exportado en la carpeta backup');location.href='paraExportar.php';</script>";

exit;


