<?php

namespace App\Controllers;
use App\Models\UserAccessModel;


class PermissionChecker extends BaseController
{
	public function check($user_id, $permissionneed)
	{	
        $userAccessModel = new UserAccessModel();
        $userpermissions = $userAccessModel->getPermission($user_id);
        foreach($userpermissions as $userpermission){
            if($permissionneed == $userpermission['permission_name']){
                return true;
            }
        }
        return false;
	}

    public function checkajax($user_id, $permissionneed)
	{	
        $userAccessModel = new UserAccessModel();
        $userpermissions = $userAccessModel->getPermission($user_id);
        foreach($userpermissions as $userpermission){
            if($permissionneed == $userpermission['permission_name']){
                echo true;
            }
        }
        echo false;
	}
}
