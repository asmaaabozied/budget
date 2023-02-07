<?php

namespace App\Helpers;

use App\Models\Wallet;

class DTHelper
{
    public static function dtImageButton($image)
    {
        $html = <<< HTML

    <img src="{{asset('uploads/shops/products/'.$image->image)}}" border="0" width="10" class="img-rounded" align="center" />

HTML;

        return $html;
    }

    public static function dtEditButton($link, $title, $permission)
    {

//        if (auth()->user()->hasPermission($permission)) {

        $html = <<< HTML
 <a href="$link" class="update btn-table" ><i class="ri-pencil-line"></i> </a>
HTML;

        return $html;
    }

//    }
    public static function dtPrintButton($link, $title, $permission)
    {

//        if (auth()->user()->hasPermission($permission)) {

        $html = <<< HTML
 <a href="$link" class="update btn-table" ><i class="uil-copy-alt me-1"></i> </a>
HTML;

        return $html;
    }

//    }

    public static function dtDownloadButton($link, $title, $permission)
    {
        $html = <<< HTML
     <a href="$link" > <i class="far fa-download me-1 fa fa-1x" download></i></a>
    HTML;

        return $html;
    }

    public static function dtPopButton($link, $title, $permission)
    {
        $balance = trans('site.chanagebalance');
//        if (auth()->user()->hasPermission($permission)) {
        $data = Wallet::where('id', $link)->first();

        $html = <<< HTML

     <button type="button" class="btn btn-primary data" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="getdata($data->balance,$data->id)">
                           $balance
                        </button>
HTML;

        return $html;
//        }
    }

    public static function dtPopButtonProduct($link, $title, $permission)
    {
        $balance = trans('site.chanagebalance');
//        if (auth()->user()->hasPermission($permission)) {
//        $data = Wallet::where('id', $link)->first();

        $html = <<< HTML

     <button type="button" class="data" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="getdata($link)">
                     <i class="ri-eye-line"></i>
                        </button>
HTML;

        return $html;
//        }
    }

    public static function dtBlockActivateButton($link, $status, $permission)
    {
        if ($status == 1) {
            $active = 'fas fa-check-circle fa fa-1x';
        } else {
            $active = 'far fa-ban fa fa-1x';
        }

        $csrf = csrf_field();
        $method_field = method_field('POST');
        $classType = ($status) ? 'btn-warning' : 'btn-default';
        $iconName = ($status) ? 'fa-ban' : 'fa-user';
        if ($status == 'TRUE') {
//            if (auth()->user()->hasPermission($permission)) {
            $html = <<< HTML

<a href="$link" class="update">

 <i class="fas fa-check-circle fa fa-1x"></i>

</a>

HTML;
        } else {
            $html = <<< HTML

<a href="$link" class="update">

 <i class="far fa-ban fa fa-1x"></i>

</a>

HTML;
        }

        return $html;
//        }
    }

    public static function dtDeleteButton($link, $title, $permission, $id)
    {
        $csrf = csrf_field();
        $method_field = method_field('delete');
//        if (auth()->user()->hasPermission($permission)) {

        $html = <<< HTML
<form action="$link" method="post" style="display: inline-block" id="deleteForm$id">
$csrf
$method_field
<button type="button" onclick="confirmDelete($id)" id="delete" class="btn-table delete btn  btn-xs 88" style="border: none;
    background: transparent;">
<i class="ri-delete-bin-line"></i>
</button>
</form>
HTML;

        return $html;
//        }
    }

    public static function dtDeleteButtondisabled($link, $title, $permission)
    {
        $csrf = csrf_field();
        $method_field = method_field('delete');
        if (auth()->user()->hasPermission($permission)) {
            $html = <<< HTML
 <form action="$link" method="post" style="display: inline-block">
$csrf
$method_field
<button type="submit" id="delete" class="delete" style="border: none;
    background: transparent;" disabled>
<i class="ri-delete-bin-line"></i>
</button>
</form>
HTML;

            return $html;
        }
    }

    public static function dtShowButton($link, $title, $permission)
    {

//        if (auth()->user()->hasPermission($permission)) {

        $html = <<< HTML
 <a href="$link" class="btn-table"> <i class="ri-eye-line"></i></a>
HTML;

        return $html;
    }
}
