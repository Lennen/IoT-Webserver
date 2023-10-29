<?php

// Функция, которая проверяет, являются ли данные, с которыми мы сейчас работает
// выводимым на экран текстом. Принцип её работы очень прост - в массиве failAt
// записаны те ключевые слова для текущего состояния стека, которые показывают,
// что перед нами что-то другое, а не текст - например, то могут быть описания
// шрифтов или цветовой палитры. И так далее.
function rtf_isPlainText($s) {
    $failAt = array("*", "fonttbl", "colortbl", "datastore", "themedata", "stylesheet", "info", "picw", "pich");
    for ($i = 0; $i < count($failAt); $i++)
        if (!empty($s[$failAt[$i]])) return false;
    return true;
}

# Mac Roman charset for czech layout
function from_macRoman($c) {
	$table = array(
		0x83 => 0x00c9, 0x84 => 0x00d1, 0x87 => 0x00e1, 0x8e => 0x00e9, 0x92 => 0x00ed, 
		0x96 => 0x00f1, 0x97 => 0x00f3, 0x9c => 0x00fa, 0xe7 => 0x00c1, 0xea => 0x00cd, 
		0xee => 0x00d3, 0xf2 => 0x00da
	);
	if (isset($table[$c]))
		$c = "&#x".sprintf("%04x", $table[$c]).";";
	return $c;
}

