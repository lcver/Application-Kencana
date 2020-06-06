<?php

class Helper
{
    public static function null_checker($request)
    {
        if(!is_null($request)){
            // count array key
            $arr_key = array_keys($request);
            $count = count($arr_key);

            /**
             * filter array
             * when array just have one row
             */
            $num = NULL;
            for ($i=0; $i < $count ; $i++) {
                if(is_numeric($arr_key[$i])) $num = true;
            }

                $response = !$num ? [$request] : $request;

        }else{
            $response = null;
        }
        return $response;
    }
}
