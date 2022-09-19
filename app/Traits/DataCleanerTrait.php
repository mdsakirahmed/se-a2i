<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait DataCleanerTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function data_clean($data) {
        $data = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
        $data = str_replace("'", "", "$data");
        return preg_replace('/[^\da-z ]/i', '', $data);
    }

}