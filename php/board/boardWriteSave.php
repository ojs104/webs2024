<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $boardView = 1;
    $regTime = time();
    $memberID = $_SESSION['memberID'];

    // echo $boardTitle, $boardContents, $memberID;

    // 제목이나 콘텐츠 내용이 없으면 등록이 x
    
     // 세션을 통해 사용자가 로그인되어 있는지 확인
     if (!isset($_SESSION['memberID'])) {
        echo "<script>alert('로그인 후에 게시글을 작성할 수 있습니다.');</script>";
        echo "<script>window.history.back()</script>";        
    } else {
        // 데이터 입력 여부
        if (empty($boardTitle) || empty($boardContents)) {
            echo "<script>alert('제목 또는 게시글을 작성해주세요.');</script>";
            echo "<script>window.history.back();</script>";
        } else {
            $boardTitle = $connect -> real_escape_string($boardTitle);
            $boardContents = $connect -> real_escape_string($boardContents);

            $sql = "INSERT INTO board(memberID, boardTitle, boardContents, boardView, regTime) VALUES('$memberID','$boardTitle', '$boardContents', '$boardView', '$regTime')";
            
            if ($connect -> query($sql)) {
                echo "<script>alert('게시글이 성공적으로 작성되었습니다.');</script>";
                echo '<script>window.location.href = "../board/board.php";</script>';
            } else {
                echo "<script>alert('게시글 작성 중 오류가 발생했습니다.');</script>";
                echo '<script>window.history.back();</script>';
            }
        }
    }
?>
</body>
</html>