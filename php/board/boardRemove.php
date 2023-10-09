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
    include "../connect/sessionCheck.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    $boardID = $_GET['boardID'];
    $memberID = $_SESSION['memberID'];

    //  if (isset($_SESSION['memberID'])) {    //로그인 확인
    //     //게시글 소유자 확인
    //     $sql = "SELECT memberID FROM board WHERE boardID = {$boardID}";
    //     $result = $connect -> query($sql);

    //     if($result){
    //         $info = $result -> fetch_array(MYSQLI_ASSOC);
    //         $boardOwenerID = $info['memberID'];
            

    //         //로그인 memberID 게시글 memberID 일치여부
    //         if(memberID == boardOwenerID){
    //             $sql = "DELETE FROM board WHERE boardID = {$boardID}";
    //             $connect->query($sql);
    //             echo "<script>alert('게시글이 삭제 되었습니다.');</script>";
    //         } else {
    //             echo "<script>alert('게시글 소유자만 삭제 할 수 있습니다.');</script>";
    //         } 
    //     } else {
    //         echo "<script>alert('관리자에게 문의 해주세요!');</script>";
    //     }
    //  }else {
    //     echo "<script>alert('로그인을 해주세요');</script>";
    // }

    if(isset($_SESSION['memberID'])){   //로그인 확인
        // 게시글 소유자 확인
        $sql = "SELECT memberID FROM board WHERE boardID = {$boardID}";
        $result = $connect -> query($sql);

        if($result){
            $info = $result -> fetch_array(MYSQLI_ASSOC);
            $boardOwnerID = $info['memberID'];

            // 로그인 memberID 게시글 memberID 일치 여부
            if($memberID == $boardOwnerID){
                $sql = "DELETE FROM board WHERE boardID = {$boardID}";
                $connect -> query($sql);
                echo "<script>alert('게시글이 삭제되었습니다.');</script>";
            } else {
                echo "<script>alert('게시글 소유자만 삭제 할 수 있습니다.');</script>";
            }
        } else {
            echo "<script>alert('관리자에게 문의해주세요!');</script>";
        }
    } else {
        echo "<script>alert('로그인을 해주세요!');</script>";
    }


    
           
      
        
    
    



    //로그인 한 사람만 지우기
    // if (isset($_SESSION['memberID'])) {
    //     $sql = "DELETE FROM board WHERE boardID = {$boardID}";
    //     $connect->query($sql);
    // } else {
    //     echo "<script>alert('지울 수 있는 권한이 없습니다. 로그인해주세요!');</script>";
    // }


    // //게시글의 ID 가져오기
    // $boardID = $_GET['boardID'];


    // //게시글 작성자의 ID 가져오기
    // $sql = "DELETE FROM board WHERE boardID = {$boardID}";
    // $connect->query($sql);
    


?>

<script>
    location.href = "board.php";
</script>
</body>
</html>