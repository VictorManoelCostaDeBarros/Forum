<?php 
    namespace controladores;

    class forumController
    {
        private $forumModel;

        public function __construct() {
            $this->forumModel = new \modelos\forumModelo();
        }

        public function home() {
            if(isset($_POST['cadastrar_forum'])){
                // Cadastra novo forum.
                $nome = $_POST['titulo_forum'];
                $sql = \MySql::conectar()->prepare("INSERT INTO `tb_foruns` VALUES (null,?)");
                $sql->execute(array($nome));
                echo '<script>alert("Cadastro realizado com sucesso!")</script>';
            }
            $this->forumModel->listarForum();
        }

        public function topicos($idForum) {
            if(isset($_POST['cadastrar_topico'])){
                $nome = $_POST['titulo_topico'];
                $forum_id = $_POST['forum_id'];
                $sql = \MySql::conectar()->prepare("INSERT INTO `tb_forum.topicos` VALUES (null,?,?)");
                $sql->execute(array($forum_id,$nome));
                echo '<script>alert("O topico cadastrado com sucesso!")</script>';    
            }
            $sql = \MySql::conectar()->prepare("SELECT id FROM `tb_foruns` WHERE id = ?");
            $sql->execute(array($idForum));
            if($sql->rowCount() == 1){
                $this->forumModel->listarTopicos($idForum);
            }else{
                echo 'O fórum não existe!';
            }
            
        }

        public function postSingle($arr) {
            if(isset($_POST['cadastrar_post'])){
                $nome = $_POST['nome'];
                $mensagem = $_POST['mensagem'];
                $topico_id = $_POST['topico_id'];
                $sql = \MySql::conectar()->prepare("INSERT INTO `tb_forum.posts` VALUES (null,?,?,?)");
                $sql->execute(array($topico_id,$nome,$mensagem));
                echo '<script>alert("Seu post foi envidao!")</script>';    
            }
            $verifica  = \MySql::conectar()->prepare("SELECT id FROM `tb_forum.topicos` WHERE id = ?");
            $verifica->execute(array($arr[2]));
            if($verifica->rowCount() == 1){
                $this->forumModel->listarPosts($arr);
            }else{
                die('O topico não existe!');
            }
        }
    }
?>