$(document).ready(function(){

    let user_email_val = "";
    let user_pw_val = "";
    let user_name_val = "";
    let user_phone_val = "";
    var conpare_number = 0;
    let checked = "false";
    let check_mode = "";
    let disabled_check = "";
    let button_mode = "";
    let array_check = [];

    const reg_email = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
    const reg_pw = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{10,}$/;
    const reg_name =  /^[가-힣]{2,}$/;
    const reg_number =  /^\d{2,3}\d{3,4}\d{4}$/;
    
    function slide_show(){ 
        $('background_wrap').delay(3000); 
        $('.background_wrap').animate({marginLeft: "-1920px"}, 2000);
        $('.background_wrap').delay(3000); 
        $('.background_wrap').animate({marginLeft: "-3840px"}, 2000);
        $('.background_wrap').delay(3000); 
        $('.background_wrap').animate({marginLeft: "0px"}, 2000);
        $('.background_wrap').delay(3000); 
    }

    setInterval(slide_show, 5000);



    /*$(".background_wrap").animate({ marginLeft : "-1920px" }, 2000, function(){
        $(".background_wrap").animate({ marginLeft : "-3840px"}, 2000 ,function(){
            $(".background_wrap").animate({ marginLeft : "0px"}, 2000);
        })
    });*/

    /*$(".title_area").fadeIn(1000, 'swing',function(){
        $(".sub_title_area").fadeIn(500, 'swing', function(){
            $("#sign_in_btn").fadeIn(500, 'swing');
        });
    });*/

    $(".contents_area").fadeIn(1000, 'swing');

    // 비밀번호 정규식 함수
    let match_pw_func=(pw_val)=>{
        user_pw_val = pw_val;
        return reg_pw.test(user_pw_val);
    }

    //이름 정규식 함수
    let match_name_func=(name_val)=>{
        user_name_val = name_val;
        return reg_name.test(user_name_val);
    }

    //핸드폰 번호 정규식 함수
    let match_phone_func=(phone_val)=>{
        user_phone_val = phone_val;
        return reg_number.test(user_phone_val);
    }

    // 로그인 정규식 조건 일치시 input 활성화
    let match_login_func=(email_val, pw_val)=>{        
        (email_val == true) && (pw_val == true) ? $(".common_btn").css("opacity", "1").css("cursor", "pointer") : $(".common_btn").css("opacity", "0.6").css("cursor", "");
        (email_val == true) && (pw_val == true) ? $(".common_btn").removeAttr("disabled") : $(".common_btn").attr("disabled", "true");
    }

    // 회원가입 정규식 조건 일치시 input 활성화
    let match_join_func=(email_val, pw_val, name_val, phone_val)=>{
        (email_val == true) && (pw_val == true) && (name_val == true) && (phone_val == true) ? $(".common_btn").css("opacity", "1").css("cursor", "pointer") : $(".common_btn").css("opacity", "0.6").css("cursor", "");
        (email_val == true) && (pw_val == true) && (name_val == true) && (phone_val == true) ? $(".common_btn").removeAttr("disabled") : $(".common_btn").attr("disabled", "true");
    }

    class active_button {
        constructor(object_val, select_object, change_object){
            this.object_val = object_val;
            this.select_object = select_object;
            this.change_object = change_object;
        }

        match_email(){
            return reg_email.test(this.object_val);
        }

        success_active(mode){
            if(mode == true){
                $("."+this.select_object+"").attr("id", this.change_object)
                .removeClass(this.select_object).attr("disabled", false);
            } else {
                $("#"+this.change_object+"").removeAttr("id")
                .addClass(this.select_object).attr("disabled", true);
            }
        }
    }

    //checkbox 관련 class 
    class checkbox_class {
        constructor(select_object) {
          this.select_object = select_object;
        }
      
        //모든 동의 체크시 하위 checkbox 체크
        all_check_method() {
            checked = $("#"+this.select_object+"").is(':checked');
            checked ? $("input:checkbox").prop("checked", true) : $("input:checkbox").prop("checked", false); //모든 동의 체크시 하위 checkbox 체크

            //모든 동의 체크시 회원가입 버튼 활성화
            if(checked == true){
                button_mode = new active_button( undefined, "disabled_btn2", "go_sign_up");
                button_mode.success_active(true);
            } else {
                button_mode = new active_button( undefined, "go_sign_up", "disabled_btn2");
                button_mode.success_active(false);
            }
        }

        //하위 checkbox 체크 여부 판단, 모든 동의 체크 혹은 미체크 구현
        disabled_check_method(){
            array_check = $("."+this.select_object+" > div > input").get();

            let i=0;
            while(i<array_check.length){
                if(array_check[i].checked == false){
                    $("#all_check").prop("checked", false);
                }
                i++;
            }
            if(array_check[0].checked && array_check[1].checked && array_check[2].checked == true){
                $("#all_check").prop("checked", true);
            }
            if(array_check[0].checked && array_check[1].checked == true){
                button_mode = new active_button( undefined, "disabled_btn2", "go_sign_up");
                button_mode.success_active(true);
            } else {
                button_mode = new active_button( undefined, "go_sign_up", "disabled_btn2");
                button_mode.success_active(false);
            }
        }
    }

    let temp_alert=()=>{
        alert("준비중인 서비스입니다.");
    }

    let check_mail_ajax=()=>{
        $(".check_trigger").val(1);
        $.ajax({
            type : 'POST',
            url : '../php/mail_confirm.php',
            data : {
                usr_mail : $("#join_user_mail").val(),
                mail_btn : $(".check_trigger").val()
            },
            error : function(){
                alert("통신 오류");
            },
            success : function(Parse_data){
                alert("인증 메일이 전송되었습니다.");
                $("#email_text, #compare_btn").css("display", "inline-block");
                conpare_number = Parse_data;
            }
        });
    }

    let check_compare_mail=()=>{
        if($("#email_text").val() == conpare_number){
            $(".confirm_text").css("display", "block").text("* 이메일 인증이 완료되었습니다.");
            $("#email_text, #compare_btn").css("display", "none");
            $(".contents_area").css("margin-top", "60px");
            $("#join_user_pw").css("display", "block");
            $(".join_phone_area").css("display", "flex");
            $(".guide_text").css("display", "block");
        } else {
            $(".confirm_text").css("display", "block").text("* 인증 번호가 일치하지 않습니다.");
        }
    }

    $(this).on("keydown", (e)=>{
        switch(e.target.id){
            case 'join_user_mail':
                button_mode = new active_button($("#"+e.target.id+"").val(), "disabled_btn", "check_mail_btn");
                button_mode.match_email() == true ? button_mode.success_active(true) : button_mode.success_active(false);
                break;
        }
    });

    $(".check_line > div > input").on("click", (e)=>{
        disabled_check = new checkbox_class("check_line");
        disabled_check.disabled_check_method();
    })

    $(this).on("click", (e)=>{
        switch(e.target.id){
            case 'sign_in_btn':
                location.href = './html/sign_in.html';
                break;
            case 'sign_up_btn':
                location.href = 'http://pager.kr/~c11st19/portfolio/Wabble/html/sign_up.html';
                break;
            case 'go_intro':
                location.href = 'http://pager.kr/~c11st19/portfolio/Wabble/'; //임시 intro 주소 수정 예정
                break;
            case 'go_find':
                location.href = '../html/go_find.html';
                break;
            case 'go_kakaotalk':
                temp_alert();
                break;
            case 'go_google':
                temp_alert();
                break;
            case 'go_line':
                temp_alert();
                break;
            case 'go_facebook':
                temp_alert();
                break;
            case 'all_check':
                check_mode = new checkbox_class(e.target.id);
                check_mode.all_check_method();
                break;
            case 'check_mail_btn':
                check_mail_ajax();
                break;
            case 'compare_btn':
                check_compare_mail();
                break;
        }
    });

    $(this).on("click", (e)=>{
        switch(e.target.className){
            case 'pw_forget_text':
                location.href = '../html/find_pw.html';
                break;
            case 'mail_forget_text':
                location.href = '../html/find_email.html';
                break;
        }
    });
});