<?php

class AdminController
{
    public function actionIndex()
    {
    	if(admin::check()) {
            $count_call = call::countCall("call");
            $count_reserve = call::countCall("reserve");
            require_once(ROOT . '/views/admin/index.php');
        }
    	else self::actionLogin();
        return true;
    }
    public function actionLogin()
    {
    	if(!admin::check()) require_once(ROOT . '/views/admin/login.php');
    	else header("Location:/admin");
        return true;
    }
}
