<?
// Скрипт проверки успешного входа на сайт

// Соединямся с БД
include './db_connect.php';
$link=mysqli_connect("localhost", "a0193693_esp32_advanced", "981010", "a0193693_esp32_advanced");

//print_r($_COOKIE);
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
    or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0"))) {
            $login_success = 1;
        } else {
            //print "Привет, ".$userdata['user_login'].". Всё работает!";
            $login_success = 1;
        }
} else {
    //print "Включите куки";
    $login_success = 0;
}
?>