function rtf2text($filename) {
    // Пытаемся прочить данные из переданного нам rtf-файла, в случае успеха -
    // продолжаем наше злобненькое дело.
    $text = file_get_contents($filename);
    if (!strlen($text))
        return "";

	# Speeding up via cutting binary data from large rtf's.
	if (strlen($text) > 1024 * 1024) {
		$text = preg_replace("#[\r\n]#", "", $text);
		$text = preg_replace("#[0-9a-f]{128,}#is", "", $text);
	}

	# For Unicode escaping
	$text = str_replace("\\'3f", "?", $text);
	$text = str_replace("\\'3F", "?", $text);

    // Итак, самое главное при чтении данных из rtf'а - это текущее состояние
    // стека модификаторов. Начинаем мы, естественно, с пустого стека и отрицательного
    // его (стека) уровня.
    $document = "";
    $stack = array();
    $j = -1;

	$fonts = array();

    // Читаем посимвольно данные...
    for ($i = 0, $len = strlen($text); $i < $len; $i++) {
        $c = $text[$i];

        // исходя из текущего символа выбираем, что мы с данными будем делать.
        switch ($c) {
            // итак, самый важный ключ "обратный слеш"
            case "\\":
                // читаем следующий символ, чтобы понять, что нам делать дальше
                $nc = $text[$i + 1];

                // Если это другой бэкслеш, или неразрывный пробел, или обязательный
                // дефис, то мы вставляем соответствующие данные в выходной поток
                // (здесь и далее, в поток втавляем только в том случае, если перед
                // нами именно текст, а не шрифтовая вставка, к примеру).
                if ($nc == '\\' && rtf_isPlainText($stack[$j])) $document .= '\\';
                elseif ($nc == '~' && rtf_isPlainText($stack[$j])) $document .= ' ';
                elseif ($nc == '_' && rtf_isPlainText($stack[$j])) $document .= '-';
                // Если перед нами символ звёздочки, то заносим информацию о нём в стек.
                elseif ($nc == '*') $stack[$j]["*"] = true;
                // Если же одинарная кавычка, то мы должны прочитать два следующих
                // символа, которые являются hex-ом символа, который мы должны
                // вставить в наш выходной поток.
                elseif ($nc == "'") {
                    $hex = substr($text, $i + 2, 2);
                    if (rtf_isPlainText($stack[$j])) {
						#echo $hex." ";
						#dump($stack[$j], false);
						#dump($fonts, false);
						if (!empty($stack[$j]["mac"]) || @$fonts[$stack[$j]["f"]] == 77)
							$document .= from_macRoman(hexdec($hex));
						elseif (@$stack[$j]["ansicpg"] == "1251" || @$stack[$j]["lang"] == "1029") 
							$document .= chr(hexdec($hex));
						else
							$document .= "&#".hexdec($hex).";";
					}
					#dump($stack[$j], false);
                    // Мы прочитали два лишних символа, должны сдвинуть указатель.
                    $i += 2;
                // Так перед нами буква, а это значит, что за \ идёт упраляющее слово
                // и возможно некоторый циферный параметр, которые мы должны прочитать.
                } elseif ($nc >= 'a' && $nc <= 'z' || $nc >= 'A' && $nc <= 'Z') {
                    $word = "";
                    $param = null;

                    // Начинаем читать символы за бэкслешем.
                    for ($k = $i + 1, $m = 0; $k < strlen($text); $k++, $m++) {
                        $nc = $text[$k];
                        // Если текущий символ буква и до этого не было никаких цифр,
                        // то мы всё ещё читаем управляющее слово, если же были цифры,
                        // то по документации мы должны остановиться - ключевое слово
                        // так или иначе закончилось.
                        if ($nc >= 'a' && $nc <= 'z' || $nc >= 'A' && $nc <= 'Z') {
                            if (empty($param))
                                $word .= $nc;
                            else
                                break;
                        // Если перед нами цифра, то начинаем записывать параметр слова.
                        } elseif ($nc >= '0' && $nc <= '9')
                            $param .= $nc;
                        // Минус может быть только перед цифровым параметром, поэтому
                        // проверяем параметр на пустоту или в противном случае
                        // мы вылезли за пределы слова с параметром.
                        elseif ($nc == '-') {
                            if (empty($param))
                                $param .= $nc;
                            else
                                break;
                        // В любом другом случае - конец.
                        } else
                            break;
                    }
                    // Сдвигаем указатель на количество прочитанных нами букв/цифр.
                    $i += $m - 1;

                    // Начинаем разбираться, что же мы такое начитали. Нас интересует
                    // именно управляющее слово.
                    $toText = "";
                    switch (strtolower($word)) {
                        // Если слово "u", то параметр - это десятичное представление
                        // unicode-символа, мы должны добавить его в выход.
                        // Но мы должны учесть, что за символом может стоять его
                        // замена, в случае, если программа просмотрщик не может работать
                        // с Unicode, поэтому при наличии \ucN в стеке, мы должны откусить
                        // "лишние" N символов из исходного потока.
                        case "u":
                            $toText .= html_entity_decode("&#x".sprintf("%04x", $param).";");
                            $ucDelta = !empty($stack[$j]["uc"]) ? @$stack[$j]["uc"] : 1;
							/*for ($k = 1, $m = $i + 2; $k <= $ucDelta && $m < strlen($text); $k++, $m++) {
								$d = $text[$m];
								if ($d == '\\') {
									$dd = $text[$m + 1];
									if ($dd == "'")
										$m += 3;
									elseif($dd == '~' || $dd == '_')
										$m++;
								}
							}
							$i = $m - 2;*/
							#$i += $m - 2;
                            if ($ucDelta > 0)
                                $i += $ucDelta;
                        break;
                        // Обработаем переводы строк, различные типы пробелов, а также символ
                        // табуляции.
                        case "par": case "page": case "column": case "line": case "lbr":
                            $toText .= "\n"; 
                        break;
                        case "emspace": case "enspace": case "qmspace":
                            $toText .= " "; 
                        break;
                        case "tab": $toText .= "\t"; break;
                        // Добавим вместо соответствующих меток текущие дату или время.
                        case "chdate": $toText .= date("m.d.Y"); break;
                        case "chdpl": $toText .= date("l, j F Y"); break;
                        case "chdpa": $toText .= date("D, j M Y"); break;
                        case "chtime": $toText .= date("H:i:s"); break;
                        // Заменим некоторые спецсимволы на их html-аналоги.
                        case "emdash": $toText .= html_entity_decode("&mdash;"); break;
                        case "endash": $toText .= html_entity_decode("&ndash;"); break;
                        case "bullet": $toText .= html_entity_decode("&#149;"); break;
                        case "lquote": $toText .= html_entity_decode("&lsquo;"); break;
                        case "rquote": $toText .= html_entity_decode("&rsquo;"); break;
                        case "ldblquote": $toText .= html_entity_decode("&laquo;"); break;
                        case "rdblquote": $toText .= html_entity_decode("&raquo;"); break;

						# Skipping binary data...
						case "bin":
							$i += $param;
						break;

						case "fcharset":
							$fonts[@$stack[$j]["f"]] = $param;
						break;

                        // Всё остальное добавим в текущий стек управляющих слов. Если у текущего
                        // слова нет параметров, то приравляем параметр true.
                        default:
                            $stack[$j][strtolower($word)] = empty($param) ? true : $param;
                        break;
                    }
                    // Если что-то требуется вывести в выходной поток, то выводим, если это требуется.
                    if (rtf_isPlainText($stack[$j]))
                        $document .= $toText;
                } else $document .= " ";

                $i++;
            break;
            // Перед нами символ { - значит открывается новая подгруппа, поэтому мы должны завести
            // новый уровень стека с переносом значений с предыдущих уровней.
            case "{":
				if ($j == -1)
					$stack[++$j] = array();
				else
					array_push($stack, $stack[$j++]);
            break;
            // Закрывающаяся фигурная скобка, удаляем текущий уровень из стека. Группа закончилась.
            case "}":
                array_pop($stack);
                $j--;
            break;
            // Всякие ненужности отбрасываем.
            case "\0": case "\r": case "\f": case "\b": case "\t": break;
            // Остальное, если требуется, отправляем на выход.
			case "\n":
				$document .= " ";
			break;
            default:
                if (rtf_isPlainText($stack[$j]))
                    $document .= $c;
            break;
        }
    }
    // Возвращаем, что получили.
    return html_entity_decode(iconv("windows-1251", "utf-8", $document), ENT_QUOTES, "UTF-8");
}

