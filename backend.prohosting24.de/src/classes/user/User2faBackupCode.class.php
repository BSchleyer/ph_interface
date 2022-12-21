<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class User2faBackupCode extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_user_2fa_backup_codes", $dependencyInjector, $value, $key);
    }

    public function createCodes($userid)
    {
        for ($i = 0; $i < 10; $i++){
            $code = new User2faBackupCode($this->dependencyInjector, null);
            $code->setValue("userid", $userid);
            $code->setValue("status", 1);
            $code->setValue("code", random_str(8, '0123456789abcdefghijklmnopqrstuvwxyz'));
            $code->create();
        }
    }

    public function invalidAllCodes($userid)
    {
        $this->massUpdate(["status" => 2],["userid" => $userid]);
    }

    public function checkBackupCode($backupCode, $userid)
    {
        $code = new User2faBackupCode($this->dependencyInjector, null);
        $code = $code->getAll(["userid" => $userid, "code" => $backupCode]);
        if(count($code) != 1){
            return false;
        }
        $code = $code[0];
        $code->setValue("status", 2);
        $code->update();
        return true;
    }
}
