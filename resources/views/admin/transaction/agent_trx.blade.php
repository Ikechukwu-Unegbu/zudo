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
   
    <div class="">
        @include('partials._message')
    </div>
    <h2 style="color:green">Agent Transaction Report</h2>
    <div class="report_control">
    <a href="{{route('admin.agent.user.pdf', [$agent->id])}}" class="btn btn-primary btn-sm">Export PDF</a>
        <form action="" method="get">
            <div class="form-group">
                <label for="" class="form-label">User ID</label>
                <input type="text" name="userid" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date">
            </div>
            <div class="form-group">
                <label for="" class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date">
            </div>
            <div class="form-group">
            <label for="" class="form-label"></label>
                <input type="submit" style="border-radius: 50%;" class="form-control btn btn" value="Go">
                <!-- <label for="" class="form-label"></label>
                <button class="btn btn-sm btn-primary">Go</button> -->
            </div>
        </form>
    </div>
    <!-- <div class="mb-3">
    <a href="" class="btn btn-info btn-sm">Print PDF</a>
  </div> -->
    @include('admin.transaction.include._agent_trx_table')

</div>

@endsection