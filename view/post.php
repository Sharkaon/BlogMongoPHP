<?php
foreach ($postagem as $post){
    echo('
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">'.$post['title'].'</h1>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">'.$post['post'].'</li>  
                </ul>
            </div>
        </div>
        ');
}
?>  
