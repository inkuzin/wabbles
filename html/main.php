<?
    include "../inc/db.inc";
    dbconn();
    session_start();
    if(!isset($_SESSION['email'])){
        echo "<script>alert('로그아웃 되었습니다.');location.href='../index.php';</script>";
    }
    #echo $_COOKIE['c_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;900&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">

    <title>Wabble</title>
</head>
<body>
    <header>
        <nav class="menubar_area">
            <div id="go_main"></div>
            <p class="movie_recommend">영화 탐색</p>
            <p class="movie_community">커뮤니티</p>
            <p class="movie_event">이벤트</p>
        </nav>
        <div class="right_zone">
            <div class="search_area">
                <i class="xi-search" id="search_icon"></i>
                <div class="hide_input" contenteditable="true" placeholder="검색"></div>
                <!--<input type="text" placeholder="검색" class="input_box">-->
            </div>
            <div class="infor_area">
                <p id="my_text">MY</p>
                <ul class="my_infor">
                    <li>프로필 편집</li>
                    <li>내 글 알림</li>
                    <li>리뷰 수정</li>
                    <li>설정</li>
                    <li id="log_out">로그아웃</li>
                </ul>
            </div>
            <i id="my_infor_i" class="xi-caret-down-min"></i>
        </div>
    </header>

    <script src="../js/main.js"></script>
</body>
</html>