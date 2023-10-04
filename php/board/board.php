<?php

    include "../connect/connect.php";
    include "../connect/session.php";

    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>PHP 블로그 만들기</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body class="gray">
    <?php include "../include/skip.php" ?>
    <!-- skip -->

    <?php include "../include/header.php" ?>   
    <!-- header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img">
                <img srcset="../assets/img/intro02-min.jpg 1x, ../assets/img/intro02@2x-min.jpg 2x,
                ../assets/img/intro02@3x-min.jpg 3x", alt="소개 이미지">
            </div>
            <div class="intro__text">
                웹 디자이너, 웹 퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.<br>
                관련된 문의사항은 여기서 확인하세요!
            </div>
        </div>       
        <section>
        <div class="board__table">
                <table>
                    <colgroup>
                        <col style="width: 5%;">
                        <col style="width: 63%;">                      
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: 7%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>등록자</th>
                            <th>등록일</th>
                            <th>조회수</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#">게시판 제목</a></td>
                            <td>웹쓰</td>
                            <td>2023-10-04</td>
                            <td>100</td>
                        </tr>                       
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <!-- main -->

    <?php include "../include/footer.php" ?>
    <!-- footer -->
</body>
</html>