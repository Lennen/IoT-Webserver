<?
// Соединямся с БД
include './db_connect.php';
$link=mysqli_connect("localhost", "a0193693_esp32_advanced", "981010", "a0193693_esp32_advanced");
////////////////////// Страница регистрации нового пользователя ////////////////////////////

if($_POST['step'] == 2)
{
    $err = [];

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = mysqli_real_escape_string($link, $_POST['login']);
        $password = mysqli_real_escape_string($link, $_POST['password']);
        
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $patro = mysqli_real_escape_string($link, $_POST['patro']);
        $surname = mysqli_real_escape_string($link, $_POST['surname']);
        $affiliation = mysqli_real_escape_string($link, $_POST['organization']);
        $job = mysqli_real_escape_string($link, $_POST['job']);

        mysqli_query($link,"INSERT INTO users (user_login, user_password, user_email, user_name, user_patro, user_surname, user_affiliation, user_job_title) VALUES ('{$login}', '{$password}', '{$email}', '{$name}', '{$patro}', '{$surname}', '{$affiliation}', '{$job}')");
        //mysqli_query($link,"INSERT INTO users (user_login, user_password, user_email, user_name, user_patro) VALUES ('{$login}', '{$password}', '{$email}', '{$name}', '{$patro}')");
        //header("Location: login.php"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}



////////////////// Страница авторизации //////////////////////

// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

if($_POST['step'] == 1)
{   
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    // Сравниваем пароли
    if($data['user_password'] === $_POST['password'])
    {   
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));


            // Если пользователя выбрал привязку к IP
            // Переводим IP в строку
            //$insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";

        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!

        //print_r($_COOKIE);
        //echo($data['user_id']);
        //echo(" hesh ");
        //echo($hash);
        // Переадресовываем браузер на страницу проверки нашего скрипта
        echo "<script>document.location.href='index.php';</script>";
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


<style>
a:hover,a:focus{
 outline: none;
 text-decoration: none;
}
.tab{
 background: white;
 background: -webkit-linear-gradient(to bottom, white, white);
 background: linear-gradient(to bottom, white, white);
 padding: 40px 50px;
 position: relative;
}
.tab:before{
 content: "";
 width: 100%;
 height: 100%;
 display: block;
 position: absolute;
 top: 0;
 left: 0;
 background: linear-gradient(white,white);
 opacity: 0.85;
}
.tab .nav-tabs{
 border-bottom: none;
 padding: 0 20px;
 position: relative;
}
.tab .nav-tabs li{ margin: 0 30px 0 0; }
.tab .nav-tabs li a{
 font-size: 18px;
 color: #525050;
 border-radius: 0;
 text-transform: uppercase;
 background: transparent;
 padding: 0;
 margin-right: 0;
 border: none;
 border-bottom: 2px solid transparent;
 opacity: 0.5;
 position: relative;
 transition: all 0.5s ease 0s;
}
.tab .nav-tabs li a:hover{ background: transparent; }
.tab .nav-tabs li.active a,
.tab .nav-tabs li.active a:focus,
.tab .nav-tabs li.active a:hover{
 border: none;
 background: transparent;
 opacity: 1;
 border-bottom: 2px solid #eec111;
 color: #525050;
}
.tab .tab-content{
 padding: 20px 0 0 0;
 margin-top: 40px;
 background: transparent;
 z-index: 1;
 position: relative;
}
.form-bg{ background: #ddd; }
.form-horizontal .form-group{
 margin: 0 0 15px 0;
 position: relative;
}
.form-horizontal .form-control{
 height: 40px;
 background: #C4C4C4;
 border: none;
 border-radius: 7px;
 box-shadow: none;
 padding: 0 20px;
 font-size: 14px;
 font-weight: bold;
 color: #828282;
 transition: all 0.3s ease 0s;
}
.form-horizontal .form-control:focus{
 box-shadow: none;
 outline: 0 none;
}
.form-horizontal .form-group label{
 padding: 0 20px;
 color: #7f8291;
 text-transform: capitalize;
 margin-bottom: 10px;
}
.form-horizontal .main-checkbox{
 width: 20px;
 height: 20px;
 background: #C4C4C4;
 float: left;
 margin: 5px 0 0 20px;
 border: 1px solid #525050;
 position: relative;
}
.form-horizontal .main-checkbox label{
 width: 20px;
 height: 20px;
 position: absolute;
 top: 0;
 left: 0;
 cursor: pointer;
}
.form-horizontal .main-checkbox label:after{
 content: "";
 width: 10px;
 height: 5px;
 position: absolute;
 top: 5px;
 left: 4px;
 border: 3px solid #fff;
 border-top: none;
 border-right: none;
 background: transparent;
 opacity: 0;
 -webkit-transform: rotate(-45deg);
 transform: rotate(-45deg);
}
.form-horizontal .main-checkbox input[type=checkbox]{ visibility: hidden; }
.form-horizontal .main-checkbox input[type=checkbox]:checked + label:after{ opacity: 1; }
.form-horizontal .text{
 float: left;
 font-size: 14px;
 font-weight: bold;
 color: #525050;
 margin-left: 7px;
 line-height: 20px;
 padding-top: 5px;
 text-transform: capitalize;
}
.form-horizontal .btn{
 width: 100%;
 background: #0CAF3A;
 padding: 10px 20px;
 border: none;
 font-size: 14px;
 font-weight: bold;
 color: #fff;
 border-radius: 9px;
 text-transform: uppercase;
 margin: 20px 0 30px 0;
}
.form-horizontal .btn:focus{
 background: #eec111;
 color: #828282;
 outline: none;
 box-shadow: none;
}
.form-horizontal .forgot-pass{
 border-top: 1px solid #615f6c;
 margin: 0;
 text-align: center;
}
.form-horizontal .forgot-pass .btn{
 width: auto;
 background: transparent;
 margin: 30px 0 0 0;
 color: #525050;
 text-transform: capitalize;
 transition: all 0.3s ease 0s;
}
.form-horizontal .forgot-pass .btn:hover{ color: #eec111; }
@media only screen and (max-width: 479px){
 .tab{ padding: 40px 20px; }
}
</style>

<div class="container">
 <div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="tab" role="tabpanel">
             <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Вход</a></li>
                <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Регистрация</a></li>
            </ul>
             <!-- Tab panes -->
            <div class="tab-content tabs" style="margin-top:0px">
                <center><img src = "assets/logo_techfeya.jpg" width="55%"></img></center>
                <br/>
                <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                    
                    <form class="form-horizontal" method="POST" id="login">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Имя пользователя</label>
                            <input type="text" name="login" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Пароль</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <div class="main-checkbox">
                                <input value="None" id="checkbox1" name="check" type="checkbox">
                                <label for="checkbox1"></label>
                            </div>
                            

                            <span class="text">Оставаться в системе</span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="step" value="1" />
                            <button type="submit" class="btn btn-default">Войти</button>
                        </div>
                        <div class="form-group forgot-pass">
                            <a href="recovery_password/change_password/reset_password.php" class="btn btn-default">Забыт пароль</a>
                        </div>
                    </form>
                </div>
                
                <div role="tabpanel" class="tab-pane fade" id="Section2">
                    <form class="form-horizontal" method="POST" id="reg">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Введите логин</label>
                            <input type="text" name="login" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Придумайте пароль</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Укажите Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Имя</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Отчество</label></label>
                            <input type="text" name="patro" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Фамилия</label>
                            <input type="text" name="surname" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Место работы</label>
                            <input type="text" name="organization" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Должность</label>
                            <input type="text" name="job" class="form-control" id="exampleInputEmail1">
                        </div>
                        
                        <div class="form-group">
                            <input type="hidden" name="step" value="2" />
                            <button type="submit" name="submitReg" class="btn btn-default">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div><!-- /.col-md-offset-3 col-md-6 -->
  </div><!-- /.row -->
</div><!-- /.container -->






