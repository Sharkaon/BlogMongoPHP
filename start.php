<?php
    $class=null;
    $acao=null;
    $parametros=null;
    /* vericar se existe caminho definido */
    if(isset($_GET['path'])){
        $caminho=explode("/",$_GET['path'] );
        $class=$caminho[0];
    
        if(isset($caminho[1])){
            $acao=$caminho[1];
        }
        
        
        if(count($caminho)>2){
            for($i=2;$i<count($caminho);$i++){
                $parametros[]=$caminho[$i];
            }
        }
        
    
    }else{
        $class="Main";
    }

        $class= strtolower($class);
        $class=ucfirst($class);
        
        if(file_exists("./classes/".$class.".php")){
            include "./classes/".$class.".php";
            if(class_exists($class)){
                $class=new $class();
                if($acao){
                    if(!isset($parametros[0])){
                        $class->$acao();
                    }else{
                        if(count($parametros)==1){
                            $class->$acao($parametros[0]);
                        }else if(count($parametros)==2){
                            $class->$acao($parametros[0],$parametros[1]);
                        }else if(count($parametros)==3){
                            $class->$acao($parametros[0],$parametros[1],$parametros[2]);
                        }
                    }
                    
                }else{
                    $class->index();
                }
    
            }else{
                include HOME_DIR."/view/erro404.php";
            }
        }else{
            include HOME_DIR."/view/erro404.php";
        }
        
