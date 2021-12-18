$(document).ready(function(){
    let class_display = "";
    let dom_display = "";
    let view_flag = "";

    let view_animation=(id , class_name)=>{
        view_flag = $(""+class_name+"").css("display");
        if(view_flag == "none"){
            $(""+id+"").css("border", "2px solid white").css("background-color","black").animate({
                width : "200px",
                padding : "5px"
            }, 500, function(){
                $(""+class_name+"").css("display", "inline-block");
            });
        } else {
            $(""+class_name+"").css("display", "none");
            $(""+id+"").css("border", "none").css("background-color","#282828").animate({
                width : "19.2px",
                padding : "0"
            }, 500);
        }
    }

    class view_mode{
        constructor(selecter){
            this.selecter = selecter;
        }

        none_block(){
            dom_display = $(""+this.selecter+"").css("display");
            dom_display == "none" ? $(""+this.selecter+"").css("display", "block") : $(""+this.selecter+"").css("display", "none");
        }
    }

    $(this).on("click", (e)=>{
        switch(e.target.id){
            case 'my_text':
                class_display = new view_mode(".my_infor");
                class_display.none_block();
                break;
            case 'my_infor_i':
                class_display = new view_mode(".my_infor");
                class_display.none_block();
                break;
            case 'search_icon':
                view_animation(".search_area", ".hide_input");
                break;
            case 'log_out':
                location.href= "../php/log_out.php";
                break;
        }
    });
    /*
    $(this).on("mouseout", (e)=>{
        switch(e.target.id){
            case 'my_text':
                class_display = new view_mode(".my_infor");
                class_display.none_block();
                break;
        }
    });*/
});