<?php
class Env {
    protected $servername = "X";
    protected $user = "X";
    protected $password = "X";
    protected $database = "X";

    
    public function read_user(){
        $users_sql = "SELECT * FROM user";
        $conn = mysqli_connect($this->servername, $this->user, $this->password, $this->database);
        $result = $conn->query($users_sql);
        
        $i = 0;

        while($users = $result->fetch_assoc()){
            $i++;
            
            $usrs = $users['username'] . '</br>';
            $usr = $users['username'];
            
            $_SESSION["id_"] = $usr;
            //echo '<i class="fa-solid fa-pen-to-square"></i>';
            //echo '<button id="usr_input" name="edit_" onclick="myFunction()" value="'.$usr.'"> '.$usr.'</button>';
            echo '</br>';
            echo '<form action="" method="post"><p id="edit_input_htmledit" style="display: none">Novo nome - <i id="names"></i> <input name="edit_input_htmledit" type="text" required></input><button type="submit" onclick="myFunction3()">Enviar</button><button id="oculta" style="display: none" onclick="ocult()">Ocultar</button></p></form>';
            echo '<button id="usr_input_u" onclick="myFunction()" value="'.$usr.'">Editar</button>';
            echo '<form action="" method="post" style="display: inline"><button id="usr_input_d" value="'.$usr.'" name="usr_input_d" onclick="myFunction()">Deletar</button></form>';

            echo '<i class="i"> '.$usr.'</i>';
        }
    }

    public function create_user(){
        if(isset($_POST['edit_input_htmld']) && ($_POST['edit_input_htmls'])){
            $nome_edit = $_POST['edit_input_htmld'];
            $senha_edit = $_POST['edit_input_htmls'];
            $select_edit = $_POST['edit_input_htmlp'];

            if($_POST['edit_input_htmlp'] === "-"){
                echo '<script>
                alert("Selecione a permissão do usuário!");
                history.back();
                </script>';
            }

            $conn = mysqli_connect($this->servername, $this->user, $this->password, $this->database);
            
            if($conn){

            $hash_password_create = password_hash($senha_edit, PASSWORD_DEFAULT);

            $create_sql = "INSERT INTO user(username, password, perm) VALUES('$nome_edit', '$hash_password_create', '$select_edit')";
        
            $result = $conn->query($create_sql);
            
            echo '<script>alert("Cadastro realizado com sucesso!");</script>';
        }
        $conn->close();       
        header("Location: ./index.php");
        exit;
        }
    echo '<button id="usr_input_c" onclick="myFunction1()">Adicionar usuário <i class="fa-solid fa-plus"></i></button><button id="ocult" style="display: none" onclick="ocultar()">Ocultar</button>';
    echo '</br>';
    echo '<form action="" method="post" style="display: inline"><button type="submit" id="usr_input_cr" onclick="myFunction2()" style="display: none">Adicionar usuário <i class="fa-solid fa-plus"></i></button>';
    echo '<p class="input_buttons" style="display:none">Nome:<input id="edit_input_htmld" name="edit_input_htmld" type="text" style="display:none" required></input></p>';
    echo '<p class="input_buttons" style="display:none">Senha:<input id="edit_input_htmls" name="edit_input_htmls" type="text" style="display:none" required></input></p>';
    echo '<p class="input_buttons" style="display:none">Nível de Permissão:<select id="edit_input_htmlp" name="edit_input_htmlp"style="display: none" required>';
    echo '<option selected> - </option>';
    echo '<option value="0">Administrador</option>';
    echo '<option value="1">Usuário</option>';
    echo '</select></p>';
    echo '</form>';
    }

    public function edit_user(){
        $conn = mysqli_connect($this->servername, $this->user, $this->password, $this->database);
        
        $w = $_SESSION["id_u"];

        $name_sql = "SELECT * FROM user WHERE username='$w'";
        $resulta = $conn->query($name_sql);
        $name_user = $resulta->fetch_assoc();

        $id_sql = "SELECT id FROM user WHERE username='$w'";
        $resultad = $conn->query($id_sql);
        $id_user = $resultad->fetch_assoc();

        if(isset($_POST['edit_input_htmledit'])){
            $update_input = $_POST['edit_input_htmledit'];
            $z = $id_user['id'];

            if($conn){
                $update_sql = "UPDATE user SET username='$update_input' WHERE id='$z'";
                $conn->query($update_sql);
                $conn->close();
                echo '<script>alert("Usuário editado com sucesso!");</script>';
                header("refresh, 0");
                unset($_POST);
            }
            header("Location: ./index.php");
            exit;
        }
    }

    public function delete_user(){
        $conn = mysqli_connect($this->servername, $this->user, $this->password, $this->database);
        if($conn){
            $x = $_SESSION["id_u"];

            $select_sql = "SELECT id FROM user WHERE username='$x'";
            $result = $conn->query($select_sql);
            $select_id_user = $result->fetch_assoc();

            @$y = $select_id_user['id'];

            $delete_sql = $sql = "DELETE FROM user WHERE id='$y'";
            $conn->query($delete_sql);
            $conn->close();
        }
        header("Location: ./index.php");
        exit;
    }
}
?>
