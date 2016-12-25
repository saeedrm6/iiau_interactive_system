<?php
function redirect_to($new_location){
    header("Location: ".$new_location);
    exit;
}

defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_USER') ? null : define("DB_USER", "root");
defined('DB_PASS') ? null : define("DB_PASS", "");
defined('DB_NAME') ? null : define("DB_NAME", "iiau");

global $db; global$magic_quotes_active; global $real_escape_string_exists;
$magic_quotes_active = get_magic_quotes_gpc();
$real_escape_string_exists = function_exists("mysqli_real_escape_string");

function open_connection(){
    global $db;
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $db->set_charset("utf8");
    header("Content-Type: text/html;charset=UTF-8");
    if (mysqli_connect_errno()){
        die("Database connection failed: ".
            mysqli_connect_error()." ( ". mysqli_connect_errno() ." )"
        );
    }
}   // شروع کانکشن

function close_connection(){
    global $db;
    if (isset($db)){
        mysqli_close($db);
        unset($db);
    }
}   // قطع کانکشن

function query($sql){
    global $db;
    $result = mysqli_query($db,$sql);
    confirm_query($result);
    return $result;
}    // اجرای کوئری

function confirm_query($result){
    if (!$result){
        $output="Database query failed ";
        echo mysqli_connect_error() . "<br><br>";
        die($output);
    }
}   //  بررسی کوئری

function mysqli_prep($value){
    $magic_quotes_active = get_magic_quotes_gpc();
    $new_enough_php = function_exists("mysqli_real_escape_string");
    if ($new_enough_php){
        if ($magic_quotes_active){
            $value = stripslashes($value);
        }
        $value = mysqli_real_escape_string($value);
    }else{
        if (!$magic_quotes_active){
            $value = addcslashes($value);
        }
    }
    return $value;
}    //آماده کردن کوئری

function fetch_array($result_set){
    return mysqli_fetch_assoc($result_set);
}   // بازگشت کوئری

function num_rows($result_set){
    return mysqli_num_rows($result_set);
}   // تعداد ردیف ها

function insert_id(){
    global $db;
    return mysqli_insert_id($db);
}    // آخرین آی دی

function affected_rows(){
    global $db;
    return mysqli_affected_rows($db);
}    // تغییرات؟

function escape_value($value) {
    global $real_escape_string_exists;
    global $db;
    global $magic_quotes_active;
    if ($real_escape_string_exists) { // PHP v4.3.0 or higher
        // undo any magic quote effects so mysql_real_escape_string can do the work
        if ($magic_quotes_active) {
            $value = stripslashes($value);
        }
        $value = mysqli_real_escape_string($db, $value);
    } else { // before PHP v4.3.0
        // if magic quotes aren't already on then add slashes manually
        if (!$magic_quotes_active) {
            $value = addslashes($value);
        }
        // if magic quotes are active, then the slashes already exist
    }
    return $value;
}

function password_encrypt($password){
    $hash_format = "$2y$10$";
    $salt_length = 22;
    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format.$salt;
    $hash = crypt($password,$format_and_salt);
    return $hash;
}   // کد کردن پسورد

function generate_salt($length){
    $unique_random_string = md5(uniqid(mt_rand(),true));
    $base64_string = base64_encode($unique_random_string);
    $modified_base64_string = str_replace('+','.',$base64_string);
    $salt = substr($modified_base64_string,0,$length);
    return $salt;
}

function password_check($password,$existing_hash){
    $hash = crypt($password,$existing_hash);
    if ($hash===$existing_hash){
        return true;
    }else{
        return false;
    }
}  // بررسی پسورد

function find_student_by_username($StudentCode){
    global $db;
    (int)$safe_username = mysqli_real_escape_string($db,$StudentCode);
    $query = "SELECT * ";
    $query .="FROM students ";
    $query .= "WHERE StudentCode={$safe_username} ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($db,$query);
    confirm_query($admin_set);
    if ($admin = mysqli_fetch_assoc($admin_set)){
        return $admin;
    }else{
        return null;
    }
}

function attempt_login($username,$password){
    $admin = find_student_by_username($username);
    if ($admin){
        //found admin now check the password
        if (password_check($password,$admin["password"])){
            //password matches
            return $admin;
        }
    }else{
        //admin not found
        return false;
    }

}

function find_admin_by_username($username){
    global $db;
    (int)$safe_username = mysqli_real_escape_string($db,$username);
    $query = "SELECT * ";
    $query .="FROM admins ";
    $query .= "WHERE AdminCode={$safe_username} ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($db,$query);
    confirm_query($admin_set);
    if ($admin = mysqli_fetch_assoc($admin_set)){
        return $admin;
    }else{
        return null;
    }
}


