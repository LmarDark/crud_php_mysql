<?php session_start(); ?>
<?php include "env.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ce3d26db3b.js" crossorigin="anonymous"></script>
    <title>Área Restrita</title>
</head>
<body>
    <h1>Editar Usuários</h1>

    <?php
        $class = new Env();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $class->edit_user();
            
            if(isset($_POST['usr_input_d'])){
                $class->delete_user();
                unset($_POST['usr_input_d']);
            }
        }
    ?>

    <?php 
        $class->create_user();
        $class->read_user();
    ?>

</body>
<script>

    function myFunction1() {
        $('#ocult').css('display', 'inline');
        $('#edit_input_htmld').css('display', 'block');
        $('#edit_input_htmls').css('display', 'block');
        $('#edit_input_htmlp').css('display', 'block');
        $('.input_buttons').css('display', 'block');
        $('#usr_input_cr').css('display', 'inline');
        $('#usr_input_c').css('display', 'none');
        $('button#usr_input_u').css('display', 'none');
        $('button#usr_input_d').css('display', 'none');
        $('.i').css('display', 'none');
    }

    function myFunction2(){
        $('#usr_input_c').css('display', 'none');

    }

    function ocultar(){
        $('#ocult').css('display', 'none');
        $('#edit_input_htmld').css('display', 'none');
        $('#edit_input_htmls').css('display', 'none');
        $('#edit_input_htmlp').css('display', 'none');
        $('.input_buttons').css('display', 'none');
        $('#usr_input_c').css('display', 'inline')
        $('#usr_input_cr').css('display', 'none')
        $('button#usr_input_u').css('display', 'inline');
        $('button#usr_input_u').css('display', 'inline');
        $('button#usr_input_d').css('display', 'inline');
        $('.i').css('display', 'inline');
    }

    function ocult(){
        $('#edit_input_htmledit').css('display', 'none');

        $('button#usr_input_u').css('display', 'inline');
        $('button#usr_input_d').css('display', 'inline');
        $('.i').css('display', 'inline');
    }

    function myFunction() {
        usuario = event.target.value;
        console.log(usuario);

        document.querySelector("i#names").innerHTML = usuario;

        $('button#usr_input_u').css('display', 'none');
        $('button#usr_input_d').css('display', 'none');
        $('.i').css('display', 'none');

        $('#edit_input_htmledit').css('display', 'block');
        $('#oculta').css('display', 'inline');
        
        $.ajax({
            url: 'receive.php',
            type: 'POST',
            data: {'data': usuario},
            success: function(result){
                console.log(result);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            // Retorno caso algum erro ocorra
            }
        });
    }
    
</script>
</html>
