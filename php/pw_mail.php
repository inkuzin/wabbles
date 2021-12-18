<?
include "../inc/db.inc";

dbconn();
if(!isset($_POST['find_btn'])){
    echo "<script>alert('잘못된 접근 방식입니다.');</script>";
}else{
    $usr_mail = $_POST['usr_mail'];
    if(empty($usr_mail)){
        echo "<script>alert('이메일을 입력해 주세요.');</script>";
        exit;
    }
    if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $usr_mail)){
        echo "<script>alert('정확한 이메일 형식을 적어주세요.');</script>";
        exit;
    }
    $to = $usr_mail;
    $nameFrom = "wabble admin";
    $newPW = "nkab3149@dik";
    $from = "c_jungin@naver.com";
    $subject = "WABBLE 고객센터 입니다. 임시 비밀번호를 확인 하여 주십시오.";
    $message ="<table>";
    $message.="<tr>";
    $message.= "<td>비밀번호는 암호화되어 있으므로, 회원님의 이메일 주소로 임시 비밀번호를 발급해 드립니다.</td>";
    $message.="</tr>";
    $message.="<tr>";
    $message.= "<td>임시 비밀번호로 로그인 후, 반드시 새로운 비밀번호를 설정해 주십시요.</td>";
    $message.="</tr>";
    $message.="<tr>";
    $message.= "<td>임시 비밀번호는  {$newPW}  입니다.</td>";
    $message.="</tr>";
    $message.="<tr>";
    $message.= "<td>Web 사이트로 <a href='http://pager.kr/~c11st19/portfolio/Wabble/'>바로 이동</a> 하기</td>";
    $message.="</tr>";
    $message.="<tr>";
    $message.= "<td>본 메일은 <font color=red>발신 전용</font>이라 수신이 불가능합니다.</td>";
    $message.="</tr>";
    $message.="</table>";

    $mailheaders = "Return-Path: $from\r\n";
    $mailheaders.= "From: $nameFrom <$from>\r\n";
    $mailheaders.= "Content-Type: text/html;charset=utf-8\r\n";
    $mailheaders.= "MIME-Version: 1.0\r\n";

    include_once('../PHPMailer/PHPMailerAutoload.php');
    include '../inc/mail_pw.inc';
    function mailer($fname, $fmail, $to, $subject, $content, $type=2, /*$file="",*/ $cc="", $bcc="")
    {
        if ($type != 1) $content = nl2br($content);
        // type : text=0, html=1, text+html=2
        $mail = new PHPMailer(); // defaults to using php "mail()"
        $mail->IsSMTP();
            //   $mail->SMTPDebug = 2;
        $mail->SMTPSecure = "ssl";
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.naver.com";
        $mail->Port = 465;
        $mail->Username = "c_jungin";
        $mail->Password = $mail_pw;
        $mail->CharSet = 'UTF-8';
        $mail->From = $fmail;
        $mail->FromName = $fname;
        $mail->Subject = $subject;
        $mail->AltBody = ""; // optional, comment out and test
        $mail->msgHTML($content);
        $mail->addAddress($to);
        if ($cc)
                $mail->addCC($cc);
        if ($bcc)
                $mail->addBCC($bcc);
        /*if ($file != "") {
                foreach ($file as $f) {
                    $mail->addAttachment($f['path'], $f['name']);
                }
        }*/
        $mail->send();
    }
    mailer("$nameFrom","$from","$to","$subject","$message" );
    $find_pw = "update `wa_member` set usr_pw=password('{$newPW}'), pw_change='1' where usr_id = '".$usr_mail."'";

    if(!$ps_change = mysqli_query($addconn,$find_pw)){
        echo "<script>alert('query error');</script>".mysqli_error($addconn);
        exit;
    }else{
        echo "<script>alert('임시 비밀번호 전송이 완료 되었습니다.');history.back();</script>";
    }
}
?>