function attempt_login_admin($username,$password){
    $admin = find_admin_by_username($username);
    if ($admin){
        //found admin now check the password
        if (password_check($password,$admin["password"])){
            //password matches
            return $admin;
        }
    }else{
        //admin not found
        return false;
    }

}


function find_teacher_by_username($username){
    global $db;
    (int)$safe_username = mysqli_real_escape_string($db,$username);
    $query = "SELECT * ";
    $query .="FROM teachers ";
    $query .= "WHERE TeacherCode={$safe_username} ";
    $query .= "LIMIT 1";
    $teacher_set = mysqli_query($db,$query);
    confirm_query($teacher_set);
    if ($teacher = mysqli_fetch_assoc($teacher_set)){
        return $teacher;
    }else{
        return null;
    }
}

function attempt_login_teacher($username,$password){
    $teacher= find_teacher_by_username($username);
    if ($teacher){
        //found admin now check the password
        if (password_check($password,$teacher["password"])){
            //password matches
            return $teacher;
        }
    }else{
        //admin not found
        return false;
    }

}

function logged_in($access) {

    if ($access=='student' && isset($_SESSION['StudentCode'])){
        return true;
    }elseif ($access=='administrator' && isset($_SESSION['AdminCode'])){
        return true;
    }elseif ($access=='teacher' && isset($_SESSION['TeacherCode'])){
        return true;
    }
//    return isset($_SESSION['StudentCode']);
}

function confirm_logged_in($access) {
    if (!logged_in($access)) {
        redirect_to("login.php");
    }
}

function create_student_choice_units($username,$fieldcode){
    global $db;
    $username=(int)$username;
    $fieldcode=(int)$fieldcode;
    $sql = "Create Table IF NOT EXISTS {$username}_{$fieldcode} (id INT(11) NOT NULL PRIMARY KEY, code INT(11), name VARCHAR(40), unit INT(11), description VARCHAR(60), exam_time VARCHAR(15), teacher VARCHAR(60), exam_point INT(2), reexam_point INT(2), eteraz INT(1), eteraz_desc VARCHAR(250) )";
    query($sql);
}   // ساخت جدول انتخاب واحد دانشجو

function select_from_units($username,$term){
    $sql = "SELECT * FROM {$username}_{$term}";
    return query($sql);
}

function check_id_course_not_copy($username,$term,$id){
    $sql = "SELECT id FROM {$username}_{$term} WHERE id={$id} LIMIT 1";
    return query($sql);
}

function select_course($username,$term,$field,$id){
    #select :
    $sql_select = "SELECT * FROM {$field}_{$term} WHERE id={$id}";
    $save_sql_select = query($sql_select);
    $save_sql_select = fetch_array($save_sql_select);

    #create table_studetnt:
    $sql = "Create Table IF NOT EXISTS {$username}_{$term} (id INT(11) NOT NULL PRIMARY KEY, code INT(11), name VARCHAR(40), unit INT(11), description VARCHAR(60), exam_time VARCHAR(15), teacher VARCHAR(60), exam_point INT(2), reexam_point INT(2), eteraz INT(1), eteraz_desc VARCHAR(250),TeacherCode INT(11) )";
    query($sql);


    #save:
    $code_course = $save_sql_select{'code'};
    $sql_save = "INSERT INTO {$username}_{$term} (id,code,name,unit,description,exam_time,teacher,TeacherCode) VALUES ({$save_sql_select['id']},{$save_sql_select{'code'}},'{$save_sql_select['name']}',{$save_sql_select['unit']},'{$save_sql_select['description']}','{$save_sql_select['exam_time']}','{$save_sql_select['teacher']}',{$save_sql_select['TeacherCode']})";
    query($sql_save);

    #table_jozve:
    $sql_jozve_create_general = "CREATE TABLE IF NOT EXISTS {$code_course}_{$term} (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,jalase VARCHAR(30), date TIMESTAMP NULL ,PDF VARCHAR (200),voice VARCHAR (200))";
    query($sql_jozve_create_general);
}

function sabte_eteraz($username,$term,$id,$eteraz_desc){
    $sql = "UPDATE {$username}_{$term} SET eteraz_desc ='{$eteraz_desc}', eteraz=1 WHERE id={$id}";
    return query($sql);
}

function esme_darsha($username,$term){
    $sql = "SELECT * FROM {$username}_{$term}";
    return query($sql);
}

function select_jozve($code,$term){
    #select :
//    $sql = "SELECT * FROM {$username}_{$term} WHERE code={$code} LIMIT 1";
    $sql = "SELECT * FROM {$code}_{$term}";
    return query($sql);
}

function get_course_name($field_code,$local_term,$code){
    $sql = "SELECT name FROM {$field_code}_{$local_term} WHERE code={$code} LIMIT 1";
    return query($sql);
}

function admins_list(){
    $sql = "SELECT * FROM admins";
    return query($sql);
}

