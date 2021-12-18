<?
include "./inc/db.inc";
dbconn();
session_start();
if(isset($_COOKIE['c_id'])){
    echo "<script>location.href='./html/main.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;900&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <!--css 스타일시트-->
    <link rel="stylesheet" href="./css/index.css">
    <!--slick cdn-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <title>Wabble</title>
</head>
<body>
    <div class="background_wrap">
        <div class="background_img1"></div>
        <div class="background_img2"></div>
        <div class="background_img3"></div>
    </div>
    <div class="bg"></div>
    <div class="wrap">
        <header class="header_area">
            <div id="go_intro"></div>
            <div class="btn_box">
                <button id="sign_in_btn">LOGIN</button>
            </div>
        </header>
        <div class="text_wrap">
            <div class="title_area">
                <h1>영화추천과 토론을 한번에 즐기세요</h1>
            </div>
            <div class="sub_title_area">
                <p>뭘 좀 아는 영화인들의 커뮤니티 WABBLE</p>
            </div>
        </div>
    </div>
    <footer>
        <div class="slide_nav1"></div>
        <div class="slide_nav2"></div>
        <div class="slide_nav3"></div>
    </footer>
    <script src="./js/index.js"></script>
</body>
</html>
