<?php 
    //Запускаем сессию
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>GENERVIS</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>


<script type="text/javascript">
    $(document).ready(function(){
        "use strict";
        //регулярное выражение для проверки email
        var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
        var mail = $('input[name=email]');
        
        mail.blur(function(){
            if(mail.val() != ''){
                // Проверяем, если email соответствует регулярному выражению
                if(mail.val().search(pattern) == 0){
                    // Убираем сообщение об ошибке
                    $('#valid_email_message').text('');
                    //Активируем кнопку отправки
                    $('input[type=submit]').attr('disabled', false);
                }else{
                    //Выводим сообщение об ошибке
                    $('#valid_email_message').text('Не правильный Email');
                    // Дезактивируем кнопку отправки
                    $('input[type=submit]').attr('disabled', true);
                }
            }else{
                $('#valid_email_message').text('Введите Ваш email');
            }
        });
    });
</script>

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


             <!-- Tab panes -->
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                        <div class="tab" role="tabpanel">
           
           <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Восстановление пароля</a></li>
            </ul>
             <!-- Tab panes -->
            <div class="tab-content tabs" style = "margin-top:0px">
     
              <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                  <form class="form-horizontal" action="send_link_reset_password.php" method="post" name="form_request_email">
              <center><img src = "../../assets/logo_techfeya.jpg" width="55%"></img></center>
                
            <!-- Блок для вывода сообщений -->
            <div class="block_for_messages">
                <?php
                    if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
                        echo $_SESSION["error_messages"];
                         //Уничтожаем ячейку error_messages, чтобы сообщения об ошибках не появились заново при обновлении страницы
                        unset($_SESSION["error_messages"]);
                    }
                    if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
                        echo $_SESSION["success_messages"];
                        
                        //Уничтожаем ячейку success_messages,  чтобы сообщения не появились заново при обновлении страницы
                        unset($_SESSION["success_messages"]);
                    }
                ?>
            </div>


<?php 
    //Проверяем, если пользователь не авторизован, то выводим форму регистрации, 
    //иначе выводим сообщение о том, что он уже зарегистрирован
    if((!isset($_SESSION["email"]) && !isset($_SESSION["password"]))) {
        if(!isset($_GET["hidden_form"])){
?>

                
                
                    
                    <p class="text_center mesage_error" id="valid_email_message"></p>
                    
                    
                        <div class="form-group">
                            <label for="exampleInputEmail1">email</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"></label>
                            <img src="captcha.php" alt="Капча" /> <br />
                            <input type="password" name="captcha" class="form-control" id="exampleInputPassword1">
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
                            <button type="submit" class="btn btn-default" name="send">Восстановить</button>
                        </div>
                        
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php 
    	}//закрываем условие hidden_form
?>
<center>
    <div>
        <a href="../../">Вернуться на главную</a>
    </div>
</center>

<?php
    }else{
?>
        <div id="authorized">
            <h2>Вы уже авторизованы</h2>
        </div>
<?php
    }
?>





