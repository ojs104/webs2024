<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // 페이지 번호를 가져옵니다. 페이지 번호가 없으면 1로 설정합니다.
    if(isset($_GET['page'])){   
        $page = (int) $_GET['page'];    //'page' 매개변수를 가져와서 $page 변수에 저장합니다. (int)를 사용하여 가져온 값이 정수로 변환됩니다. 이것은 페이지 번호를 정수로 사용하기 위한 것입니다.
    } else {
        $page = 1;      //: 'page' 매개변수가 URL에 존재하지 않는 경우, $page 변수에 1을 할당합니다. 이는 페이지 번호가 지정되지 않은 경우에 기본 페이지 번호로 1을 사용하도록 하는 부분입니다.
    }
    //이 코드는 페이지 번호를 추출하여 나중에 해당 페이지의 게시물 목록을 표시하는 데 사용됩니다. 페이지 번호가 URL에 포함되면 해당 페이지의 게시물을 표시하고, 페이지 번호가 없으면 첫 번째 페이지의 게시물을 표시합니다.
    
    $searchKeyword = $_GET['searchKeyword'];    //이 부분은 URL에서 'searchKeyword' 매개변수를 가져와서 $searchKeyword 변수에 할당합니다. 이 변수는 사용자가 입력한 검색어 또는 키워드를 저장합니다.
    $searchOption = $_GET['searchOption'];      //이 변수는 사용자가 선택한 검색 옵션(예: 제목, 내용, 작성자 등)을 저장합니다.

    // 검색 키워드와 검색 옵션을 가져오고 정리합니다.
    $searchKeyword = $connect -> real_escape_string(trim($searchKeyword));//trim() 함수는 문자열 양 끝의 공백을 제거합니다. 사용자가 검색어를 입력할 때 공백이 포함되는 것을 방지합니다.
    $searchOption = $connect -> real_escape_string(trim($searchOption));//SQL 쿼리에 사용할 수 있는 안전한 문자열로 변환합니다. 이 함수를 사용하면 SQL 쿼리를 실행할 때 SQL 인젝션 공격을 방지할 수 있습니다.
    
    // SQL 쿼리를 준비합니다. 초기 쿼리는 모든 게시물을 가져옵니다.
    $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) ";
    // $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE b.boardTitle LIKE '%{$searchKeyword}%' ORDER BY boardID DESC";
    // $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE b.boardContents LIKE '%{$searchKeyword}%' ORDER BY boardID DESC";
    // $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE m.youName LIKE '%{$searchKeyword}%' ORDER BY boardID DESC";


    // 검색 옵션에 따라 WHERE 절을 추가하여 검색 쿼리를 완성합니다.
    switch($searchOption){
        case "title":
            $sql .= "WHERE b.boardTitle LIKE '%{$searchKeyword}%' ORDER BY boardID DESC";
            break;
        case "content":
            $sql .= "WHERE b.boardContents LIKE '%{$searchKeyword}%' ORDER BY boardID DESC";
            break;
        case "name":
            $sql .= "WHERE m.youName LIKE '%{$searchKeyword}%' ORDER BY boardID DESC";
            break;
    }

    // 검색된 결과를 가져옵니다.
    $result = $connect -> query($sql);
    // 검색 결과의 총 게시물 수를 구합니다.
    $totalCount = $result -> num_rows;
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
        <div class="intro__inner bmStyle container">
        <div class="intro__img small">
                <img srcset="../assets/img/intro04.jpg 1x, ../assets/img/intro04@2x.jpg 2x, ../assets/img/intro04@3x.jpg 3x"  alt="소개 이미지">
            </div>
            <div class="intro__text">
                <h2>결과 페이지</h2>
                <p>
                    웹디자이너, 웹 퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.<br>
                    총 <em><?=$totalCount?></em>건의 게시물이 검색되었습니다.
                </p>
            </div>
        </div>
        <section class="board__inner container">
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
<?php

    $viewNum = 10; // 페이지당 표시할 게시물 수
    $viewLimit = ($viewNum * $page) - $viewNum; // 페이지에 표시할 게시물 범위

    $sql .= " LIMIT {$viewLimit}, {$viewNum}"; // SQL 쿼리에 LIMIT 구문을 추가하여 페이지에 따른 게시물 범위를 선택합니다.
    $result = $connect -> query($sql); // SQL 쿼리 실행

    if($result){
        $count = $result -> num_rows; // 결과 집합에서 검색된 게시물 수
        if($count > 0){
            // 게시물이 검색된 경우, 각 게시물을 테이블 행으로 출력
            for($i=0; $i<$count; $i++){
                $info = $result -> fetch_array(MYSQLI_ASSOC);

                echo "<tr>";
                echo "<td>".$info['boardID']."</td>";
                echo "<td><a href='boardView.php?boardID={$info['boardID']}'>".$info['boardTitle']."</a></td>";
                echo "<td>".$info['youName']."</td>";
                echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                echo "<td>".$info['boardView']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
        }
    } else {
        echo "관리자에게 문의해주세요!!";
    }
?>

                    </tbody>
   
                </table>
            </div>
            <!-- //board__table -->

            <div class="board__pages">
                <ul>
<?php
    // 총 페이지 갯수 계산
    $boardTotalCount =  ceil($totalCount/$viewNum);

    // 페이지 네비게이션 설정
    // 1 2 3 4 5 6 [7] 8 9 10 11 12 13
    $pageView = 5;      // 현재 페이지 주변에 표시할 페이지 수
    $startPage = $page - $pageView;
    $endPage = $page + $pageView;

    // 시작 페이지 초기화 및 마지막 페이지 초기화
    if($startPage < 1) $startPage = 1;
    if($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

    // 처음으로/이전 링크 출력
    if($page != 1){
        $prevPage = $page -1;
        echo "<li class='first'><a href='boardSearch.php?page=1$searchKeyword={$serchKeyword}&searchOption={$searchOption}'>처음으로</a></li>";
        echo "<li class='prev'><a href='boardSearch.php?page={$prevPage}$searchKeyword={$serchKeyword}&searchOption={$searchOption}'>이전</a></li>";
    }

    // 페이지 번호 출력
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='boardSearch.php?page={$i}$searchKeyword={$serchKeyword}&searchOption={$searchOption}'>${i}</a></li>";
    }

    // 다음 및 마지막 페이지 출력
    if($page != $boardTotalCount){
        $nextPage = $page + 1;
        echo "<li class='next'><a href='boardSearch.php?page={$nextPage}$searchKeyword={$serchKeyword}&searchOption={$searchOption}'>다음</a></li>";
        echo "<li class='last'><a href='boardSearch.php?page={$boardTotalCount}$searchKeyword={$serchKeyword}&searchOption={$searchOption}'>마지막으로</a></li>";
    }
?>      
                </ul>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //foter -->
</body>
</html>