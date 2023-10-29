<script>
    function editLkField(edit_element, insert_element, db_field_name) {
        
        $('#'+edit_element).click(function() {
        if (document.getElementById(edit_element).innerHTML == 'Ред.') {
            var cur_val = document.getElementById(insert_element).innerHTML;
            document.getElementById(insert_element).innerHTML = `<input type = 'text' size='25' value = '`+cur_val+`'>`;
            document.getElementById(edit_element).innerHTML = 'Сохранить';
        } else {
            var user_property = document.getElementById(insert_element).firstChild.value; 
            document.getElementById(insert_element).innerHTML = user_property;
            document.getElementById(edit_element).innerHTML = 'Ред.';
            var callback = '';
            
            if(user_property != ''){
                    $.ajax({
                        type: 'POST',
                        url: 'lk.php',
                        data: {user_property: user_property, db_field_name: db_field_name},
                        dataType: 'json',
                        success: callback
                    });
                }

                <?php 
                    //$user_property = $_POST['user_property'];
                    //$db_field_name = $_POST['db_field_name'];
                    $user_property = stripslashes(trim(htmlspecialchars($_POST['user_property'],ENT_QUOTES)));
                    $db_field_name = stripslashes(trim(htmlspecialchars($_POST['db_field_name'],ENT_QUOTES)));
                    if($user_property != ''){
                        $query = mysqli_query($link, "UPDATE users SET $db_field_name='".$user_property."' WHERE user_id='".$user_id."'");
                    }
                ?>
        }
        });
    
        $('#'+insert_element).click(function() {
            if (document.getElementById(edit_element).innerHTML == 'Ред.') {
                var cur_val = document.getElementById(insert_element).innerHTML;
                document.getElementById(insert_element).innerHTML = `<input type = 'text' size='25' value = '`+cur_val+`'>`;
                document.getElementById(edit_element).innerHTML = 'Сохранить';
            }
        });
    }
</script>