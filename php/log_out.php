<?
    session_start();
    setcookie("c_id", "", time()-1000, '/');
    session_destroy();
?>