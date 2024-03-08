<?php

use App\Models\ModuleMaster;
use App\Models\Store;

function softModules()
{
    return ModuleMaster::all();
}

// function stores()
// {
//     $stores = Store::all();
//     $html = '';

//     foreach ($stores as $store) {
//         $html .= "<option value=\"{$store->id}\"" . (session('store_id') == $store->id ? ' selected' : '') . ">{$store->name}</option>";
//     }

//     return $html;
// }

function dateFormatdMY($date){
    if($date=='' || $date==null){
        return '-';
    }
    return date('d M Y',strtotime($date));
}

function dateFormatdMYHia($date){
    if($date=='' || $date==null){
        return '-';
    }
    return date('d M Y H:iA',strtotime($date));
}
