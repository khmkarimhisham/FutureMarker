    <?php

    $arr = array();

$myPath = $_POST['myPath'];

    function listFolderFiles($dir){
        $ffs = scandir($dir);
    
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);
    
        // prevent empty ordered elements
        if (count($ffs) < 1)
            return;
        
    
        foreach($ffs as $ff){
            if(is_dir($dir.'/'.$ff)){
                $arr[] = array('F'=>$ff);
                
            }else{
                $arr[] = array('T'=>$ff);
            }
            
        }
        echo json_encode($arr);
    }
 
    listFolderFiles($myPath);
    

  /*
    function listFolderFiles($dir){
        $ffs = scandir($dir);
    
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);
    
        // prevent empty ordered elements
        if (count($ffs) < 1)
            return;
    
        echo '<ol>';
        foreach($ffs as $ff){
            echo '<li>'.$ff;
            
            if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
            echo '</li>';
        }
        echo '</ol>';
    }
    
    listFolderFiles('.');*/
        ?>