$logolink = $_POST['logolink'];

$myimg = './rtfFiles/' . basename($_FILES['uploadfile']['name']); //Путь до файла
$mylink = basename($_FILES['uploadfile']['name']);  //Только название файла
move_uploaded_file($_FILES['uploadfile']['tmp_name'], $myimg);

$result = rtf2text($myimg);

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

$neuroFreqWords[0] = "Порядок";
$neuroFreqWords[1] = "хотеть";
$neuroFreqWords[2] = "надо";
$neuroFreqWords[3] = "должный";

//$fr[0] = $result.count('Порядок');
//echo($fr[0]);

$res[0][1] = $result;
//$res[1] = explode($findme[0], $res[0][1]); $arr[0] =$res[1][0];
//$res[2] = explode($findme[1], $res[1][1]); $arr[1] =$res[2][0];
//$res[3] = explode($findme[2], $res[2][1]); $arr[2] = $res[3][0];
//$res[4] = explode($findme[3], $res[3][1]); $arr[3] = $res[4][0];
//$res[5] = explode($findme[4], $res[4][1]); $arr[4] = $res[5][0];


for ($i = 0; $i < count($findme); $i++) {
	$res[$i+1] = explode($findme[$i], $res[$i][1]); $arr[$i] = $res[$i+1][0];
}



$pos = stristr($result, $findme);

if ($pos == ''){
	$pos = stristr($result, $findme2);
}
//echo substr($result, $pos+strlen($findme), 30);
//$razdel1 = substr($result, 0, 100);
//$razdel2 = substr($result, 101, 200);
//$razdel3 = substr($result, 201, 300);
//$razdel4 = substr($result, 301, end);

//Алгоритм выделения профессии
$pieces = explode('"', $result);
$specialty = $pieces[1];

//Алгоритм вычленения наиболее повторяющихся слов в документе
$pieces2 = explode(' ', $result);
$wordsFrequency = array_count_values($pieces2);


$page = rand(1000000, 9999999);
$result2 = "
<?php include './check_login.php'; ?>
<?php include '../generation_instruction_page_parts/header_instruction.php'; ?>
<nav class=\"navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow\">
    <a class=\"navbar-brand col-sm-3 col-md-2 mr-0 text-center\" href=\"../\">
        <img src='../$logolink' style=\"height:30px;\" /> 
    </a>

        
