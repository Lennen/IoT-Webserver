<script>
    function remove(el) {
        var callback = '';
        var element = el;
        var org_name = element.childNodes[1].innerHTML;
        console.log(org_name);
                    $.ajax({
                        type: 'POST',
                        url: 'lk.php',
                        data: {org_name: org_name},
                        dataType: 'json',
                        success: callback
                    });
        
        element.remove();
        
    }
    
    <?php 
        $org_name = stripslashes(trim(htmlspecialchars($_POST['org_name'],ENT_QUOTES)));
        
        if($org_name != ''){
            $query1 = mysqli_query($link, "SELECT org_id FROM organizations WHERE org_name = '".$org_name."'");
            $org_id = mysqli_fetch_row($query1);
            $org_id = $org_id[0];
            $query = mysqli_query($link, "DELETE FROM user_org WHERE org_id = '".$org_id."' AND user_id = '".$user_id."'");
        }
        //echo json_encode($org_name);
    ?>
                    
    function addAffiliation(edit_element, insert_element, db_field_name) {

        $('#'+edit_element).click(function() {
                    
        if (document.getElementById(edit_element).innerHTML == 'Добавить') {
            var cur_val = document.getElementById(insert_element).innerHTML;
            
            <?php
                //Полный список доступных организаций
                $result = mysqli_query($link, "SELECT * FROM organizations");
                while($row = mysqli_fetch_array($result)){
                    $res0[] = $row;
                }
                $json0 = json_encode($res0);
                
                //Список организаций, которые 
                $user_id = $userdata['user_id'];
                $result_existing_orgs = mysqli_query($link, "SELECT org_id FROM user_org WHERE user_id = ".$user_id);
                while($row = mysqli_fetch_array($result_existing_orgs)){
                    $existing_orgs[] = $row;
                }
                $json2 = json_encode($existing_orgs);

            ?>
            

            var organizations_list = '<?php echo($json0);?>';
            organizations_list = JSON.parse(organizations_list);
            console.log(organizations_list);
            
            var organizations_list2 = '<?php echo($json2);?>';
            organizations_list2 = JSON.parse(organizations_list2);
            //console.log("HELLLLL");
            //console.log(organizations_list2[0]);
            
           
           if(organizations_list2){ 
                organizations_list2.forEach((element2, key2) => {
                    organizations_list.forEach((element, key) => {
                        //console.log(element[0]);
                        //console.log(element2['org_id']);
                        if(element[0] == element2['org_id']) {
                            //console.log('got it');
                            organizations_list.splice(key, 1);
                        }
                    });
                });
           }
            console.log('Edited orgs array: ');
            console.log(organizations_list);
            
            var selEl = "<select id='org_select' name='select'>\
                <?php foreach ($res as $value): ?>\
                <?php endforeach; ?>\
                </select>";
            document.getElementById(insert_element).innerHTML = cur_val+`<li id='editNewAffiliation'>`+selEl+`</li>`;
          
            var select = document.getElementById("org_select"); 
            var options = organizations_list; 
            
            for(var i = 0; i < options.length; i++) {
                console.log(options[i]['org_name']);
                console.log('NextOpt');
                var opt = options[i]['org_name'];
                var el = document.createElement("option");
                el.textContent = opt;
                el.value = options[i]['org_id'];
                select.appendChild(el);
            }
            
            document.getElementById(edit_element).innerHTML = 'Сохранить';
            
            
            
        } else {
            var ind = document.getElementById('editNewAffiliation').firstChild.selectedIndex;
            var user_property = document.getElementById('editNewAffiliation').firstChild[ind].text;
            var user_property1 = document.getElementById('editNewAffiliation').firstChild[ind].value;

            document.getElementById('editNewAffiliation').innerHTML = user_property;
            document.getElementById('editNewAffiliation').removeAttribute('id');
            document.getElementById(edit_element).innerHTML = 'Добавить';
            var callback = '';
            
            if(user_property != ''){
                    $.ajax({
                        type: 'POST',
                        url: 'lk.php',
                        data: {user_property1: user_property1, db_field_name1: db_field_name},
                        dataType: 'json',
                        success: callback
                    });
                }

                <?php 
                    //$user_id
                    
                    $user_property1 = stripslashes(trim(htmlspecialchars($_POST['user_property1'],ENT_QUOTES)));
                    $db_field_name = stripslashes(trim(htmlspecialchars($_POST['db_field_name1'],ENT_QUOTES)));
                    if($user_property1 != ''){
                        //$query = mysqli_query($link, "UPDATE user_org SET $db_field_name='".$user_property."' WHERE user_id='".$user_id."'");
                        $query = mysqli_query($link, "INSERT INTO user_org (user_id, org_id) VALUES ('".$user_id."', '".$user_property1."')");
                    echo("done");    
                        
                    }
                ?>
        }
        });
    
    }
    
</script>