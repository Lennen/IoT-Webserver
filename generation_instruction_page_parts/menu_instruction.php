<?php
$findme[0]   = 'Наименование документа';
$findme[1]   = 'Вид документа';
$findme[2]   = 'Должностная инструкция';
$findme[3]   = 'Оглавление';
$findme[4]   = 'Комментарии';
$findme[5]   = 'Текст документа';
$findme[6]   = 'I. Общие положения';
$findme[7]   = 'II. Должностные обязанности';
$findme[8]   = 'III. Права';
$findme[9]   = 'IV. Ответственность';
$findme[10]   = 'Должностная инструкция разработана в соответствии';
$nofind[0] = 'V. Требования по навыкам';
$nofind[1] = 'Техника безопасности';
?>

<?php include '../check_login.php'; ?>
        
    <?php 
        $link=mysqli_connect("localhost", "a0193693_visual_algorithms", "981010aA", "a0193693_visual_algorithms");
        $code_value = $userdata['activation_code'];
        $query = mysqli_query($link, "SELECT * FROM codes WHERE code_value = '$code_value' LIMIT 1");
        $activation_code = mysqli_fetch_assoc($query);
        //echo "<script>console.log('Debug Objects: " . $code_value . "' );</script>";
    ?>

<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <div class="media text-muted p-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
            </svg>
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
            
<div class="dropdown" style="max-height:37px">

    <button onclick="myFunction()" class="dropbtn instructions nav-link">
          <img src="../assets/menu_icons/instructions.svg" style="margin-right:10px; width: 18px"></img>  
        Инструкция</button>
    <div id="myDropdown" class="dropdown-content">
    <a href="#<?=$findme[6];?>"><div class="dolj_instructions nav-link"><?=$findme[6];?></div></a>
    <a href="#<?=$findme[7];?>"><div class="normative_documentation nav-link"><?=$findme[7];?></div></a>
    <a href="#<?=$findme[8];?>"><div class="technic_safety nav-link"><?=$findme[8];?></div></a>
    <a href="#<?=$findme[9];?>"><div class="technic_safety nav-link"><?=$findme[9];?></div></a>
    <a href="#<?=$nofind[0];?>"><div class="technic_safety nav-link"><?=$nofind[0];?></div></a>

  </div>
</div>

            <li class="nav-item">
                <a class="nav-link" href="#<?=$nofind[1];?>" >
                    
                    <span data-feather="pres" class="pres"></span>

                    <table>
                        <tr>
                            <td>
                                <img src="../assets/menu_icons/pres.svg" style="margin-right:10px; width: 18px">
                                </img>
                            </td>
                            <td>
                                <?=$nofind[1];?>
                            </td>
                            <td><img src="../assets/locked.svg" style="margin-left:10px"></img></td>
                        </tr>
                    </table>
                    
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
                <a class="nav-link" href="../">
                    <span data-feather="file-text"></span>
                    <img src="../assets/menu_icons/tarifs.svg" style="margin-right:10px; width: 18px"></img>  
                    GENERVIS
                </a>
            </li>
        </ul>
    </div>
</nav>        


      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
      
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

        <script>
          jQuery($ => {
            const $second = $('.second');

            const now = Date.now();

            const arr = ($.cookie('timer') || `0.${now}`).split('.');

            const [s, time] = arr.map(i => parseInt(i, 10));

            let i = s + Math.floor((now - time) / 1000);

            setInterval(() => {
              $second.text(i++);
              $.cookie('timer', `${i}.${Date.now()}`, {
                expires: 1
              }); // перезаписываем куку
            }, 1000);
          });
        </script>