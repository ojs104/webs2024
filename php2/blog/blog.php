<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    $blogSql = "SELECT * FROM blog WHERE blogDelete = 1 ORDER BY blogId DESC";
    $blogInfo = $connect -> query($blogSql);
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
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner blogStyle bmStyle container">
            <div class="intro__img main">
                <img srcset="../assets/img/intro02.jpg 1x, ../assets/img/intro02@2x.jpg 2x, ../assets/img/intro02@3x.jpg 3x"  alt="소개 이미지">
            </div>
            <div class="intro__text">
                <h3>최신 정보</h3>
                <p>개발에 필요한 지식을 한눈에!<br>웹 개발과 관련된 최신 정보를 한 눈에 볼 수 있습니다.</p>
            </div>
        </div>

        <div class="blog__layout container">
            <div class="blog__contents">
                <section class="blog__card card__wrap">
                    <div class="card__inner column3">

<?php foreach($blogInfo as $blog){ ?>
    <div class="card">
        <figure class="card__img">
            <a href="blogView.php?blogId=<?=$blog['blogId']?>">
                <img src="../assets/blog/<?=$blog['blogImgFile']?>" alt="<?=$blog['blogTitle']?>">
            </a>
        </figure>
        <div class="card__text">
            <h3>
                <a href="blogView.php?blogId=<?=$blog['blogId']?>">
                    <?=$blog['blogTitle']?>
                </a>
            </h3>
            <p>
                <?=substr($blog['blogContents'], 0, 100)?>
            </p>
        </div>
    </div>
<?php } ?>

                    </div>
                </section>
                <section class="blog__pages">blog__pages</section>
                <section class="blog__index">blog__index</section>
                <section class="blog__relate">blog__relate</section>
                <section class="blog__view">blog__view</section>
                <section class="blog__write">blog__write</section>
            </div>
            <div class="blog__aside">
                    <?php include "blogAd.php" ?>
                        <!-- //blog__ad -->

                    <?php include "blogIntro.php" ?>
                    <!-- //blogIntro -->

                    <?php include "blogCategory.php" ?>
                    <!-- //blogCategory -->

                    <?php include "blogPopular.php" ?>
                    <!-- //blogPopular -->
                    
                    <?php include "blogComment.php" ?>
                    <!-- //blogComment -->
            </div>
        </div>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>