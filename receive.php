<?php
    session_start();
    if(isset($_POST['data'])) {
        $dados_js = $_POST['data'];
        $_SESSION['id_u'] = $dados_js;
        
    }
?>
