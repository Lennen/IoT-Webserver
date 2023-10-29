
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>

<?php 
    include './db_connect.php';
    $code_value = $userdata['activation_code'];
    $query = mysqli_query($link, "SELECT * FROM codes WHERE code_value = '$code_value' LIMIT 1");
    $activation_code = mysqli_fetch_assoc($query);
    //echo "<script>console.log('Debug Objects: " . $code_value . "' );</script>";
?>

<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
            <center>
                <a href = "lk.php">
                    <? if ($userdata['user_avatar']):?>
                    <img class = "profile_photo" src = "users_photos/<?=$userdata['user_avatar']?>" width = "65%" style = "margin-top: 15px"></img>
                    <? else: ?>
                    <img class = "profile_photo" src = "assets/img/nophoto.png" width = "65%" style = "margin-top: 15px"></img>
                    <? endif?>
                </a>
            </center>
        <div class="media text-muted p-3">
            <p></p>
            <br/>
            <!--
            <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                
            </svg>
            -->
                            
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if($userdata['user_login']): ?>
                    <strong class="d-block text-gray-dark"><?php echo $userdata['user_name']; ?> <?php echo $userdata['user_patro']; ?> <?php echo $userdata['user_surname']; ?></strong>
                    Должность: <?php echo $userdata['user_job_title']; ?>
                    <br/>
                    Компания: <?php echo $userdata['user_affiliation']; ?>
                    <br/>
                    Текущий тариф: Базовый, до <?php echo $activation_code['code_expired_date'];?>
                <?php else: ?>
                    <strong class="d-block text-gray-dark">Неопознанный гость</strong>
                <?php endif; ?>
            </p>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="start.php">
                    <span data-feather="home1" class="home1"></span>
                    <img src="https://cdn-icons-png.flaticon.com/512/4209/4209896.png" style="margin-right:10px; margin-left: -3px; width: 25px"></img>
                     Главная
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <span data-feather="home1" class="home1"></span>
                    <img src="assets/menu_icons/main.svg" style="margin-right:10px; width: 18px"></img>
                    Панель управления
                </a>
            </li>
            

<script>    /*Для выпадающего меню*/
        /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
    
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
</script>    
    
<style>
        /* Dropdown Button */
    .dropbtn {
        background-color: rgba(220, 220, 220, 0.4);
        color: #333;
        padding: 0.5rem 1rem;
        padding-left:16px;
        font-size: 14px;
        text-align: left;
        border: none;
        cursor: pointer;
        width:99.99%;
    }
    
    /* Dropdown button on hover & focus */
    .dropbtn:hover, .dropbtn:focus {
        background-color: rgba(12, 175, 58, 0.3);
    }
    
    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }
    
    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: rgba(220, 220, 220, 0.9);
        width: 99.9%;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }
    
    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        padding-left: 10px;
        text-decoration: none;
        display: block;
    }
    
    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: rgba(12, 175, 58, 0.3)}
    
    /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
    .show {display:block;}
    
    .nav-item:hover, .nav-item:focus {
        background-color: rgba(12, 175, 58, 0.3);
    }
</style>
            


            <li class="nav-item">
                <a class="nav-link" href="sensorData.php?login=<?php echo $userdata['user_login']?>&sensor_id=1&val=5000&secret=xxxxxxx">
                    <span data-feather="pres" class="pres"></span>

                    <table>
                        <tr>
                            <td>
                                <img src="assets/menu_icons/pres.svg" style="margin-right:10px; width: 18px">
                                </img>
                            </td>
                            <td>
                            Значения с датчика</td>
                            <td><img src="assets/locked.svg" style="margin-left:10px"></img></td>
                        </tr>
                    </table>
                    
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="lk.php">
                    <span data-feather="lk" class="lk"></span>
                    <img src="assets/menu_icons/settings.svg" style="margin-right:10px; width: 18px"></img>
                    Личный кабинет
                </a>
            </li>
           
        </ul>
            
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Прочее</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        
        <ul class="nav flex-column mb-2">
            
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    <img src="assets/menu_icons/tarifs.svg" style="margin-right:10px; width: 18px"></img>  
                    Тарифы
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    <img src="assets/menu_icons/techpodderjka.svg" style="margin-right:10px; width: 18px"></img>  
                    Техн. поддержка
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?showmodal=1#">
                    <span data-feather="file-text"></span>
                    <img src="assets/menu_icons/spravka.svg" style="margin-right:10px; width: 18px"></img>  
                    Справка
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    <img src="assets/menu_icons/uvedomlenia.svg" style="margin-right:10px; width: 18px"></img>  
                    Уведомления
                </a>
            </li>
        </ul>
    </div>
</nav>