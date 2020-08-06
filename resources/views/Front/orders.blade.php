@extends('Layout.Front')

@section('content')
<style>
    th,td{
        padding: 10px;
    }
</style>
<section class="profile-section" style="width: 70%">
    <h1>
        لیست سفارشات
    </h1>
    <div class="plans">
        <div class="container-fluid">

            <table class=" w-100">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شماره سفارش</th>
                        <th>زمان ثبت سفارش</th>
                        <th>وضعیت سفارش</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $key=>$item)
                    <tr>
                        <td>{{($key+1)}}</td>
                        <td>{{$item->transaction_code}}</td>
                        <td>{{\Morilog\Jalali\Jalalian::forge($item->created_at)->format('%B %d، %Y')}}</td>
                        <td>
                            @if ($item->success == '1')
                            <span class="text-success">موفق</span>
                            @else    
                             <span class="text-danger">ناموفق</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>



</section>
@endsection