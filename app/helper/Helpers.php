<?php
if (!function_exists('formatIDR')){
    function formatIDR($value){
        return "Rp. " . number_format($value,0,',','.');
    }
}
if (!function_exists('titik')){
    function titik($value){
        return " " . number_format($value,0,',','.');
    }
}

if (!function_exists('tanggal_bulan')){
    function tanggal_bulan($date = '', $format = 'd M'){
        if($date == '' || $date == null)
            return;
        return date($format,strtotime($date));
    }
}
if (!function_exists('tanggal_bulan_tahun')){
    function tanggal_bulan_tahun($date = '', $format = 'd M Y'){
        if($date == '' || $date == null)
            return;
        return date($format,strtotime($date));
    }
}
?>