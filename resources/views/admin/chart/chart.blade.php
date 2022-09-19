@extends('layouts.admin')

@section('head')
<style>
.search_form{
    display: flex !important;
    flex-direction: row !important;
    align-items: center;   
}
.user-deet-container{
    background-color: white;
    margin-top: 3rem;
    padding: 2rem;
}
</style>
@endsection

@section('content')
<div class="container">
<div class="content" style="width: 100%;">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-light">
                            Bar Charts
                        </div>

                        <div class="card-body">
                            <canvas id="bar-chart" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-light">
                            Line Charts
                        </div>

                        <div class="card-body">
                            <canvas id="line-chart" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            Radar Chart
                        </div>

                        <div class="card-body">
                            <canvas id="radar-chart" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-light">
                            Pie Chart
                        </div>

                        <div class="card-body">
                            <canvas id="pie-chart" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
@include('admin.agents.include._new_agent_modal')

@endsection