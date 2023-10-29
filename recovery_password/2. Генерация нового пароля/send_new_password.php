<?php
	
	//Запускаем сессию
	session_start();

	//Добавляем файл подключения к БД
	require_once("dbconnect.php");

	//Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
	$_SESSION["error_messages"] = '';

	//Объявляем ячейку для добавления успешных сообщений
	$_SESSION["success_messages"] = '';

	//Если кнопка готово была нажата
	if(isset($_POST["send"])){

		//Проверяем полученную капчу
		if(isset($_POST["captcha"])){

		    //Обрезаем пробелы с начала и с конца строки
		    $captcha = trim($_POST["captcha"]);

		    if(!empty($captcha)){

		        //Сравниваем полученное значение со значением из сессии. 
		        if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){
		            
		            // Если капча не верна, то возвращаем пользователя на страницу авторизации, и там выведем ему сообщение об ошибке что он ввёл неправильную капчу.

		            $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Вы ввели неправильную капчу </p>";

		            // Сохраняем в сессию сообщение об ошибке. 
		            $_SESSION["error_messages"] = $error_message;

		            //Возвращаем пользователя на страницу авторизации
		            header("HTTP/1.1 301 Moved Permanently");
		            header("Location: ".$address_site."reset_password.php");

		            //Останавливаем скрипт
		            exit();
		        }

		    }else{

		        $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Поле для ввода капчи не должна быть пустой. </p>";

		        // Сохраняем в сессию сообщение об ошибке. 
		        $_SESSION["error_messages"] = $error_message;

		        //Возвращаем пользователя на страницу авторизации
		        header("HTTP/1.1 301 Moved Permanently");
		        header("Location: ".$address_site."reset_password.php");

		        //Останавливаем скрипт
		        exit();

		    }
		
		    //(2) Место для обработки почтового адреса
		    if(isset($_POST["email"])){

		        //Обрезаем пробелы с начала и с конца строки
		        $email = trim($_POST["email"]);

		        if(!empty($email)){
		            $email = htmlspecialchars($email, ENT_QUOTES);

		            //Проверяем формат полученного почтового адреса с помощью регулярного выражения
		            $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

		            //Если формат полученного почтового адреса не соответствует регулярному выражению
		            if( !preg_match($reg_email, $email)){
		                // Сохраняем в сессию сообщение об ошибке. 
		                $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправильный email</p>";
		                
		                //Возвращаем пользователя на страницу авторизации
		                header("HTTP/1.1 301 Moved Permanently");
		                header("Location: ".$address_site."reset_password.php");

		                //Останавливаем скрипт
		                exit();
		            }

		        }else{
		            // Сохраняем в сессию сообщение об ошибке. 
		            $_SESSION["error_messages"] .= "<p class='mesage_error' > <strong>Ошибка!</strong> Поле для ввода почтового адреса(email) не должна быть пустой.</p>";
		            
		            //Возвращаем пользователя на страницу регистрации
		            header("HTTP/1.1 301 Moved Permanently");
		            header("Location: ".$address_site."reset_password.php");

		            //Останавливаем скрипт
		            exit();
		        }
		        

		    }else{
		        // Сохраняем в сессию сообщение об ошибке. 
		        $_SESSION["error_messages"] .= "<p class='mesage_error' > <strong>Ошибка!</strong> Отсутствует поле для ввода Email</p>";
		        
		        //Возвращаем пользователя на страницу авторизации
		        header("HTTP/1.1 301 Moved Permanently");
		        header("Location: ".$address_site."reset_password.php");

		        //Останавливаем скрипт
		        exit();
		    }

		    // (4) Место для составления запроса к БД
		    //Запрос в БД на выборке пользователя.
		    $result_query_select = $mysqli->query("SELECT email_status, email FROM `users` WHERE email = '".$email."'");

		    if(!$result_query_select){
		        // Сохраняем в сессию сообщение об ошибке. 
		        $_SESSION["error_messages"] .= "<p class='mesage_error' > Ошибка запроса на выборке пользователя из БД</p>";
		        
		        //Возвращаем пользователя на страницу регистрации
		        header("HTTP/1.1 301 Moved Permanently");
		        header("Location: ".$address_site."reset_password.php");

		        //Останавливаем скрипт
		        exit();
		    }else{

		        //Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
		        if($result_query_select->num_rows == 1){

		        	//Проверяем, подтвержден ли указанный email
		        	while(($row = $result_query_select->fetch_assoc()) !=false){
		        	    
		        	    //Если email не подтверждён
		        	    if((int)$row["email_status"] == 0){

		        	    	// Сохраняем в сессию сообщение об ошибке. 
		        	    	$_SESSION["error_messages"] = "<p class='mesage_error' ><strong>Ошибка!</strong> Вы не можете восстановить свой пароль, потому что указанный адрес электронной почты ($email) не подтверждён. </p><p>Для подтверждения почты перейдите по ссылке из письма, которую получили после регистрации.</p><p><strong>Внимание!</strong> Ссылка для подтверждения почты, действительна 24 часа с момента регистрации. Если Вы не подтвердите Ваш email в течении этого времени, то Ваш аккаунт будет удалён.</p>";

		        	    	
		        	    	//Возвращаем пользователя на страницу авторизации
		        	    	header("HTTP/1.1 301 Moved Permanently");
		        	    	header("Location: ".$address_site."reset_password.php");

		        	    	//Останавливаем скрипт
		        	    	exit();
		        	    }else{

		        	    	//Место, где нужно произвести изменения

                             //Генерируем новый пароль. Берем последние 7 символов из хэша.
                             $new_password = substr(md5($email.time()), -7);

                             //Обновляем пароль в БД.
                             $result_query_insert_password = $mysqli->query("UPDATE `users` SET `password` = '".md5($new_password."top_secret")."' WHERE email = '".$email."'");

                             //Составляем заголовок письма
                             $subject = "Восстановление пароля от сайта ".$_SERVER['HTTP_HOST'];

                             //Устанавливаем кодировку заголовка письма и кодируем его
                             $subject = "=?utf-8?B?".base64_encode($subject)."?=";

                             //Составляем тело сообщения
                             $message = 'Здравствуйте! <br/> <br/> Ваш новый пароль от сайта '.$_SERVER['HTTP_HOST'].' : '.$new_password;
                             
                             //Составляем дополнительные заголовки для почтового сервиса mail.ru
                             //Переменная $email_admin, объявлена в файле dbconnect.php
                             $headers = "FROM: $email_admin\r\nReply-to: $email_admin\r\nContent-type: text/html; charset=utf-8\r\n";
                             
                             //Отправляем сообщение с ссылкой для подтверждения регистрации на указанную почту и проверяем отправлена ли она успешно или нет. 
                             if(mail($email, $subject, $message, $headers)){
                                 $_SESSION["success_messages"] = "<p class='success_message' >Новый пароль сгенерирован и отправлен на указанный E-mail ($email) </p>";

                                 //Отправляем пользователя на страницу регистрации и убираем форму регистрации
                                 header("HTTP/1.1 301 Moved Permanently");
                                 header("Location: ".$address_site."reset_password.php?hidden_form=1");
                                 exit();

                             }else{
                                 $_SESSION["error_messages"] = "<p class='mesage_error' >Ошибка при отправки письма с новым паролем, на почту ".$email." </p>";

                                 //Возвращаем пользователя на страницу авторизации
                                 header("HTTP/1.1 301 Moved Permanently");
                                 header("Location: ".$address_site."reset_password.php");

                                 //Останавливаем скрипт
                                 exit();
                             }

                        } // if((int)$row["email_status"] === 0)
		        	} // end of while


		        	

		        }else{ //  if($result_query_select->num_rows == 1)
		            
		            // Сохраняем в сессию сообщение об ошибке. 
		            $_SESSION["error_messages"] = "<p class='mesage_error' ><strong>Ошибка!</strong> Такой пользователь не зарегистрирован</p>";
		            
		            //Возвращаем пользователя на страницу авторизации
		            header("HTTP/1.1 301 Moved Permanently");
		            header("Location: ".$address_site."reset_password.php");

		            //Останавливаем скрипт
		            exit();
		        }
		    } // if(!$result_query_select)

		}//if(isset($_POST["captcha"]))

	}//if(isset($_POST["send"]))

?>