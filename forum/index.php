<?php 
    include('config.php');

    $forumController = new \controladores\forumController();

    // listagem dos foruns
    Router::get('/',function() use ($forumController){
        $forumController->home();
    });

    // listagem dos topicos
    Router::get('/?',function($arr) use ($forumController){
        $forumController->topicos($arr[1]);
    });

    // Topicos/post Single
    Router::get('/?/?',function($arr) use ($forumController){
        $forumController->postSingle($arr);
    });

    if(Router::isExecuted() == false){
        die('Não existe!');
    }
?>