<? 
    if( ! isset( $filename ) ){ 
        define( "SIZE" , 120 ) ; 
        define( "COLNUM" , 6 ) ; 
        $dir = ($dir)?$dir:"." ; 
?> 
<html> 
<head> 
    <title>Browse <?= $dir ?></title> 
    <style type="text/css"> 
<!-- 
table{ 
    width:100%; 
} 
td{ 
    text-align:center; 
} 
img{ 
    border:none; 
} 
--> 
    </style> 
</head> 
<body> 
<table> 
<? 
        $dd = opendir($dir) ; 

        for( $i = 0 ; $filename = readdir($dd) ; ){ 
            if( is_file("$dir/$filename") ){ 
                if( $imgSize = getImageSize("$dir/$filename") ){ 

                    $w0 = $imgSize[0] ; 
                    $h0 = $imgSize[1] ; 

                    $imgType = $imgSize[2] ; 

                    $ratio = $w0 / $h0 ; 

                    if( $ratio > 1 ){ 
                        $w1 = SIZE ; 
                        $h1 = ( SIZE * $h0 ) / $w0 ; 
                    } 
                    else{ 
                        $w1 = ( SIZE * $w0 ) / $h0 ; 
                        $h1 = SIZE ; 
                    } 

                    $params = sprintf( "filename=$dir/$filename&w0=$w0&h0=$h0&imgType=$imgType&h1=%d&w1=%d" , $h1 , $w1 ) ; 

                    if( ! ( $i % COLNUM ) ){ 
                        echo "\n<tr>\n" ; 
                    } 
?> 
    <td> 
    <a href="<?= "$dir/$filename" ?>"> 
    <img src="<?= $PHP_SELF ?>?<?= $params ?>" style="width:<?= $w1 ?>;height:<?= $h1 ?>;"></a><br> 
    <?= "$filename : $w0 x $h0" ?> 
<? 
                    $i++ ; 
                } 
            } 
        } 
?> 
</table> 
</body> 
</html> 
<? 
        closedir($dd) ; 
    } 
    else{ 
        switch($imgType){ 
            case 1: 
                $imgType = "gif" ; 
            break; 

            case 2: 
                $imgType = "JPEG" ; 
            break; 

            case 3: 
                $imgType = "png" ; 
            break; 

            default: 
            break; 
        } 
        header("Content-type: image/$imgType") ; 

        $tImg = imageCreate( $w1 , $h1 ) ; 

        $imgOpenFunc = "imageCreateFrom".$imgType ; 
        $imgSendFunc = "image".$imgType ; 

        $img = $imgOpenFunc("$filename") ; 

        imageCopyResized( $tImg , $img , 0 , 0 , 0 , 0 , $w1 , $h1 , $w0 , $h0 ) ; 

        imageDestroy($img) ; 

        $imgSendFunc($tImg) ; 
    } 
?> 

