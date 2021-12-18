<?
        $usr_mail = $_POST['usr_mail'];
            if(empty($usr_mail)){
                echo "<script>alert('이메일을 입력해 주세요.');history.back();</script>";
                exit;
            }
            $mail_number = mt_rand(100000,999999);//인증번호
            $to = $usr_mail;
            $nameFrom = "wabble admin";
            $from = "c_jungin@naver.com";
            $subject = "WABBLE 고객센터 입니다. 이메일을 인증해 주십시오.";
            $message ="<table>";
            $message.="<tr>";
            $message.= "<td>회원님의 인증번호는  {$mail_number}  입니다.</td>";
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
            /* 수정하지 말것 */
            include_once('../PHPMailer/PHPMailerAutoload.php');
    
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
                $mail->Password = "qmfzjdqpe124578";
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
            echo $mail_number;
            mailer("$nameFrom","$from","$to","$subject","$message" );
        /* */    
?>