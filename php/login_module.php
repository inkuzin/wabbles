<?
    include "../inc/db.inc";
    dbconn();

    $email = $_POST['email'];
    $usr_pw = $_POST['usr_pw'];
    
    if(!isset($_POST['login_btn'])){
        echo "<script>alert('잘못된 접근 방식입니다.');</script>";
        exit;
    }else{
        if(empty($email)||empty($usr_pw)){
            echo "<script>alert('아이디와 비밀번호를 입력해주세요.');history.back();</script>";
            exit;
        }
        if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
            echo "<script>alert('정확한 이메일 형식을 적어주세요.');history.back();</script>";
            exit;
        }
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $usr_pw)){
            echo "<script>alert('비밀번호는 영어 대소문자와 숫자 \n 특수문자를 조합하여 사용하십시오.');history.back();</script>";
            exit;
        }
        $member_info = "select * from `wa_member`";

        if(!$info_res = mysqli_query($addconn,$member_info)){
            echo "<script>alert('query_error');</script>".mysqli_error($addconn);
            exit;
        }

        $rows = mysqli_num_rows($info_res);
        if($rows == 0){
            echo "No data";
            exit;
        }
        if(mysqli_num_rows(mysqli_query($addconn,"select * from `wa_member` where mb_id='{$email}' and mb_pw=password('{$usr_pw}')"))==0){
            echo "<script>alert('아이디 또는 패스워드가 다릅니다.');/*history.back();*/</script>";
            exit;
        }

        session_start();
        while($row = mysqli_fetch_assoc($info_res)){
            if($row['pw_change']=='1'){
                echo "<script>alert('비밀번호를 변경해주세요.');/*location.href='';*/</script>";
            }
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['mb_name'];
        }
        mysqli_free_result($info_res);
        if(isset($_POST['auto_login'])){
        $auto_login = trim($_POST['auto_login']);
            $auto_query = "select * from `wa_member` where usr_id='$email' and usr_pw=password('{$usr_pw}')";
            $result_s = mysqli_query($addconn,$auto_query);
            if(mysqli_num_rows($result_s)) {
                $db = mysqli_fetch_array($result_s);
             
                if ($auto_login==true) {
                    #echo "<script>alert('자동 로그인이 활성화 되었습니다.');</script>";
                    setcookie("c_id",$email,(time()+3600*24*30),"/"); // 한달간 자동로그인 유지
                }
                if ( isset($_COOKIE['reg']) && $_COOKIE['reg']-time()<86400*30 ) { // 쿠키가 있고, 유효 시간이 한 달 미만이면
                    $exp = time() + 86400*365; // 다시 1년 유효
                    setcookie('reg',$exp,$exp);
                    $id_cookie=setcookie('c_id',$email,$exp);
                }
             
            }
            if(!$result_s){
                return $cokie_arr = array('cookie'=>$id_cookie, 'result_val'=>'25');
            }else{
                return $cokie_arr = array('cookie'=>$id_cookie, 'result_val'=>'00');
            }
        }else{
            return $cokie_arr = array('cookie'=>$id_cookie, 'result_val'=>'00');
        }
        mysqli_close($addconn);
        
    }

?>