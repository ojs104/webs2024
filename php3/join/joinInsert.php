<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div id="wrap">
        <main id="main">
            <div class="logo">
                <a href="#"></a>
            </div>
            <aside class="aside"> 
                <div class="img1"></div>
            </aside>
            <div class="contents container">
                <div class="inner">
                    <h1>회원가입</h1>
                    <form action="joinResult.php" class="join__form" name="joinResult" method="post" onsubmit="return false;">
                        <fieldset>
                            <legend class="blind">회원가입 영역</legend>
                            <div>
                                <label for="youName" class="label">이름   <div class="msg" id="youNameComment"></div></label>
                                <input type="text" id="youName" name="youName" placeholder="이름을 입력해주세요" class="input__box1">
                                <p class="msg" id="youNameComment"></p>
                            </div>
                            <div>
                                <label for="youEmail" class="label">이메일 <div class="msg" id="memberEmailMsg"></div></label>
                                <input type="text" id="youEmail" name="youEmail" placeholder="이메일을 입력해주세요" class="input__box1">
                                <p class="msg" id="memberEmailMsg"></p>
                            </div>
                            <div>
                                <label for="youPass" class="label">비밀번호<div class="msg" id="memberPassMsg"></div></label>
                                <input type="password" id="youPass" name="youPass" placeholder="비밀번호를 입력해주세요" class="input__box1">
                                <p class="msg" id="memberPassMsg"></p>
                            </div>
                            <div>
                                <button type="button" class="btn__style join__duple" onclick="emailChecking();">중복 확인</button>
                            </div> 
                            <div>
                                <button type="submit" class="btn__style join__submit" onclick="joinChecks();">회원가입</button>
                            </div>
                            <div class="alread">
                                <p>이미 계정이 있습니까? <a href="#">로그인하기</a></p>   
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        let isEmailCheck = false;

        function emailChecking() {
            let youName = $("#youName").val();
            let youEmail = $("#youEmail").val();
            let youPass = $("#youPass").val();

            if (youName == null || youName == '') {
                $("#youNameComment").text("** 이름을 입력해주세요!!!");
                $("#youNameComment").removeClass("green").addClass("red");

                return false;
            } else {
                var nameRegex = /^[가-힣]{3,5}$/;

                if (!nameRegex.test(youName)) {
                    $("#youNameComment").text("이름은 한글 3~5글자로 입력하세요.");
                    $("#youNameComment").removeClass("green").addClass("red");

                    $("#youName").val('');
                    $("#youName").focus();
                    return false;
                } else {
                    $("#youNameComment").text("사용 가능한 이름입니다.");
                    $("#youNameComment").removeClass("red").addClass("green");

                }
            }

            if (!youEmail) {
                $("#memberEmailMsg").text("** 이메일을 입력해주세요!!!");
                $("#memberEmailMsg").removeClass("green").addClass("red");
                return false;
            }

            let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (!emailRegex.test(youEmail)) {
                $("#memberEmailMsg").text("올바른 이메일 형식이 아닙니다.");
                $("#memberEmailMsg").removeClass("green").addClass("red");
                return false;
            }

            if (youPass == null || youPass == '') {
                $("#memberPassMsg").text("** 비밀번호를 입력해주세요");
                $("#youPass").focus();
                return false;
            } else {
                let getYouPass = youPass;
                let getYouPassNum = getYouPass.search(/[0-9]/g);
                let getYouPassEng = getYouPass.search(/[a-z]/ig);
                let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

                if (getYouPass.length < 8 || getYouPass.length > 20) {
                    $("#memberPassMsg").text("➟ 8자리 ~ 20자리 이내로 입력해주세요");
                    return false;
                } else if (getYouPass.search(/\s/) != -1) {
                    $("#memberPassMsg").text("➟ 비밀번호는 공백없이 입력해주세요!");
                    return false;
                } else if (getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0) {
                    $("#memberPassMsg").text("➟ 영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
                    return false;
                }
            }

            $.ajax({
                type: "POST",
                url: "joinCheck.php",
                data: { "youEmail": youEmail, "type": "isEmailCheck" },
                dataType: "json",
                success: function (data) {
                    if (data.result == "good") {
                        $(".join__submit").show();
                        $(".join__duple").hide();
                        $("#memberEmailMsg").text("사용 가능한 이메일입니다.");
                        $("#memberEmailMsg").removeClass("red").addClass("green");
                        isEmailCheck = true;

                    } else {
                        $("#memberEmailMsg").text("이미 존재하는 이메일입니다.");
                        $("#memberEmailMsg").removeClass("green").addClass("red");
                        isEmailCheck = false;
                    }
                }
            });
        }

        function joinChecks() {
            let youName = $("#youName").val();
            let youEmail = $("#youEmail").val();
            let youPass = $("#youPass").val();

            if (youName && youEmail && youPass && isEmailCheck) {
                document.joinResult.submit();
            } else {
                alert("필수 정보를 작성하고 이메일 중복 확인을 수행하세요.");
            }
        }
    </script>
</body>
</html>