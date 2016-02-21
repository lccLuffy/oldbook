<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use UESTC;
use Yangqi\Htmldom\Htmldom;

require_once __DIR__ . '/../../../tools/UESTC.php';

trait UestcController
{
    protected $student_data;

    public function canLogin($stu_num, $password)
    {
        $uestc = new UESTC($stu_num, $password);

        if ($uestc->login()) {
            $this->student_data = $this->parse($uestc->getStudentInfo());
            return true;
        }
        return false;
    }


    private function parse($str)
    {
        $dom = new Htmldom($str);

        $trs = $dom->find("table[id=studentInfoTb]")[0]->find('tr');

        $json = [];
        $key = '';
        $name = '';

        $data = [];

        $i = 0;
        foreach ($trs as $element) {
            $tds = $element->find("td");
            $j = 0;
            if ($i != 0) {
                foreach ($tds as $td) {
                    $item = $td->innertext;
                    if ($j < 4) {
                        if ($i == 1 && $j == 3) {
                            $name = $item;
                        }
                        if ($j % 2 == 0) {
                            $key = str_replace('：', '', $item);
                        } else {
                            $json[$key] = $item;
                        }
                    }
                    $j++;
                }
            }
            $i++;
        }
        $dom->clear();
        $data['json'] = json_encode($json);
        $data['name'] = $name;

        return $data;
    }
}
