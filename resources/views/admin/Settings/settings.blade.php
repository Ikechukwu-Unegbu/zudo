@extends('layouts.admin')

@section('head')
<style>
    .deets{
        display: flex;
        grid-gap: 2rem;
    }
    ul{
        list-style: none;

    }
    .report_control{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
    .report_control form{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    .report_control form .form-group{
        justify-self: center;
        align-self: center;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="setting-container">
        <!-- setting card -->
        <div class="card">
            <div class="card-header">
                @if($setting->sms == 1) <b style="color: green;">SMS is On.</b> @else <b style="color: red;">SMS is off</b> @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">SMS Feature on The Site</h5>
                <p class="card-text">From here you can turn off sms sending or turn it on for the whole site.</p>
                @if($setting->sms == 1)
                <button data-toggle="modal" data-target="#sms-seeting" style="float: right;" class="btn btn-sm btn-primary">Turn off SMS</button>
                @else
                <button data-toggle="modal" data-target="#sms-seeting" style="float: right;" class="btn btn-sm btn-primary">Turn on SMS</button>
                @endif
            </div>
        </div>
        <!-- end of card -->

           <!-- setting card -->
           <div class="card">
            <div class="card-header">
                @if($setting->e_debit == 1) <b style="color: green;">Electronic Withdrawal is On</b> @else <b style="color: red;">Electronic Withdrawal is Off</b> @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">Control Front For Electronic Withdrawal</h5>
                <p class="card-text">From here you can turn on or off electronic withdrawal in the entire site</p>
                @if($setting->e_debit == 1)
                <button data-toggle="modal" data-target="#e_debit-settings" style="float: right;" class="btn btn-sm btn-primary">Turn off E-debit</button>
                @else
                <button data-toggle="modal" data-target="#e_debit-settings" style="float: right;" class="btn btn-sm btn-primary">Turn on E-debit</button>
                @endif
            </div>
        </div>
        <!-- end of card -->

           <!-- setting card -->
           <div class="card">
            <div class="card-header">
                @if($setting->e_credit == 1) <b class="" style="color: green;">Electronic Funding is On</b> @else <b style="color: red;">Electronic Funding is Off</b> @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">Control Front For Electronic Contribution</h5>
                <p class="card-text">From here you can turn on or off electronic contribution in the entire site</p>
                @if($setting->e_credit == 1)
                    <button data-toggle="modal" data-target="#e_credit-settings" style="float: right;" class="btn btn-sm btn-primary">Turn off E-credit</button>
                @else
                    <button data-toggle="modal" data-target="#e_credit-settings" style="float: right;" class="btn btn-sm btn-primary">Turn on E-credit</button>
                @endif
            </div>
        </div>
        <!-- end of card -->

             <!-- setting card -->
             <div class="card">
            <div class="card-header">
                @if($setting->user_data == 1) <b class="" style="color: green;">Users can edit data now</b> @else <b style="color: red;">User cant edit data now</b> @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">User's Data Control</h5>
                <p class="card-text">From here you control whether or not users can edit their data.</p>
                @if($setting->user_dat == 1)
                    <button data-toggle="modal" data-target="#user_data-settings" style="float: right;" class="btn btn-sm btn-primary">Turn off E-credit</button>
                @else
                    <button data-toggle="modal" data-target="#user_data-settings" style="float: right;" class="btn btn-sm btn-primary">Turn on E-credit</button>
                @endif
            </div>
        </div>
        <!-- end of card -->
           
       
    </div>
</div>

@include('admin.Settings._modals')
@endsection