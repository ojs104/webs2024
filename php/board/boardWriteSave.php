<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $boardView = 1;
    $regTime = time();
    $memberID = $_SESSION['memberID'];

    // echo $boardTitle, $boardContents, $memberID;

    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);

    $sql = "INSERT INTO board(memberID, boardTitle, boardView, regTime) VALUES('$memberID','$boardTitle', 'boardContents', 'boardView', 'regTime')";

    $connect -> query($sql);
?>