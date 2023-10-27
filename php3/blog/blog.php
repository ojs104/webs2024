<?php
include "../connect/connect.php";
include "../connect/session.php";

$blogSql = "SELECT * FROM BrainBlog WHERE blogDelete = 1 ORDER BY blogId DESC";
$blogInfo = $connect->query($blogSql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>뇌섹남녀 게시판 만들기</title>

    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/blog/blog.css">
    <link rel="stylesheet" href="../assets/blog/card.css">
    <link rel="stylesheet" href="../assets/css/common.css">
 

    <style>
        #wrap {
            color: #283269;
            font-size: 1rem;
        }
        #header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page__header {
            height: 7rem;
        }
        #header .nav ul {
            display: flex; 
            align-items: left;
        }
        #header .nav ul li {
            padding: 20px;
        }

        #header .nav ul li a {
            display: inline-block;
            margin-left: 2rem;
        }
        #header .nav ul li a:hover {
            color: #9E3436;
        }
        #header .logo2 {
            display: flex; 
        }
        .header__right {
            margin-right: 3rem;
            position: relative;
        }
        .header__right .logout {
            margin-right: 3rem;
            color: #fff;
            background-color: #283269;
            padding: 20px 30px;
            border-radius: 35px;
        }
        .header__right .logout::after {
            content: '';
            position: absolute;
            height: 5px;
            width: 5px;
            background-color: #283269;
            border-radius: 100%;
            top: 50%;
            right: 38%;
            transform: translate(-50%, -50%);
        }
        .header__right .propile {
            color: #C5AAA4;
            padding: 25px 20px;
            border-radius: 50%;
            background-color: #F2E2DE;
            display: inline-block;
        }
        /* profile */
        .profile {
            margin-top: 5rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .profile > div {
            margin-left: 3rem;
        }
        .profile .profile {
            font-size: 30px;
            font-weight: 900;
        }
        .profile .profile {
            font-size: 20px;
            font-weight: 600;
            margin: 20px 0;
        }
        /* nav */
        .profile__nav {
            width: 80%;
            margin: 4rem 0 2rem 0;
        }
        .profile__nav::after {
            content: '';
            border-bottom: 1px solid #283269;
        }

        .profile__nav > ul > li {
            display: inline-block;
            margin-right: 4rem;
            
        }
        .profile__nav > ul > li > a {
            font-size: 20px;
        }
        .profile__nav > ul > li > a:hover {
            color: #9E3436;
        }


    </style>
</head>
<body>
    <div class="wrap">
        <header id="header">
            <nav class="header__nav">
                <ul>
                    <li><a href="#">문제</a></li>
                    <li class="active"><a href="#">커뮤니티</a></li>
                </ul>
            </nav>
            <div class="header__logo">
                <a href="home.html"><img src="assets/img/logo.png" alt="뇌섹남녀" href></a>
            </div>
            <div class="header__right">
                <input type="search" class="search" name="allSearchValue" autocomplete="off" role="combobox" placeholder="검색" aria-live="polite">
                <button><a class="logout" href="#">로그아웃</a></button>
                <a class="profile" href="#">뇌섹</a>
            </div>
        </header>
        <!-- //header -->

        <main id="main" role="main">
            <div class="intro__box">
                <h2>
                    뇌섹남녀 커뮤니티에서<br>
                    다양한 이야기를 나누세요
                </h2>
                <p>공지사항과 질문 외에도 자유롭게 이야기를 나눌 수 있습니다.</p>
                <a href="#">글쓰기</a>
            </div>
            <!-- //intro -->

            <section class="blog__wrap">
                <div class="blog__inner">
                    <div class="card__inner column4">
                        <input type="search" class="search" name="allSearchValue" autocomplete="off" role="combobox" placeholder="검색" aria-live="polite">
                        <div class="card">
                            <figure class="card__img">
                                <a href="#">
                                    <img src="assets/img/images01.jpg" alt="#">
                                </a>
                            </figure>
                            <div class="card__text">
                                <h3>
                                    <p>카테고리</p>
                                    <div>
                                        <p>작성자</p>
                                        <p>조회수</p>
                                    </div>
                                </h3>
                                <h4>
                                    <a href="#">제목</a><p>[댓글수]</p>
                                </h4>
                                <div class="card__desc">게시글 내용</div>
                            </div>
                        </div>
                        <!-- //card01 -->

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

                    <aside class="blog__filter">
                        <div class="filter__head">말머리</div>
                        <div class="filter__type">
                            <div class="type__check">
                                <label for="filter-toggle1" class="checkbox">
                                    <input type="checkbox" id="filter-toggle1">
                                    <span class="on"></span>
                                    <p>전체</p>
                                </label>
                                
                                <label for="filter-toggle3" class="checkbox">
                                    <input type="checkbox" id="filter-toggle3">
                                    <span class="on"></span>
                                    <p>질문</p>
                                </label>
                                <label for="filter-toggle4" class="checkbox">
                                    <input type="checkbox" id="filter-toggle4">
                                    <span class="on"></span>
                                    <p>자유</p>
                                </label>
                            </div>
                            <select id="filter-select" class="hidden-select">
                                <option value="공지">전체</option>
                                <option value="공지">공지</option>
                                <option value="질문">질문</option>
                                <option value="자유">자유</option>
                            </select>
                            <span class="iconArrow"></span>
                        </div>
                        <button class="filter__button">검색</button>
                    </aside>
            <!-- //blog__filter -->



                </section>                
            <div class="blog__pages">
                <ul>
                    <li><a href="#">&lt;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">7</a></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#">9</a></li>
                    <li><a href="#">10</a></li>
                    <li><a href="#">></a></li>
                </ul>
            </div>
            <!-- //blog__pages -->

           
        </section>
        <!-- //blog__wrap -->
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>
