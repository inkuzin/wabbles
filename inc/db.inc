<?
$GLOBALS['host'] = 'localhost';
$GLOBALS['id'] = 'c11st19';
$GLOBALS['pw'] = 'M1HhLYyWaj3XpICl';
$GLOBALS['db'] = 'c11st19';
function dbconn() {
    $GLOBALS['addconn'] = mysqli_connect($GLOBALS['host'],$GLOBALS['id'],$GLOBALS['pw'],$GLOBALS['db']);
    if(!$GLOBALS['addconn']){
        echo "<script>alert('DB connect error');</script>";
        exit;
    }
    if(!mysqli_select_db($GLOBALS['addconn'],$GLOBALS['db'])){
        echo "<script>alert('Your DB connect error');</script>";
        exit;
    }
}
?>