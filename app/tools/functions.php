<?php
use App\User;

/**
 * Return "checked" if true
 */
function isAdmin(User $user)
{
    if ($user->is_admin) {
        return true;
    }

    if (in_array($user->stu_num, config('oldbook.admin.stu_num'))) {
        return true;
    }

    if (in_array($user->id, config('oldbook.admin.ids'))) {
        return true;
    }

    return false;
}

function url_user_center($user_id)
{
    return route('user.center', $user_id);
}

function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

function random_num($count = 13)
{
    $data = '';
    for ($i = 0; $i < $count; $i++) {
        $data .= random_int(0, 9);
    }
    return $data;
}