function add_admin($sex,$fname,$lname,$fother,$admincode,$password){
    $sql = "INSERT INTO `admins` (`sex`, `Fname`, `Lname`, `fother`, `AdminCode`, `password`) VALUES ({$sex}, '{$fname}', '{$lname}', '{$fother}', {$admincode}, '{$password}')";
    return query($sql);
}

function add_teacher($sex,$fname,$lname,$fother,$teachercode,$field,$level,$password,$fieldcode){
    $sql = "INSERT INTO `teachers` (`sex`, `Fname`, `Lname`, `fother`, `TeacherCode`, `field`, `level`, `password`, `fieldcode`) VALUES ({$sex}, '{$fname}', '{$lname}', '{$fother}', '{$teachercode}', '{$field}', '{$level}', '{$password}', '{$fieldcode}')";
    return query($sql);
}

function teachers_list(){
    $sql = "SELECT * FROM teachers";
    return query($sql);
}

function add_student($sex,$fname,$lname,$fother,$studentcode,$field,$level,$password,$fieldcode){
    $sql = "INSERT INTO `students` (`sex`, `Fname`, `Lname`, `fother`, `StudentCode`, `field`, `level`, `password`, `fieldcode`) VALUES ({$sex}, '{$fname}', '{$lname}', '{$fother}', '{$studentcode}', '{$field}', '{$level}', '{$password}', '{$fieldcode}')";
    return query($sql);
}

function student_list(){
    $sql = "SELECT * FROM students";
    return query($sql);
}

function time_stamp(){
    date_default_timezone_set('Asia/Tehran');
    $dt = time();
    $mysql_datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);
    return $mysql_datetime;
}

function general_message($message,$time){
    $sql = "INSERT INTO `general_message` (`message`, `time`) VALUES ('{$message}', '{$time}')";
    query($sql);
}

function add_fieldcode($code,$name){
    $sql="INSERT INTO `fieldcode` (`code`, `name`) VALUES ({$code}, '{$name}')";
    query($sql);
}

function fieldcode_list(){
    $sql="SELECT * FROM `fieldcode`";
    return query($sql);
}

function teacher_courses($fieldcode,$term,$teachercode){
    $sql = "SELECT * FROM `{$fieldcode}_{$term}` WHERE `TeacherCode` = $teachercode";
    return query($sql);
}

function get_term(){
    $sql = "SELECT * FROM `settings`";
    return query($sql);
}

function set_term($term,$term_name){
    $sql = "DELETE FROM `settings`";
    query($sql);
    $sql = "INSERT INTO `settings` (`term`, `term_name`) VALUES ({$term}, '{$term_name}')";
    query($sql);
}

function insert_course($id,$code,$name,$unit,$description,$exam_time,$teacher,$TeacherCode,$idd,$local_term){
    $sql = "Create Table IF NOT EXISTS {$idd}_{$local_term} (id INT(11) NOT NULL PRIMARY KEY, code INT(11), name VARCHAR(40), unit INT(11), description VARCHAR(60), exam_time VARCHAR(15), teacher VARCHAR(60), TeacherCode INT(11))";
    query($sql);
    $sql = "INSERT INTO `{$idd}_{$local_term}` (`id`, `code`, `name`, `unit`, `description`, `exam_time`, `teacher`, `TeacherCode`) VALUES ({$id}, {$code}, '{$name}', {$unit}, '{$description}', '{$exam_time}', '{$teacher}', {$TeacherCode})";
    query($sql);
}

function list_daneshjohaye_ostad($fieldcode,$term,$code,$teachercode){
    $backend_result=array();
    #kole daneshjoo haye reshte field ostad:
    $sql = "SELECT * FROM `students` WHERE `fieldcode`={$fieldcode}";
    $result_students=query($sql);
    while ($rst = fetch_array($result_students)){
//        $sql2="SELECT * FROM {$rst['StudentCode']}_{$term} WHERE code={$code} AND TeacherCode={$teachercode}";
        $sql2="SELECT * FROM `930247933_95961` WHERE `code`=810026 AND `TeacherCode`=45375";
        $backend_result = query($sql2);
//        info_student($rst['StudentCode'],$backend_result);
//        echo $rst['StudentCode'];
    }

}

function info_student($studentcode,$backend){
    $sql = "SELECT * FROM `students` WHERE `StudentCode`={$studentcode}";
    return array(query($sql),$backend);
}

function create_jozve($code_course,$term){
    $sql_jozve_create_general = "CREATE TABLE IF NOT EXISTS {$code_course}_{$term} (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,jalase VARCHAR(30), date TIMESTAMP NULL ,PDF VARCHAR (200),voice VARCHAR (200))";
    query($sql_jozve_create_general);
    $time=time_stamp();
    $sql = "";
}