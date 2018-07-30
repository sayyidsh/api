<?php
/**
 * User: sayyid
 * Date: 30/07/2018
 * Time: 01:47 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'menu') !== true)
    {
        $sql = "CREATE TABLE `menu` (
	`rowid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(50) NOT NULL,
	`arTitle` VARCHAR(100) NOT NULL,
	`enTitle` VARCHAR(100) NOT NULL,
	`Active` TINYINT(3) UNSIGNED NOT NULL DEFAULT '1',
	PRIMARY KEY (`rowid`),
	UNIQUE INDEX `code` (`code`),
	INDEX `Active` (`Active`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/menus/push/menu.php?code=10&arTitle=بيتزا&enTitle=Pizza&Active=1
    $code = isset($_GET['code']) && $_GET['code'] !== '' ? Quoted($_GET['code'])  : 'null';
    $arTitle = isset($_GET['arTitle']) && $_GET['arTitle'] !== '' ? Quoted($_GET['arTitle']) : 'null';
    $enTitle = isset($_GET['enTitle']) && $_GET['enTitle'] !== '' ? Quoted($_GET['enTitle']) : 'null';
    $Active = isset($_GET['Active']) && $_GET['Active'] !== '' ? $_GET['Active'] : 'null';

    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO menu (code, arTitle, enTitle, Active )
    VALUES ($code, arTitle, enTitle, $ID, Active)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
