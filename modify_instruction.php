<?php 
    $user_property = stripslashes(trim(htmlspecialchars($_POST['user_property'],ENT_QUOTES)));
    $insert_element = stripslashes(trim(htmlspecialchars($_POST['insert_element'],ENT_QUOTES)));
    $page = stripslashes(trim(htmlspecialchars($_POST['page'],ENT_QUOTES)));
    if($user_property != ''){
        $web = file_get_contents('page/page'.$page.'.php');
        
        $searchfor = $insert_element;
        header('Content-Type: text/plain');
        $contents = $web;
          // позволяет избежать специальных символов в массиве
        $pattern = preg_quote($searchfor, '/');
          // завершение регулярного выражения, совпадающего всему предложению
        $pattern = "/^.*$pattern.*$/m";
          // поиск и добавление в массив $matches всех совпадений 
      if(preg_match_all($pattern, $contents, $matches)){
         echo "Найденные совпадения: ";
         echo implode(" ", $matches[0]);
         }
      else {
         echo "Совпадений не найдено";
           }
      
        $string = $web;
        $pattern = "/(<a style='color: #525050' id = 'insertAffiliation' class = 'lk_field'>).*?(</a>)/";
        $replacement = '${1} 1 ${3}';
        
        $html_string = preg_replace($pattern, $replacement, $string);
        //$html_string = preg_replace( , "sdfsdfsdf" );
        //html_string = html_string.replace( /(<h3 id='title'>).*?(</h3>)/, "$1New Text$2" );
        
        $doho = file_put_contents('chel.txt', $html_string);
        
        
        //$query = mysqli_query($link, "UPDATE users SET $db_field_name='".$user_property."' WHERE user_id='".$user_id."'");
    }
    
?>