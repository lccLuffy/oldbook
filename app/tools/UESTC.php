<?php

/**
 * Created by PhpStorm.
 * User: lcc_luffy
 * Date: 2016/2/17
 * Time: 4:11
 */
class UESTC
{
    const SEMESTER_ID_2014_2015_UP = 43;
    const SEMESTER_ID_2014_2015_DOWN = 63;
    const SEMESTER_ID_2015_2016_UP = 84;

    const EXAM_TYPE_FINAL = 1;			//期末考试
    const EXAM_TYPE_MID = 2;				//期中考试
    const EXAM_TYPE_MAKEUP = 3;			//补考
    const EXAM_TYPE_HUANKAO = 4;			//缓考

    private $studentNum,$password,$cookie;
    public function __construct($studentNum,$password)
    {
        $this->studentNum = $studentNum;
        $this->password = $password;
    }
    public static function SemesterIdToString($id)
    {
        $str = '';
        switch($id)
        {
            case 43:
                $str = "2014-2015上学期";
                break;
            case 63:
                $str = "2014-2015下学期";
                break;
            case 84:
                $str="2015-2016上学期";
                break;
        }
        return $str;
    }
    public static function ExamIdToString($id)
    {
        $str = '';
        switch($id)
        {
            case 1:
                $str = "期末考试";
                break;
            case 2:
                $str = "期中考试";
                break;
            case 3:
                $str="补考";
                break;
            case 4:
                $str="缓考";
                break;
        }
        return $str;
    }
    public function login()
    {
        return $this->parseCookie();
    }
    private function parseCookie()
    {
        if($this->cookie)
        {
            return $this->cookie;
        }

        $header = $this->getHeader();

        preg_match('/iPlanetDirectoryPro=(\S+);/',$header,$cookie);

        if(empty($cookie))
        {
            return false;
        }

        $str = $cookie[0];

        $str = substr($str,0,strlen($str)-1);

        $this->cookie = $str;

        return ($str);
    }

    private function getHeader()
    {
        $url = 'https://uis.uestc.edu.cn/amserver/UI/Login?goto=http%3A%2F%2Fportal.uestc.edu.cn%2Flogin.portal';
        $postData =
            "IDButton=Submit&".
            "IDToken1=$this->studentNum&".
            "IDToken2=$this->password&".
            "encoded=true&".
            "goto=aHR0cDovL3BvcnRhbC51ZXN0Yy5lZHUuY24vbG9naW4ucG9ydGFs&".
            "gx_charset=UTF-8";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch,CURLOPT_HEADER,1); //将头文件的信息作为数据流输出
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    private function getInfoString($url)
    {
        $cookie = $this->parseCookie();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0");
        curl_setopt($ch,CURLOPT_COOKIE,$cookie);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    public function getExam($semester = 84,$examType = 1)
    {
        $url = "http://eams.uestc.edu.cn/eams/stdExamTable!examTable.action?semester.id=$semester&examType.id=$examType";
        return $this->getInfoString($url);
    }

    public function getGrade($semester = 84)
    {
        $url = "http://eams.uestc.edu.cn/eams/teach/grade/course/person!search.action?semesterId=$semester";
        return $this->getInfoString($url);
    }

    public function getStudentInfo()
    {
        $url = 'http://eams.uestc.edu.cn/eams/stdDetail.action';
        return $this->getInfoString($url);
    }
    public function getCourseTable()
    {
        $url = 'http://eams.uestc.edu.cn/eams/courseTableForStd!courseTable.action';
        $postData =
            "ignoreHead=1&".
            "setting.kind=std&".
            "startWeek=1&".
            "semester.id=63&".
            "ids=135871";
        $cookie = "JSESSIONID=59D3D160EB4B9D9D0CC1920C0D462287;iPlanetDirectoryPro=AQIC5wM2LY4SfcwI6K8uTebK/PM8jaVZfGAz1h1DUe6IPIc=@AAJTSQACMDE=#;semester.id=63;";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_COOKIE,$cookie);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}