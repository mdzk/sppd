<?php

use App\Models\UsersModel;

if (!function_exists('get_user')) {
    function get_user($property)
    {
        $user = new UsersModel();
        $data = $user->find(session()->get('id_users'));
        return $data[$property];
    }
}
