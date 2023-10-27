<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    if(isset ($_GET['blogId'])){
        $blogId = $_GET['blogId'];
    } else {
        Header("Location: blog.php");
    }

    // 조회수 추가
    $updateViewSql = "UPDATE blog SET blogView = blogView + 1 WHERE blogId ={$blogId}";
    $connect -> query($updateViewSql);

    // 블로그 정보 가져오기
    $blogSql = "SELECT * FROM blog WHERE blogId = '$blogId'";
    $blogResult = $connect -> query($blogSql);
    $blogInfo = $blogResult -> fetch_array(MYSQLI_ASSOC);

    //이전글 가져오기
    $prevBlogSql = "SELECT * FROM blog WHERE blogId < '$blogId' ORDER BY blogId DESC LIMIT 1";
    $prevBlogResult = $connect -> query($prevBlogSql);
    $prevBlogInfo = $prevBlogResult -> fetch_array(MYSQLI_ASSOC);

    //다음글 가져오기

    $nextBlogSql = "SELECT * FROM blog WHERE blogId > '$blogId' ORDER BY blogId ASC LIMIT 1";
    $nextBlogResult = $connect -> query($nextBlogSql);
    $nextBlogInfo = $nextBlogResult -> fetch_array(MYSQLI_ASSOC);
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
                <h3>글보기 페이지</h3>
                <p>개발에 필요한 지식을 한눈에!<br>웹 개발과 관련된 최신 정보를 한 눈에 볼 수 있습니다.</p>
            </div>
        </div>
        <div class="blog__layout container">
            <div class="blog__contents">
                <div class="blog__view">
                    <h3><?=$blogInfo['blogTitle']?></h3>
                    <div class="info">
                        <span class="author"><?=$blogInfo['blogAuthor']?></span>
                        <span class="date"><?=date('Y-m-d', $blogInfo['blogRegTime'])?></span>
                    </div>
                </div>
                <div class="contents">
                    <img src="../assets/blog/<?=$blogInfo['blogImgFile']?>" alt="<?=$blogInfo['blogTitle']?>">
                    <?=$blogInfo['blogContents']?>
                </div>

                <section class="blog__index">
                    <h4 class="blind">이전글/다음글 가기</h4>

                    <?php if(!empty($prevBlogInfo)) { ?>
                        <a href="blogView.php?blogId=<?=$prevBlogInfo['blogId'];?>" class="prev">이전글</a>
                        <?=substr($prevBlogInfo['blogTitle'], 0, 20);?>...
                    <?php } else { ?>
                        <span class="prev">이전글이 없습니다.</span>
                    <?php } ?>

                    <?php if(!empty($nextBlogInfo)) { ?>
                        <a href="blogView.php?blogId=<?=$nextBlogInfo['blogId'];?>" class="next">다음글</a>
                        <?=substr($nextBlogInfo['blogTitle'], 0, 20);?>...
                    <?php } else { ?>
                        <span class="next">다음글이 없습니다.</span>
                    <?php } ?>



                </section>

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