<?php include '../generation_instruction_page_parts/head_menu.php'; ?>
<?php include '../generation_instruction_page_parts/menu_instruction.php'; ?>

<?php \$page = \"$page\";?>
<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom' style = 'margin-top:25px'>
	<h1 class='h2'>$arr[1]</h1>
		<div class='btn-toolbar mb-2 mb-md-0'>
            <h4><span class='badge badge-warning text-center'>У Вас ушло <span class='second'></span> сек на изучение инструкций</span></h4>
        </div>
</div>

<b>$findme[0]:</b> $arr[0] <br/> 
<b>$findme[1]:</b> $arr[1] <br/> 
<b>$findme[2]:</b> $arr[2] <br/> 
<b>$findme[3]:</b> $arr[3] <br/> 
<b>$findme[4]:</b> $arr[4] <br/> 
<b>$findme[5]:</b> $arr[5] <br/> 

<h2 class='py-3'><span class='badge badge-pill badge-primary'>1</span> $findme[2]</h2>
    
    <div id='accordion'>
        <p><a name='$findme[6]'></a></p>
        <div class='card mb-2'>
          <div class='card-header' id='headingOne'>
            <h5 class='mb-0'>
            
            <div style = 'display: flex; flex-wrap: wrap; justify-content: space-between;'>
            
              <button class='btn btn-link' data-toggle='collapse' name = 'mainst' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                <svg class='bi bi-unlock-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                  <path d='M.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z' />
                  <path fill-rule='evenodd' d='M8.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z' />
                </svg> 
                <a style='color: #525050' id = 'insertAffiliation' class = 'lk_field'>$findme[6]</a>
              </button>
              <a id = 'edit_affiliation' class = 'edit' align = 'right' style = 'margin-top: auto; font-size:12px'>Ред.</a>
              
              </div>
              
            </h5>
            
          </div>
          

                    <script>
                    editLkField('edit_affiliation', 'insertAffiliation', 'user_affiliation');
                    
                    function editLkField(edit_element, insert_element, db_field_name) {
                        $('#'+edit_element).click(function() {
                            
                            if (document.getElementById(edit_element).innerHTML == 'Ред.') {
                                var cur_val = document.getElementById(insert_element).innerHTML;
                                document.getElementById(insert_element).innerHTML = `<input type = 'text' value = '`+cur_val+`'>`;
                                document.getElementById(edit_element).innerHTML = 'Сохранить';
                            } else {
                                var user_property = document.getElementById(insert_element).firstChild.value; 
                                document.getElementById(insert_element).innerHTML = user_property;
                                document.getElementById(edit_element).innerHTML = 'Ред.';
                                var callback = '';
                              
                                if(user_property != ''){
                                    
                                    $.ajax({
                                        type: 'POST',
                                        url: '../modify_instruction.php',
                                        data: {user_property: user_property, insert_element: insert_element, page: <?php echo $page; ?>},
                                        dataType: 'json',
                                        success: callback
                                    });
                                    
                                }

                                <?php 

                                ?>
                                
                            }
                            
                        });

                    }
                    </script>
          
          
          

          <div id='collapseOne' class='collapse show' aria-labelledby='headingOne' data-parent='#accordion'>
            <div class='card-body'>

              <table>
                <!--График 2-->
                <caption id='blockChart'>Опыт работы</caption>
                </caption>
                <tr>
                  <td class='bar-container2'></td>
                  <td class='js-chart-legend2'></td>
                </tr>
              </table>

              $arr[6]

            </div>
          </div>
        </div>

		<p><a name='$findme[7]'></a></p>
        <div class='card mb-2'>
          <div class='card-header' id='headingTwo'>
            <h5 class='mb-0'>
              <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapseTwo' aria-expanded='false' aria-controls='collapseTwo'>
                <svg class='bi bi-lock-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                  <rect width='11' height='9' x='2.5' y='7' rx='2' />
                  <path fill-rule='evenodd' d='M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z' />
                </svg> $findme[7]
              </button>
            </h5>
          </div>

          <div id='collapseTwo' class='collapse' aria-labelledby='headingTwo' data-parent='#accordion'>
            <div class='card-body'>
            <table>
                                          <!--График 3-->
                <caption id='blockChart'>Перечень рабочих задач</caption>
                </caption>
                <tr>
                  <td class='bar-container3'></td>
                  <td class='js-chart-legend3'></td>
                </tr>
            </table>
			$arr[7] 
            </div>
          </div>
        </div>	  
		
		<p><a name='$findme[8]'></a></p>
        <div class='card mb-2'>
          <div class='card-header' id='headingThree'>
            <h5 class='mb-0'>
              <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapseThree' aria-expanded='false' aria-controls='collapseThree'>
                <svg class='bi bi-lock-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                  <rect width='11' height='9' x='2.5' y='7' rx='2' />
                  <path fill-rule='evenodd' d='M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z' />
                </svg> $findme[8]
              </button>
            </h5>
          </div>
          <div id='collapseThree' class='collapse' aria-labelledby='headingThree' data-parent='#accordion'>
            <div class='card-body'>
            $arr[8]
            </div>
          </div>
        </div>
		
		<p><a name='$findme[9]'></a></p>
        <div class='card mb-2'>
          <div class='card-header' id='headingFour'>
            <h5 class='mb-0'>
              <button class='btn btn-link collapsed' data-toggle='collapse' name = 'mainst1' data-target='#collapseFour' aria-expanded='false' aria-controls='collapseFour'>
                <svg class='bi bi-lock-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                  <rect width='11' height='9' x='2.5' y='7' rx='2' />
                  <path fill-rule='evenodd' d='M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z' />
                </svg> $findme[9]
              </button>
            </h5>
          </div>
          <div id='collapseFour' class='collapse' aria-labelledby='headingFour' data-parent='#accordion'>
            <div class='card-body'>
            $arr[9]
            </div>
          </div>
        </div>
		
		<div class='card mb-2'>
          <div class='card-header' id='headingFive'>
            <h5 class='mb-0'>
              <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapseFive' aria-expanded='false' aria-controls='collapseFive'>
                <svg class='bi bi-lock-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                  <rect width='11' height='9' x='2.5' y='7' rx='2' />
                  <path fill-rule='evenodd' d='M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z' />
                </svg> $nofind[0]
              </button>
            </h5>
          </div>

          <div id='collapseFive' class='collapse' aria-labelledby='headingFive' data-parent='#accordion'>
            <div class='card-body'>
			
					  <table>
              
                                <!--График 4-->
                <caption id='blockChart'>Необходимые Hard Skills</caption>
                </caption>
                <tr>
                  <td class='bar-container4'></td>
                  <td class='js-chart-legend4'></td>
                </tr>
              </table>
              <table>
                <!--График 5-->
                <caption id='blockChart'>Необходимые Soft Skills</caption>
                </caption>
                <tr>
                  <td class='bar-container5'></td>
                  <td class='js-chart-legend5'></td>
                </tr>
              </table>
			  
			</div>
          </div>
        </div> 
		
    </div>
	
	<p><a name='$nofind[1]'></a></p>
	<h2 class='py-3'><span class='badge badge-pill badge-primary'>2</span> $nofind[1]</h2>
    <div class='alert alert-warning mb-5' role='alert'><b>$findme[10]:</b> $arr[10]</div>

<p><a href='#'>Наверх</a></p>

	
	<form action='https://forms.gle/mutuUTGzxcswY6rX6' target='_blank' >
		<input type='submit' class='btn btn-success btn-lg btn-block' value='Документы прочитаны. Обязательный тест на понимание'>
	</form>
	<br/><br/>
	
	<?php echo file_get_contents('../footer.php', FALSE, NULL); ?>";

// открываем файл, если файл не существует,
//делается попытка создать его
$fp = fopen("./page/page" . $page . ".php", "w");

// записываем в файл текст
fwrite($fp, $result2);


header('Location: dolj_instructions.php?showmodal=1&link=page'. $page . '.php&logolink=' .$logolink)

?>

<html>
    <body>
    </body>
</html>
