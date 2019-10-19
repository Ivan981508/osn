<?php


class call
{
    public static function load($type){
        if(admin::check()){
            $db = db::getConnection();// Соединение с БД
            $sql = "SELECT * FROM `call_db` WHERE type='$type' ORDER BY id DESC";

            $result = $db->prepare($sql);// Используется подготовленный запрос
            $result->setFetchMode(PDO::FETCH_ASSOC);// Указываем, что хотим получить данные в виде массива
            
            $result->execute();// Выполнение коменды

            $i = 0;
            $list_call = [];
            while ($row = $result->fetch()) {

                $list_call[$i]['id'] = $row['id'];
                $list_call[$i]['phone'] = $row['phone'];
                $list_call[$i]['data'] = $row['data'];
                $i++;
            }
            if($i == 0) $answer = "none";
            else $answer = $list_call;

            return $answer;
        }
    }
    public static function countCall($type){
        $db = db::getConnection();// Соединение с БД
        $result = $db->prepare('SELECT COUNT(*) FROM `call_db` WHERE type=:type');
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->execute();
        $num_rows = $result->fetchColumn();
        return $num_rows;
    }
    public static function delete($id){
        $db = db::getConnection();// Соединение с БД
        $sql = "DELETE FROM `call_db` WHERE id=:id";
        $result = $db->prepare($sql);// Используется подготовленный запрос
        $result->bindParam(':id', $id);
        $result->setFetchMode(PDO::FETCH_ASSOC);// Указываем, что хотим получить данные в виде массива   
        $result->execute();// Выполнение коменды
    }
    public static function insertCall()
    {
        $db = db::getConnection();

        $unix_time = time();
        $type = $_POST["type"];
        $data = $_POST["data"];
        $phone = $_POST["phone"];
        $ip = $_SERVER["REMOTE_ADDR"];
        $date_call = date("Y-m-d G:i:s",$unix_time);

        $result = $db->prepare('SELECT COUNT(*) FROM `call_db` WHERE ip=:ip AND type=:type');
        $result->bindParam(':ip', $ip, PDO::PARAM_STR);
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->execute();
        $num_rows = $result->fetchColumn();

        if($num_rows > 0) $answer = ["status"=>"fail","type"=>"Вы уже отправляли заявку. Дождитесь звонка!"];
        else {
            if($phone == "") $answer = ["status"=>"fail","type"=>"Напишите ваш номер!"];
            else {

                $result = $db->prepare("INSERT INTO `call_db`(`phone`, `ip`, `type`, `data`, `date`) VALUES (:phone,:ip,:type,:data,'$date_call')");

                $result->bindParam(':phone', $phone, PDO::PARAM_STR);
                $result->bindParam(':ip', $ip, PDO::PARAM_STR);
                $result->bindParam(':type', $type, PDO::PARAM_STR);
                $result->bindParam(':data', $data, PDO::PARAM_STR);
                $result->execute();

                $id_order = $db->lastInsertId();

                if($id_order == 0) $answer = ["status"=>"fail","type"=>"Ошибка записи в базу"];
                else $answer = ["status"=>"success","type"=>"Заявка принята, ожидайте звонка!"];
            }
        }
        return json_encode($answer);
    }
}