<?php

class Posts{
    public function ler($idPost=null){
        if(!$idPost){
            include PATH."view/erro404.php";
        }else{
            $mongo = new MongoDB\Client("mongodb://localhost:27017");
            $collection = $mongo->blog->posts;

            $postagem = $collection->find([
                '_id' => new MongoDB\BSON\ObjectID("$idPost"),
            ]);

            $mongo = new MongoDB\Client("mongodb://localhost:27017");
            $collection = $mongo->blog->comentarios;
            $options = ['sort' => ['_id' => -1]];
            $comentarios = $collection->find([
                'idPostagem' => "$idPost",
            ], $options);
            
            foreach ($postagem as $post){
                echo('
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">'.$post['title'].'</h1>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">'.$post['post'].'</li>  
                            
                        </div><br><li class="list-group-item"><h6>Comentarios:</h6>'
                    );

                foreach($comentarios as $comentario){
                    echo('
                        <p>'.$comentario["comment"].'</p>
                    ');   
                }

                echo("
                    </li></ul></div>
                <form class='form comentar' action='".HOME_URL."/main/comentar/".$idPost."' method='post'> 
                    <input type='text' name='comentario' placeholder='Escreva seu comentário' class='escreverComentario'>
                    <button type='submit' class='btn btn-info enviarComentario'>Comentar</button>  
                </form>
            ");
            }
        }
    }
}

?>