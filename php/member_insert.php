<?
    include "../inc/db.inc";

    dbconn();
    $insert_keys = array(
        'results' => '회원가입이 완료되었습니다.',
        'location_err' => '잘못된 접근 방식입니다.',
        'accept_err' => '필수 항목에 대한 동의가 필요합니다.',
        'mail_err' => '정확한 이메일 형식을 적어주세요.',
        'info_err' => '모든 정보를 입력해주시기 바랍니다',
        'name_err' => '이름은 한글만 입력가능합니다.',
        'pw_err'=> '비밀번호는 영어 대소문자와 숫자, 특수문자를 조합하여 사용하십시오.',
        'jb_err'=> '이미 가입된 회원입니다.'
    );
    $usr_name = $_POST['usr_name'];
    $usr_pw = $_POST['usr_pw'];
    $usr_mail = $_POST['usr_mail'];
    $servie_c = $_POST['service_check'];
    $infor_c = $_POST['infor_check'];
    $full_phone = $first_p.$usr_number;
    if(!isset($_POST['members'])){
        return $insert_keys['location_err'];
        exit;
    }else{
        if(!isset($servie_c)||!isset($infor_c)){
            return $insert_keys['accept_err'];
        }
        if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $usr_mail)){
            return $insert_keys['mail_err'];
            exit;
        }
            if(empty($usr_mail)||empty($usr_name)||empty($usr_pw)){
                return $insert_keys['info_err'];
                exit;
            }
            if(preg_match("/[0-9a-zA-Z]/",$usr_name)==true){
                return $insert_keys['name_err'];
                exit;
            }
            if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $usr_pw)==false){
                return $insert_keys['pw_err'];
                exit;
            }

            //$full_phone = preg_replace("/[^0-9]/", "", $full_phone);
            $member_err = "SELECT * FROM `wa_member`";
            if(!$error_res = mysqli_query($addconn, $member_err)){
                return mysqli_error($addconn);
                exit;
            }
            while($error_row = mysqli_fetch_assoc($error_res)){
                /*$db_code = $error_row['member_code'];
                $coded = substr($mem_code, 12);
                $secode = substr($db_code, 12);*/
                if($usr_mail == $error_row['mb_id'] && $usr_name == $error_row['mb_name']){
                    return $insert_keys['jb_err'];
                    exit;
                }
            }
            mysqli_free_result($error_res);
            if(isset($_POST['event_check'])){
            $member_e_insert = "insert into `wa_member` value('','".$usr_mail."',password('{$usr_pw}'),'".$usr_name."','".$usr_mail."','')";
            if(!$e_insert_res = mysqli_query($addconn,$member_e_insert)){
                return mysqli_error($addconn);
                exit;
            }else{
                return $insert_keys['results'];
            }
            }else{
            $member_insert = "insert into `wa_member` value('','".$usr_mail."',password('{$usr_pw}'),'".$usr_name."','".$usr_mail."','')";
            if(!$insert_res = mysqli_query($addconn,$member_insert)){
                return mysqli_error($addconn);
                exit;
            }else{
                return $insert_keys['results'];
            }
        }
    }
?>