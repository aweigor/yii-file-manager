<?php
namespace app\components\helpers;
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/5/20
 * Time: 8:18 AM
 */

class Ajax {
    public static function parseFormData($data, $formName) {
        $out = [];

        foreach($data as $dataItem) {
            if ( strpos($dataItem["name"], $formName) !== false ) {

                if (empty($dataItem["value"])) continue;

                $exp = "/\[(.*?)\]/";
                preg_match($exp, $dataItem["name"],$match);

                if(isset($out[$match[1]])) {
                    if (!is_array($out[$match[1]])) $out[$match[1]] = [$out[$match[1]]];
                    $out[$match[1]][] = $dataItem["value"];
                } else {
                    $out[$match[1]] = $dataItem["value"];
                }
            }
        }

        return $out;
    }
}