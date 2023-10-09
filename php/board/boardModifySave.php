<?php
    include "../connect/connect.php";
    include "../connect/session.php";  
    
    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $memberID = $_SESSION['memberID'];
   


    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);

    $sql = "";
    $connect -> query($sql);

    


?>