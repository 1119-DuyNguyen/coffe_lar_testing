<?php

namespace App\Http\Services;


class GateService
{
    // normalize name route to restful API  : index,update, show, store, delete
    static function getGateDefineFromRouteName(string $nameRoute): string
    {
        //route admin.category.index
        $last_word_start = strrpos($nameRoute, '.'); // +1 so we don't include the space in our result
        $last_word = substr($nameRoute, $last_word_start); // $last_word = PHP.
        $nameRoute = substr_replace($nameRoute, '', $last_word_start);
        //route admin.category
        switch ($last_word) {
            case 'change-status':
            case 'edit':
                $nameRoute = substr_replace($nameRoute, 'update', $last_word_start);
                break;
            case 'create':
                $nameRoute = substr_replace($nameRoute, 'store', $last_word_start);
                break;
        }
        return $nameRoute;
    }
    // chỉ lấy những quyền của admin
    static function getAdminAbility($gateAbility): array
    {
        // quy ước tên quyền
        // <role>.<tên quyền>.<hành động>
        // admin.category.index
        // user.category.index
        if (is_array($gateAbility)) {

            //xoá những quyền không chứa "admin"
            for (
                $i = 0;
                $i < count($gateAbility);
                $i++
            ) {
                //xoá những quyền không chứa "admin"
                if (!str_contains(array_keys($gateAbility)[$i], "admin"))
                    unset($gateAbility[array_keys($gateAbility)[$i]]);
            }
            return $gateAbility;
        }
        return [];
    }
}
