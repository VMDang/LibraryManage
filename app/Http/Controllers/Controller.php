<?php

namespace App\Http\Controllers;

use BaseHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Input: Date
     * Output: Timestamp
     *
     * @param $date
     * @return string|null
     */
    protected function changeFormatDateInput($date)
    {
        if(!empty($date)) {
            $arrTime = explode(" ", $date);
            $strDate = $arrTime[0];
            $strDate = explode('/', $strDate);
            $strDate = implode('-', [$strDate[2], $strDate[1], $strDate[0]]);
            if(count($arrTime) > 1) {
                return $strDate . ' ' . $arrTime[1];
            }
            return $strDate;
        }
        return NULL;
    }

    /**
     * Input: timestamp
     * Output: Date
     *
     * @param $date
     * @return string|null
     */
    protected function changeFormatDateOutput($date)
    {
        if(!empty($date)) {
            $date = date_format(date_create($date), "Y/m/d");
            $date = explode('/', $date);
            return $date[2] . '/' . $date[1] . '/' . $date[0];
        }
        return NULL;
    }

    /**
     * Check request from view isAjax
     *
     * @param $request
     * @return void
     */
    protected function checkRequestAjax($request)
    {
        if(!$request->ajax()){
            BaseHelper::ajaxResponse('Quyền truy cập bị từ chối!');
        }
    }

    /**
     * Empty data request Ajax
     *
     * @param $data
     * @return void
     */
    protected function checkEmptyDataAjax($data)
    {
        if(empty($data)) {
            BaseHelper::ajaxResponse('Dữ liệu trống! Vui lòng thử lại sau!', false);
        }
    }
}
