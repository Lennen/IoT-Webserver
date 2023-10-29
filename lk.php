<?php 
    $header = include './header.php';
    include './check_login.php';
?>


<?php
    include './db_connect.php';
    if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
        $user_id = $userdata['user_id'];
        $query = mysqli_query($link, "SELECT * FROM user_org WHERE user_id = '$user_id'");
        $user_orgs = [];
        while($row = mysqli_fetch_assoc($query)){
            $user_orgs[] = $row;
        }
        
        $user_orgs_info = [];
        foreach($user_orgs as $value){
            $current_org = $value['org_id'];
            $query = mysqli_query($link, "SELECT * FROM organizations WHERE org_id = '$current_org'");
            $user_orgs_info[] = mysqli_fetch_assoc($query);

        }
    }
?>

<style>
   p.descriptiontext { 
    text-indent: 1.5em; /* Отступ первой строки */
    text-align: justify; /* Выравнивание по ширине */
   }
   .blocks {
       border: 1px solid #0CAF3A; 
       /*box-sizing: border-box;*/
       border-radius: 4px;  
       width: 100%; 
       max-width: 450px; 
       background: #fefefe; 
       padding-top: 10px; 
       margin-top: 10px; 
       padding-left: 0px;
       padding-bottom: 20px;
       margin-bottom: 15px;
       margin-right: 10px;
   }
   .field_name {
       width: 100px;
   }
  </style> 

<?php if ($login_success == 1): ?>                                  <!--Зашел как пользователь-->

