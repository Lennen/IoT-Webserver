<?php if (count($files) > 0) : ?>
    
    <a href = "dolj_instructions.php" style = "text-decoration: none; color: #060606;">	    
        <div class = "currentFile" style = "border: 3px solid #fff; margin-right:30px; margin-bottom: 30px">
            <div class = instructionelem>
                <div class = "circle"></div>
                <div class="plus alt"></div>
                <div class = "instructionelemtitle">Создать новый документ</div>
            </div>
        </div>
    </a>
        
                 
        
    <?php $cnt = 1; foreach ($files as $key=>$file) : ?>
    	<?php if ($cnt == 1) : ?>
    		<div style = "border: 4px solid #DAA520; width:187px; height: 193px; border-radius: 4px; margin-right:30px; margin-bottom: 30px">
    	<?php endif ?>
    	<?php if ($cnt != 1) : ?>
    		<div class = "currentFile" style = "border: 3px solid #fff; margin-right:30px; margin-bottom: 30px">
    	<?php endif ?>
    			
    		<div class = instructionelem align="center">
        		<div class="instructionpreview">
        			 <iframe src="page/<?=$file?>" id="frame" scrolling=no></iframe>  
        		</div>

    			<div>
    			    №<?=$cnt?>:  
    			    <a target=blank href=./page/<?=$file?>><?=$file?></a>
    			</div>
                <div class = "instructionelemtitle">
                    <p style = "color: #828282; font-size: 12px; font-family: Montserrat">
                        <img src="assets/vector.svg" style="width:28px"></img>
                        <?=date ("F d Y H:i:s.", $key)?>
                    </p>
                </div>
            </div>
    			    
    	</div>
    	
    	<?php 
    	    $cnt++; 
    		if($cnt>4) {
    		    break;
    		}
    	?>
    			    
    <?php endforeach ?>
<?php endif; ?>
    	                
<a href = "dolj_instructions.php" style = "margin-left: 10px; margin-top: 10px; width: 170px; color: #828282;">
    <table><tr>
        <td><img src="assets/arrow.svg" style = "margin-right:10px"></img></td>
    	<td>Перейти в раздел "Инструкции"</td>
    </tr></table>
</a>
