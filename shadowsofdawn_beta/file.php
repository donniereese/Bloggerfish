<?php 
$save = $_GET['save']; 
$file = $_GET['file']; 

if (empty($save)) { 
    $fp = fopen($file , r); 
    $content = fread($fp, filesize($file)); 
    $content = ereg_replace("<", "<", $content); 
    $content = ereg_replace(">", ">", $content); 
    fclose($fp); 
    ?> 
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
    File: <input type="text" name="file" value="<?php echo $file?>" class="border" /><br /> 
    Content:<br /> 
    <textarea NOWRAP rows="15" cols="90" name="content" class="border"><?php echo $content?></textarea><br> 
    <input name="save" type="submit" value="Save" class="button"><input type="reset" value="Clear" class="button"> 
    </form> 
    <?php 
} 

else { 
    $content = ereg_replace("<", "<", $content); 
    $content = ereg_replace(">", ">", $content); 
    $content = stripslashes($content); 
    $fp = fopen($file , 'w'); 
    fwrite($fp, $content); 
    fclose($fp); 
} 
?> 