<body>
    <script defer>
        (function(i, s, o, g, r, a, m) {
          i['GoogleAnalyticsObject'] = r;
          i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
          }, i[r].l = 1 * new Date();
          a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
          a.async = 1;
          a.src = g;
          m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    
        ga('create', 'UA-4481610-59', 'auto');
        ga('send', 'pageview');
    </script>
    
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-selection/1.2.0/d3-selection.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/britecharts@2.10.0/dist/umd/donut.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/britecharts@2.10.0/dist/umd/legend.min.js" type="text/javascript"></script>

    <?php include './head_menu.php'?>

    <div class="container-fluid">
        <div class="row">
            <?php include './menu.php'?>
            <script> const element = document.querySelector('span.lk').parentNode.classList.add('active');</script>
    
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
            pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Личный кабинет</h1>
              <div class="btn-toolbar mb-2 mb-md-0">
                Сервис генерации одностраничников
              </div>
            </div>
            
            <div style = "display: flex; flex-wrap: wrap; align-items: flex-start; align-content: stretch; margin-right: 10px">
            
            <div class = "blocks">
                <center>
                    <p style="font-size: 16px">Основное</p> 
                </center>
                
                <div class="lk_field_row" style = "margin-left: 10px; margin-top: 15px">
                    <p class = "field_name">Логин:</p>
                    <a href="#" id = "toInsert" class = "lk_field"><?php echo $userdata['user_login']; ?></a><a id = 'edit_login' class = "edit">Ред.</a>
                </div>
                
                <div class="lk_field_row" style = "margin-left: 10px;">
                    <p class = "field_name">Фамилия:</p>
                    <a id = "insertF" href="#" class = "lk_field"><?php  echo $userdata['user_surname']; ?></a><a id = 'edit_F' class = "edit">Ред.</a>
                </div>
                <div class="lk_field_row" style = "margin-left: 10px;">
                    <p class = "field_name">Имя:</p>
                    <a id = "insertI" href="#" class = "lk_field"><?php echo $userdata['user_name']; ?></a><a id = 'edit_I' class = "edit">Ред.</a>
                </div>
                <div class="lk_field_row" style = "margin-left: 10px;">
                    <p class = "field_name">Отчество:</p>
                    <a id = "insertO" href="#" class = "lk_field"><?php echo $userdata['user_patro']; ?></a><a id = 'edit_O' class = "edit">Ред.</a>
                </div>
                
                <div class="lk_field_row" style = "margin-left: 10px;">
                    <p class = "field_name">Email:</p>
                    <a href="#" id = "insertEmail" class = "lk_field"><?php echo $userdata['user_email']; ?></a><a id = 'edit_email' class = "edit">Ред.</a>
                </div>
                
                <div class="lk_field_row" style = "margin-left: 10px;">
                    <p class = "field_name">Должность:</p>
                    <a href="#" id = "insertJobTitle" class = "lk_field"><?php echo $userdata['user_job_title']; ?></a><a id = 'edit_job_title' class = "edit">Ред.</a>
                </div>
                
                <div class="lk_field_row" style = "margin-left: 10px;">
                    <p class = "field_name">Основное место работы:</p>
                    <a href="#" id = "insertAffiliation" class = "lk_field"><?php echo $userdata['user_affiliation']; ?></a><a id = 'edit_affiliation' class = "edit">Ред.</a>
                </div>
            


 
                    
                    <style>
                        .lk_field_row{
                            display: flex; flex-wrap: wrap; flex-direction: row; height: 30px
                        }
                        .lk_field {
                            margin-left: 10px; margin-right: 10px; text-align: center;
                        }

                        .edit:hover {
                            cursor: pointer;
                        }
                        #add_affiliation:hover {
                            cursor: pointer;
                        }
                    </style>
                    
                    <div class="lk_field_row" style = "margin-left: 10px; margin-top: 50px; margin-bottom: 35px">
                        <form action="lk.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="image">
                            <button style = "margin-top:4px" type="submit" class="btn btn-primary">Загрузить фото профиля</button>
                        </form>
                    </div>
                    
            </div>
                    
                    <?php
                    
                        // File functions.php
                        function getRandomFileName($path)
                        {
                          $path = $path ? $path . '/' : '';
                          do {
                              $name = md5(microtime() . rand(0, 9999));
                              $file = $path . $name;
                          } while (file_exists($file));
                        
                          return $name;
                        }
                        
                        // File upload.php
                        // Если в $_FILES существует "image" и она не NULL
                        if (isset($_FILES['image'])) {
                        // Получаем нужные элементы массива "image"
                        $fileTmpName = $_FILES['image']['tmp_name'];
                        $errorCode = $_FILES['image']['error'];
                        // Проверим на ошибки
                        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
                            // Массив с названиями ошибок
                            $errorMessages = [
                              UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                              UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                              UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                              UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                              UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                              UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                              UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
                            ];
                            // Зададим неизвестную ошибку
                            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
                            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
                            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
                            // Выведем название ошибки
                            die($outputMessage);
                        } else {
                            // Создадим ресурс FileInfo
                            $fi = finfo_open(FILEINFO_MIME_TYPE);
                            // Получим MIME-тип
                            $mime = (string) finfo_file($fi, $fileTmpName);
                            // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
                            if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
                        
                            // Результат функции запишем в переменную
                            $image = getimagesize($fileTmpName);
                        
                            // Зададим ограничения для картинок
                            $limitBytes  = 1024 * 1024 * 5;
                            $limitWidth  = 1280;
                            $limitHeight = 768;
                        
                            // Проверим нужные параметры
                            if (filesize($fileTmpName) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');
                            if ($image[1] > $limitHeight)             die('Высота изображения не должна превышать 768 точек.');
                            if ($image[0] > $limitWidth)              die('Ширина изображения не должна превышать 1280 точек.');
                        
                            // Сгенерируем новое имя файла через функцию getRandomFileName()
                            $name = getRandomFileName($fileTmpName);
                        
                            // Сгенерируем расширение файла на основе типа картинки
                            $extension = image_type_to_extension($image[2]);
                        
                            // Сократим .jpeg до .jpg
                            $format = str_replace('jpeg', 'jpg', $extension);
                        
                            // Переместим картинку с новым именем и расширением в папку /upload
                            if (!move_uploaded_file($fileTmpName, __DIR__ . '/users_photos/' . $name . $format)) {
                                die('При записи изображения на диск произошла ошибка.');
                            }
                        
                            $full_name = $name . $format;
                            $full_dir = './users_photos/' . $name . $format;
                            $query = mysqli_query($link, "UPDATE users SET user_avatar='".$full_name."' WHERE user_id='".$user_id."'");
                            $reply = 'Картинка успешно загружена!';
                            
                            echo("<script>
                                document.getElementsByClassName('profile_photo')[0].src = '$full_dir';
                            </script>");
                            //echo("<script>window.location.replace(\"lk.php\");</script>");
                          }
                        };
                        

                    
                    ?>
                    
                    <div class = "blocks">
                        <center>
                            <p style="font-size: 16px;">Организации</p> 
                        </center>
                        
                        <ol id ="bulletAffiliations" class="bullet" style = "width: 85%; padding-left:0px; margin-left:17px">
                            <?php foreach ($user_orgs_info as $current_org_info): ?>
                                <li>
                                    <b><?=$current_org_info['org_name'];?></b>
                                    <img style="width:15px;" align="right" src="./assets/delete_icon.svg" onclick ="remove(this.parentNode)";/>
                                </li>
                            <?php endforeach; ?>
                            
                        </ol>
                        <center><a id = 'add_affiliation' style = 'color: green; font-size: 14px;'>Добавить</a></center>    
                        
        
        <style>
            .bullet {
            margin-left: 0;
            list-style: none;
            counter-reset: li;
            }
            .bullet li {
            position: relative;
            margin-bottom: 1.0em;
            border: 3px solid #CADFCF;
            padding: 0.6em;
            border-radius: 4px;
            background: #FEFEFE;
            color: #231F20;
            font-family: "Trebuchet MS", "Lucida Sans";
            }
            .bullet li:before {
            position: relative;
            top: -0.7em;
            padding-left: 0.4em;
            padding-right: 0.4em;
            font-size: 16px;
            font-weight: bold;
            color: #DCC24B;
            background: #FEFEFE;
            border-radius: 50%;
            counter-increment: li;
            content: counter(li);
            }
        </style>
                    </div>
                </div>
                
                    <div class = "blocks">
                        <center>
                            <p style="font-size: 16px">Лицензия</p> 
                        </center>
                        <div style = "margin-left: 10px; margin-top: 5%">
                                Код активации:
                                <a id = "toInsert" href="#">
                                    <?php if ($userdata['activation_code']): ?> 
                                        <?php echo $userdata['activation_code']; ?>
                                    <?php else: ?> 
                                        У вас нет кода активации. Купите продукт, чтобы генерировать более 15 инструкций.
                                    <?php endif; ?>  
                                </a>
                        </div>
                    </div>
                    
                    <div class = "blocks">
                        <center>
                            <p style="font-size: 16px">Ваш пользовательский ключ API</p> 
                        </center>
                        <div style = "margin-left: 10px; margin-top: 5%">
                                Текущий ключ:
                                <?php
                                    $result = mysqli_query($link, "SELECT user_secret FROM users WHERE user_id = $user_id LIMIT 1");
                                    $res = mysqli_fetch_array($result);
                               
                                    $user_secret = $res['user_secret'];
                                ?>
                                <br/><br/>
                                    <?php if($user_secret): ?>
                                        <center>
                                            <mark id = "changeSecretf" href="#" style = "margin-right:3px;padding: 10px 10px; background: #7bdcc0"><?=$user_secret?></mark>
                                            <button style = "margin-top:-4px" id = "copyText" type="button" class="btn btn-primary" onclick="CopyToClipboard('changeSecretf')">Скопировать</button>
                                            <a style = "margin-left:15px" id = "changeSecret" href="#">Ред.</a>
                                        </center>
                                        
                                    <?php else: ?>

                                        <center><mark id = "changeSecretf" href="#" style = "margin-right:20px;padding: 10px 10px; background: #7bdcc0">Задать</mark><a id = "changeSecret" href="#">Ред.</a></center>
                                    <?php endif; ?>  
                        </div>
                        
                        


<script type="text/javascript" src="js/copyToClipboard.js" ></script>

                    </div>
                
        <?php
            echo("<p style='color:green'><b>".$reply."</p></p>");
        ?>
        
                <?php include 'js/edit_fields.php'; ?>
                <?php include 'js/add_del_orgs.php'; ?>
                <script type="text/javascript" src="js/edit_fields.js"></script>
                <script>
                    editLkField('edit_login', "toInsert", "user_login");
                    editLkField('edit_F', "insertF", "user_surname");
                    editLkField('edit_I', "insertI", "user_name");
                    editLkField('edit_O', "insertO", "user_patro");
                    editLkField('edit_email', "insertEmail", "user_email");
                    editLkField('edit_job_title', "insertJobTitle", "user_job_title");
                    editLkField('edit_affiliation', "insertAffiliation", "user_affiliation");
                    editLkField('changeSecret', "changeSecretf", "user_secret");
                    
                    addAffiliation('add_affiliation', 'bulletAffiliations', 'user');
                </script>
   
        </div>
  </div>    		
</body>

<?php else: ?>                                                      <!--Зашел как гость-->
    <?php header('Location: login.php'); ?>
    exit;
<?php endif; ?>  
          
<?php $footer = include './footer.php';?>
