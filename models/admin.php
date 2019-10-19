<?php


class admin
{
    public static function autorization()
    {
    	$login = $_POST['login'];
    	$pass = md5($_POST['pass']);

    	$db = db::getConnection();

        $result = $db->prepare('SELECT COUNT(*) FROM `admin` WHERE login=:login AND pass=:pass');
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':pass', $pass, PDO::PARAM_STR);
        $result->execute();
        $num_rows = $result->fetchColumn();

        if($num_rows == 1) {
        	$answer = ["status"=>"success"];
        	$_SESSION['nokton_token'] = md5($login."nokton.ru".$pass."cript");
        }
        else $answer = ["status"=>"fail","type"=>"Неверный логин или пароль"];
        return json_encode($answer);
    }
    public static function check(){
    	if(isset($_SESSION['nokton_token']))
    	{
    		$db = db::getConnection();
    		$result = $db->query('SELECT * FROM `admin` WHERE 1');
            $data = $result->fetch();
            $hash = md5($data['login']."nokton.ru".$data['pass']."cript");
            if($_SESSION['nokton_token'] == $hash) return true;
            else return false;
    	}
    	else return false;
    }
}