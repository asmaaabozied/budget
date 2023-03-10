<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!---------------------------------------------- style for the pdf file --------------------------------------------->
<style>
    body {
        font-family: initial;
    }

    h1 {
        font-family: initial;
    }

    .invoice-number {
        width: 98%;
        text-align: right;
        margin: 2%;
    }


    table {
        border-collapse: collapse;
        width: 100%;
        padding: 2%;
        overflow: hidden;
        border: none;
    }

    td,
    th {
        border: none;
        text-align: right;
        padding: 8px;
    }

    .table-right td,
    .table-right th {
        text-align: right !important;
    }

    .table-details {
        margin-top: 4%;
        margin-bottom: 4%;
        background-color: white;
        /*border-radius: 6px !important;
      overflow: hidden;*/
    }

    .table-details tr th,
    .table-details tr td {
        width: 20%;
    }

    .table-right tr th:nth-child(1),
    .table-right tr th:nth-child(2) {
        width: 20%;
    }


    .table-details th {
        border: none !important;
        z-index: 999;
        background-color: rgba(211, 214, 224, 0.2);
        border-right: 1px solid white !important;
    }

    .back {
        background-image: url('images/back.png');
        background-size: cover;
        background-repeat: no-repeat;
        width: 100%;
        height: 523px;
        margin-bottom: 10%;
    }

    .back .card {
        padding: 2% 2%;
        margin-top: 4%;
        background-color: transparent;
    }

    .footer-info{
        float: center;
    }
    .footer-content {
        float: right;
        text-align: right;
        padding: 1%;
        padding-top: 20%;
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    mark {
        background-color: #EEF7FC;
        color: black;
    }

    .page {
        overflow: hidden;
        page-break-after: always;
    }

    .page:last-of-type {
        page-break-after: auto
    }

</style>
<body>
<!---------------------------------------------- header --------------------------------------------->

    <h1 style="text-align:right;font-size:2rem">?????????? ??????????</h1>
    <p style="text-align:right;">.Your VAT invoices will be emailed to you and are always available on your noon account</p>

    <div class="card invoice-number">
        <table style="direction:rtl">
            <tr>
                <th>?????????? ????????????</th>
                <th>??????????????</th>
                <th>?????????? ??????????</th>
            </tr>
            <tr>
                <td>?????? ???????????? &nbsp;  {{$bill_number}}_{{$id}} </td>
                <td>{{$purchaser->name}}</td>
                <td>{{$payment_type}}</td>
            </tr>
            <tr>
                <td>?????????? ?????????????? &nbsp; {{$created_at}} </td>
                <td>{{$purchaser->address}}</td>
                <td></td>
            </tr>
            <tr>
                <td>?????? ?????????????? &nbsp; {{$bill_number}} </td>
                <td></td>
                <td></td>
            </tr>

        </table>
    </div>
    <!--  Now we will display each shop products in one table, so I'm using $array variable to store the shop_id 
    In the beginning array should be empty, so we display the first element, but after that we should see if the new product' shop_id in the $array or not -->

    @php $array[] = null; @endphp
    @foreach($orders as $key=>$order)
    <!-- Im using the for loop for displaying QR, we should put it after each shop products, so for each element in orders array i will see if the shop_id of $order at the key+1 is equal to shop_id at the key ---------->
    @for($i=$key+1; $i<=count($orders); $i++) <div @if(!in_array($order->shop_id, $array)) class="page" @endif>
        @if(!in_array($order->shop_id, $array))
        <div class="card invoice-number">
            <table style="direction:rtl">
                <tr>
                    <th> ????????????</th>
                    <th>?????????? ?????????????? ?????????????? ??????????????</th>
                    <th>?????? ???????????????? </th>
                </tr>
                <tr>
                    <td>{{$order->seller->name_ar}}</td>
                    <td>{{$order->seller->vat_no}}</td>
                    <td>{{$bill_number}}</td>
                </tr>

            </table>
        </div>

        <div class="card info">
        <!-- here if the shop_id not found in the $array, we will display the whole table, else that we will display just the row without the header of the table------>
            @if(!in_array($order->shop_id, $array))
            <table class="table-right table-details" style="direction:rtl">
                <tr>
                    <th>?????????? </th>
                    <th>???????????????? ?????? ???????? ?????????? ???????????? ??????????????<span>(???????? ??????????)</span></th>
                    <th>?????????? ???????????? ??????????????</th>
                    <th>???????? ?????????? ???????????? ??????????????<span>(???????? ??????????)</span></th>
                    <th>???????????????? ???????? ?????????? ???????????? ??????????????<span>(???????? ??????????)</span></th>
                </tr>
                <tr>
                    <td>{{$order->product->name_ar}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->seller->vat}} % </td>
                    <td>{{$order->vat_value}}</td>
                    <td>{{$order->total_with_tax}}</td>
                </tr>
                @endif
                @else
                <table class="table-right table-details" style="direction:rtl">
                    <tr>
                        <td>{{$order->product->name_ar}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->seller->vat}} % </td>
                        <td>{{$order->vat_value}}</td>
                        <td>{{$order->total_with_tax}}</td>
                    </tr>
                    @endif
                </table>
                <!-- after display the order we will add shop_id to the $array ---> 
                @php
                $array[] = $order->seller->id;
                @endphp
        </div>
        <!-- displaying the qr will be in two situation:
        1- if that order is the last order and orders array will be empty
        2- if the following order's shop_id is not equal for the current order's shop_id, that meaning the following order will be for another shop --->
        @if($i==count($orders))
        <div class="footer-info">
            <div class="">
                <table style="color:white">
                    <tr>
                        <td>
                            <img src="{{$qr}}" style="border:1px solid white;background-color:white;padding-top:1%">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @else
        @if($orders[$i]->shop_id != $order->shop_id )
        <div class="footer-info">
            <div class="">
                <table style="color:white">
                    <tr>
                        <td>
                            <img src="{{$qr}}" style="border:1px solid white;background-color:white;padding-top:1%">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        </div>
        @endif
        @endif
        <!-- here we use break to stop the loops after display the order ---->
        @php
        if($i != count($orders)){
        break;
        }
        @endphp
        </div>

        @php
        @endphp
        @endfor
        @endforeach
        <div class="card">
            <table class="table-right" style="width:40%;float:left;text-align:right;direction:rtl">
                <tr>
                    <th>?????????????? ???????????? ????????????</th>
                    <td>{{$sub_total}} ????????</td>
                </tr>
                <tr>
                    <th> ???????????? ???????????? </th>
                    <td> {{$total}} ????????</td>
                </tr>
            </table>
        </div>
</body>
</html>
