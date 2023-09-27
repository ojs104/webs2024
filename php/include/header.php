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
                <?php if(isset($_SESSION['memberID'])){ ?>
                    <ul>
                        <li><a href="#"><?=$_SESSION['youName']?>님 환영합니다.</a></li>
                        <li><a href="../login/logout.php">로그아웃</a></li>
                    </ul>
                <?php } else { ?>
                    <ul>                       
                        <li><a href="../join/join.php">회원가입</a></li>
                    </ul>
                <?php } ?>   
                
            </div>
        </div>
        <nav class="nav__inner">
            <ul>
                <li><a href="../join.php">회원가입</a></li>
                <li><a href="../login.php">로그인</a></li>
                <li><a href="../">게시판</a></li>
                <li><a href="../">블로그</a></li>
            </ul>
        </nav>
    </header>