<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 블로그 만들기</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="gray"> 
    <div id="skip">
    <a href="#header">헤더 영역 바로가기</a>
    <a href="#main">콘텐츠 영역 바로가기</a>
    <a href="#footer">푸터 영역 바로가기</a>
</div>    <!-- //skip -->

    <header id="header" role="banner">
    <div class="header__inner container">
        <div class="left">
            <a href="../index.html">
                <span class="blind">메인으로</span>
            </a>
        </div>
        <div class="logo">
            <a href="../main/main.php">Developer Blog</a>
        </div>
        <div class="right">
                            <ul>
                    <li><a href="../join/join.php">회원가입</a></li>
                </ul>
                    </div>
    </div>
    <nav class="nav__inner">
        <ul>
            <li><a href="../join/join.php">회원가입</a></li>
            <li><a href="../login/login.php">로그인</a></li>
            <li><a href="../board/borad.php">게시판</a></li>
            <li><a href="../blog/blog.php">블로그</a></li>
        </ul>
    </nav>
</header>    <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img small">
                <img srcset="../assets/img/intro04-min.jpg 1x, ../assets/img/intro04@2x-min.jpg 2x,
                ../assets/img/intro04@3x-min.jpg 3x"  alt="소개 이미지">
            </div>
            <div class="intro__text">
                <h2>게시글 작성하기</h2>
                <p>
                    웹디자이너, 웹 퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.<br>게시글 작성은 여기서 해주세요!
                </p>
            </div>
        </div>
        <section class="board__inner container">
            <div class="board__write">
                <form action="boardWriteSave.php" name="boardWriteSave" method="post">
                    <fieldset>
                        <legend class="blind">게시글 작성하기</legend>
                        <div>
                            <label for="boradTitle">제목</label>
                            <input type="text" id="boradTitle" name="boradTitle" class="input__style">
                        </div>
                        <div>
                            <label for="boardContents">내용</label>
                            <textarea id="boardContents" name="boardContents" rows="20" class="input__style"></textarea>
                        </div>
                        <div class="board__btns">
                            <button type="submit" class="btn__style3">저장하기</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </section>
    </main>
    <!-- //main -->

    <footer id="footer" role="contentinfo">
    <div class="footer__inner container btStyle">
        <div>Copyright 2023 webstoryboy</div>
        <div>blog by webs</div>
    </div>
</footer>    <!-- //foter -->
</body>
</html>