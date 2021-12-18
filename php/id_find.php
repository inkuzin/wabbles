<?
    include "../inc/db.inc";
    dbconn();

    $usr_name = $_POST['usr_name'];
    $usr_phone = $_POST['usr_phone'];
    $first_phone = $_POST['first_phone'];
    $full_number = $first_phone.$usr_phone;

    $find_id_sql = "select * from `wa_member`";

    if(!$find_result = mysqli_query($addconn, $find_id_sql)){
        echo "<script>console.log('query error');</script>".mysqli_error($addconn);
        exit;
    }
    if(mysqli_num_rows(mysqli_query($addconn,"select * from `wa_member` where usr_name='{$usr_name}' and usr_number='{$full_number}'"))==0){
        echo "<p class=\"example_text\">일치하는 회원이 없습니다.</p>";
        exit;
    }
    while($id_row = mysqli_fetch_assoc($find_result)){
        if($usr_name == $id_row['usr_name'] && $full_number == $id_row['usr_number']){
           echo "<p class=\"example_text\">{$id_row['usr_id']}</p>";
        }
    }
?>