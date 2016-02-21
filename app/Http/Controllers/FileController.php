<?php

namespace App\Http\Controllers;

use Qiniu\Auth as QiniuAuth;
use Qiniu\Storage\BucketManager;

class FileController
{
    public static $accessKey = 'veQWTVTRieyTf5VFTBZW-PmlMY7yrmYa4i7pFIIV';
    public static $secretKey = '5CC3hZHg_NpJ7aEdxc4lDmHtcpSrYUVN_ojCfWqE';

    public static $domain = 'http://7xp8c8.com1.z0.glb.clouddn.com';

    public static function listPic()
    {
        $auth = new QiniuAuth(FileController::$accessKey, FileController::$secretKey);
        $bucketMgr = new BucketManager($auth);

// http://developer.qiniu.com/docs/v6/api/reference/rs/list.html#list-description
// 要列取的空间名称
        $bucket = 'public';

// 要列取文件的公共前缀
        $prefix = '';

// 上次列举返回的位置标记，作为本次列举的起点信息。
        $marker = '';

// 本次列举的条目数
        $limit = 10;

// 列举文件
        list($iterms, $marker, $err) = $bucketMgr->listFiles($bucket, $prefix, $marker, $limit);
        if ($err !== null) {
            echo "\n====> list file err: \n";
            var_dump($err);
        } else {
            echo "Marker: $marker\n";
            echo "\nList Iterms====>\n";
            dd($iterms);
        }
    }

    public static function token()
    {
        $auth = new QiniuAuth(FileController::$accessKey, FileController::$secretKey);

        $bucket = 'public';

        $policy = array(
            'returnUrl' => url('book/call'),
            'returnBody' =>
                '{"key":$(key),"hash":$(etag),"w":$(imageInfo.width),"h":$(imageInfo.height),"name":$(x:name)}',
        );

        return $auth->uploadToken($bucket, null, 3600, $policy);
    }
}