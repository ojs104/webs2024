<?php
    include "../connect/connect.php";
    include "../connect/session.php";


    $youId = mysqli_real_escape_string($connect, $_POST['youId']);
    $youName = mysqli_real_escape_string($connect, $_POST['youName']);
    $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
    $youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
    $youAddress1 = mysqli_real_escape_string($connect, $_POST['youAddress1']);
    $youAddress2 = mysqli_real_escape_string($connect, $_POST['youAddress2']);
    $youAddress3 = mysqli_real_escape_string($connect, $_POST['youAddress3']);
    $youPhone = mysqli_real_escape_string($connect, $_POST['youPhone']);
    $youRegTime = time();

    $sql = "INSERT INTO myMembers(youId, youName, youEmail, youPass, youAddress, youPhone, youRegTime) VALUES ('$youId', '$youName', '$youEmail', '$youPass', '$youAddress1 $youAddress2 $youAddress3', '$youPhone', '$youRegTime')";
    $connect -> query($sql);

    //데이터 베이스 연결 닫기
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>
    <style>
        body {
            margin: 0;
        }

        .particle-container {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .particle {
            position: absolute;
            background-color: #FC4F4F;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            animation: move 10s linear infinite;
        }

        @keyframes move {
            0% {
                transform: translate(0, 0);
                opacity: 1;
            }
            80% {
                transform: translate(100vw, 100vh);
                opacity: 0.3; /* 더 느리게 페이드 아웃 */
            }
            100% {
                transform: translate(100vw, 100vh);
                opacity: 0;
            }
        }

        .pumping {
            animation: pulse 0.5s ease infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }

        
    </style>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="gray"> 
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">콘텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>

    <?php include "../include/header.php" ?>
     <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img">
                <img srcset="../assets/img/intro01.jpg 1x, ../assets/img/intro01@2x.jpg 2x, ../assets/img/intro01@3x.jpg 3x"  alt="소개 이미지">
            </div>
            <div class="intro__text">
            어떤 일이라도 노력하고 즐기면 그 결과는 빛을 바란다고 생각합니다. 신입의 열정과 도전정신을 깊숙히 새기며 배움에 있어 겸손함을 유지하며 세부적인 곳까지 파고드는 개발자가 되겠습니다.
            </div>
        </div>
        <section class="join__inner container">           
                <h2>회원가입 완료</h2>
                <div class="join__index">
                    <ul>
                        <li>1</li>
                        <li>2</li>
                        <li class="active">3</li>
                    </ul>
                </div>
                <div class="join__result">                    
                        회원가입을 축하드립니다. 환영합니다.<br> 
                        로그인을 해주세요!
                        <span class="pumping">추카추카</span> 
                        <img src="../assets/img/" alt="">            
                </div>  
                <button class="glow-on-hover" type="button">로그인</button>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //foter -->


    <script>

           // JavaScript for particle animation
        const colors = ['#FC4F4F', '#FFBC80', '#FF9F45', '#F76E11'];
        const container = document.querySelector('main');

        const randomIntBetween = (min, max) => {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }

        class Particle {
            constructor({ x, y, color }) {
                this.x = x;
                this.y = y;
                this.color = color;
                this.element = document.createElement('div');
                this.element.className = 'particle';
                this.element.style.backgroundColor = this.color;
                this.element.style.left = `${this.x}px`;
                this.element.style.top = `${this.y}px`;
                container.appendChild(this.element);
            }

            animate() {
                const timer = setTimeout(() => {
                    container.removeChild(this.element);
                    clearTimeout(timer);
                }, 10000); // 2 seconds
            }
        }

        function animateParticles({ total }) {
            for (let i = 0; i < total; i++) {
                const particle = new Particle({
                    x: randomIntBetween(0, window.innerWidth),
                    y: randomIntBetween(0, window.innerHeight),
                    color: colors[randomIntBetween(0, colors.length - 1)],
                });
                particle.animate();
            }
        }

        // Trigger particle animation on page load
        animateParticles({ total: 40 });
    </script>
</body>
</html>