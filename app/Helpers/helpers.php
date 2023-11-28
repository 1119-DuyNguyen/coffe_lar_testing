<?php




//


/** lemit text */

function limitText($text, $limit = 20)
{
    return \Str::limit($text, $limit);
}

if(!function_exists('isInsideArrayKey')){
    function isInsideArrayKey($valueCheck, $keyCheck, $array)
    {
        foreach ($array as $key => $value) {
            if (isset($value[$keyCheck]) && $value[$keyCheck] == $valueCheck) {
                return true;
            }
        }
        return false;
    }
}
if(!function_exists('getValueInsideArrayKey')){
    function getValueInsideArrayKey($valueCheck, $keyCheck,$keyValue, $array)
    {
        foreach ($array as $key => $value) {
            if (isset($value[$keyCheck]) && $value[$keyCheck] == $valueCheck) {
                return $value[$keyValue];
            }
        }
        return '';
    }
}

/**
 *
 * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
 *
 * @access    public
 * @param    string
 * @return    string
 */

use App\Models\Materials;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

if (!function_exists('currency_format')) {

    function currency_format($number, $suffix = 'đ')
    {
        if (!empty($number)) {
            return number_format($number, 0, '.', '.') . "{$suffix}";
        }
    }
}

if (!function_exists('getURL')) {

    function getURL()
    {
        return asset('/');
    }
}

if (!function_exists('get_user')) {
    function get_user($type, $field = 'id')
    {
//        return Auth::guard($type)->user() ? Auth::guard($type)->user()->$field : "";
        return "";
    }
}

if (!function_exists('format_date')) {
    function format_date($date)
    {
        $t = Carbon::create($date)->format('d/m/Y H:i:s');
        return $t;
    }
}

if (!function_exists('toTime')) {
    function toTime($time)
    {
        Carbon::setLocale('vi');
        $dt = Carbon::create($time);
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        return $dt->diffForHumans($now);
    }
}


if (!function_exists('getNameLog')) {
    function getNameLog()
    {
        # code...
        $getIDLogin = Auth::user()->id;
        $getInfo = User::where('id', $getIDLogin)->first();
        $nameLog = $getInfo->name_staff;
        return $nameLog;
    }
}
if (!function_exists('getIdLog')) {
    function getIdLog()
    {
        # code...
//        $getIDLogin = Auth::user()->id;
//        $getInfo = User::where('id', $getIDLogin)->first();
//        return $getInfo->id;
    }
}



