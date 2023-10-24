<?php

include "../connect/connect.php"; 
include "../connect/session.php";

$youName = mysqli_real_escape_string($connect, $_POST['youName']);
$youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
$youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
$youRegTime = time();

$sql = "INSERT INTO sexyMembers ( youName, youEmail, youPass, youRegTime) VALUES ('$youName', '$youEmail', '$youPass', '$youRegTime')";
if (mysqli_query($connect, $sql)) {
} else {
    echo "SQL 오류: " . mysqli_error($connect);

}

// 데이터베이스 연결 닫기
mysqli_close($connect);
?>

<!DOCTYPE html>
 <html lang="ko">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/style.css">
    <title>프로필 입력하기</title>
 </head>
 <body>
    <div id="wrap">
        <main id="main">
            <div class="logo">
                <a href="#"></a>
            </div>
            <div class="profil__inner container">
                <div class="photo__wrap">
                    <h3>환영합니다! 당신의 프로필 정보를 입력해주세요</h3>
                    <h2>프로필 사진</h2>
                    <div class="photo"></div>
                    <button class="btn__style4" type="button">이미지 선택</button>
                    
                    <form action="main.php" name="#main" method="post">
                        <fieldset>
                            <legend class="blind">회원가입 영역</legend>
                            
                            <!-- <div class="locate__wrap">
                                <label for="locate" class="label required">주소</label>
                                <div class="check">
                                    <input type="text" id="locate" name="locate" placeholder="지역을 적어주세요" class="input__box3">
                                    <button class="btn" id="addressCheck">주소 찾기</button>
                                    <label for="locate2" class="required blind">주소</label>
                                    <input type="text" id="locate2" name="locate2" placeholder="주소" class="input__style">
                                </div>
                                <p class="msg" id="youAddressComment"></p>
                            </div> -->

                            <div class="join">
                                <label for="youAddress1" class="label required">주소</label>
                                <div class="check">
                                    <input type="text" id="youAddress1" name="youAddress1" placeholder="주소를 적어주세요" class="input__box3">
                                    <button class="btn" id="addressCheck" type="button">주소 찾기</button>
                                </div>
                                
                                <p class="msg" id="youAddressComment"></p>
                            </div>


                        </fieldset>
                        <div class="profil__btn">
                            <button type="button" class="btn__style3"><a href="#">완료</a></button>
                        </div> 
                    </form>
                </div>
        
            </div>
        </main>
        <footer id="footer1">
            <div class="img2"></div>
        </footer>
    </div>

    <div id='layer'>
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" alt="닫기 버튼">
    </div>

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        // 우편번호 찾기 화면을 넣을 element
        const layer = document.querySelector("#layer");
        const searchIcon = document.querySelector("#addressCheck");
        const layerCloseBtn = document.querySelector("#btnCloseLayer");

        searchIcon.addEventListener('click', searchBtnClick);
        layerCloseBtn.addEventListener('click', closeDaumPostcode);

        function closeDaumPostcode() {
            // iframe을 넣은 element를 안보이게 한다.
            layer.style.display = 'none';
        }

        const themeObj = {
            //bgColor: "", //바탕 배경색
            searchBgColor: "#0B65C8", //검색창 배경색
            //contentBgColor: "", //본문 배경색(검색결과,결과없음,첫화면,검색서제스트)
            //pageBgColor: "", //페이지 배경색
            //textColor: "", //기본 글자색
            queryTextColor: "#FFFFFF" //검색창 글자색
            //postcodeTextColor: "", //우편번호 글자색
            //emphTextColor: "", //강조 글자색
            //outlineColor: "", //테두리
        };

        function searchBtnClick() {
            new daum.Postcode({
                theme: themeObj,
                oncomplete: function (data) {
                    // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    let addr = ''; // 주소 변수
                    let extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    document.querySelector('#youAddress1').value = addr; // 우편번호

                    // iframe을 넣은 element를 안보이게 한다.
                    // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                    layer.style.display = 'none';
                },
                width: '100%',
                height: '100%',
                maxSuggestItems: 5
            }).embed(layer);

            // iframe을 넣은 element를 보이게 한다.
            layer.style.display = 'block';

            // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
            initLayerPosition();
        }

        // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
        // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
        // 직접 layer의 top,left값을 수정해 주시면 됩니다.
        function initLayerPosition() {
            const width = 500; //우편번호서비스가 들어갈 element의 width
            const height = 500; //우편번호서비스가 들어갈 element의 height
            const borderWidth = 5; //샘플에서 사용하는 border의 두께

            // 위에서 선언한 값들을 실제 element에 넣는다.
            layer.style.width = width + 'px';
            layer.style.height = height + 'px';
            layer.style.border = borderWidth + 'px solid';
            // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
            layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width) / 2 - borderWidth) + 'px';
            layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height) / 2 - borderWidth) + 'px';
        }
    </script>
 </body>
 </html>