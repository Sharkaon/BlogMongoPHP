<?php

class Main{
    public function index(){
        $this::exibir();
    }

    public function exibir(){
        include PATH."/view/home.php";
        $mongo = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $mongo->blog->posts;
        $options = ['sort' => ['_id' => -1]];
        
        $postagens = $collection->find([], $options);
        
        $collection = $mongo->blog->comentarios;
        $options = ['sort' => ['_id' => -1], 'limit' => 3];

        foreach ($postagens as $post) {
            $idPost=$post["_id"];
            $comentarios = $collection->find([
                'idPostagem' => "$idPost",
            ], $options);

            echo(                    
                "<div class='card post'>
                    <div class='card-header'>
                        <h5 id=".$post['_id']." class='card-title'><a href=".HOME_URL."/Posts/ler/".$post['_id'].">".$post['title']."</a></h5>
                    </div>
                    <div class='card-body'>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item'><h5 class='card-text'>".substr($post['post'],0,50)."...</h5></li>"
            );

            if($comentarios){
                $i=0;
                foreach($comentarios as $comentario){
                    if($i==0){
                        echo("<li class='list-group-item'><h6 class='card-text'>Comentarios mais recentes:</h6>");
                    }
                    $i++;
                    echo(
                                    "<li class='list-group-item'><p class='card-text'>".$comentario['comment']."</p></li>"
                    );
                }
                echo(         "</li>"
                );
                
            }

            echo(        
                
                        "</ul>
                        <form class='form comentar' action='".HOME_URL."/main/comentar/".$post['_id']."' method='post'> 
                            <input type='text' name='comentario' placeholder='Escreva seu comentário' class='escreverComentario'>
                            <button type='submit' class='btn btn-info enviarComentario'>Comentar</button>  
                        </form>
                    </div>
                </div>"
            );
            
        }
    }

    public function criar(){
        require_once PATH."/view/form.php";
    }

    public function postar(){
         
        $mongo = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $mongo->blog->posts;

        $postagem=$_POST["postagem"];
        $titulo=$_POST["titulo"];

        $insertOneResult = $collection->insertOne([
            'post' => "$postagem",
            'title' => "$titulo",
        ]);
        header('location:'.HOME_URL);
    }

    public function comentar($idPost=null){
        if(!$idPost){
            include PATH."/view/erro404.php";
        }
        $comentario=$_POST['comentario'];
        $mongo = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $mongo->blog->comentarios;
        if($comentario!=""){
            $insertOneResult = $collection->insertOne([
                'comment' => "$comentario",
                'idPostagem' => "$idPost",
            ]);
        }
        header('location:'.HOME_URL);
    }
}

?>