@extends('layouts.admin')

@section('head')

@section('content')

<div class="pt-5 main-content">
    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="mb-3 col-xl-4 col-lg-4">
                        <div class="mb-4 card card-stats mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-0 card-title text-uppercase text-muted">Users</h5>
                                        <span class="mb-0 h2 font-weight-bold">{{ $users }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-white shadow icon icon-shape bg-danger rounded-circle">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm text-muted">
                                    <span class="mr-2 text-success"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-xl-4 col-lg-4">
                        <div class="mb-4 card card-stats mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-0 card-title text-uppercase text-muted">Channels</h5>
                                        <span class="mb-0 h2 font-weight-bold">{{ $channels }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-white shadow icon icon-shape bg-primary rounded-circle">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm text-muted">
                                    <span class="mr-2 text-success"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-xl-4 col-lg-4">
                        <div class="mb-4 card card-stats mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-0 card-title text-uppercase text-muted">Transations</h5>
                                        <span class="mb-0 h2 font-weight-bold">{{ number_format($transations), 2 }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-white shadow icon icon-shape bg-warning rounded-circle">
                                            <i class="fa fa-money-bill-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm text-muted">
                                    <span class="mr-2 text-success"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-xl-4 col-lg-4">
                        <div class="mb-4 card card-stats mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-0 card-title text-uppercase text-muted">Withdrawals</h5>
                                        <span class="mb-0 h2 font-weight-bold">{{ number_format($withdraws), 2 }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-white shadow icon icon-shape bg-secondary rounded-circle">
                                            <i class="fa fa-money-bill-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm text-muted">
                                    <span class="mr-2 text-success"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-5 card">
                    <div class="card-body">
                        <div>
                            <canvas id="users"></canvas>
                        </div>
                    </div>
                </div>

                <div class="mt-5 card">
                    <div class="card-body">
                        <div>
                            <canvas id="ContributionCharts"></canvas>
                        </div>
                    </div>
                </div>

                <div class="mt-5 card">
                    <div class="card-body">
                        <div>
                            <canvas id="WithdrawalCharts"></canvas>
                        </div>
                    </div>
                </div>

                <div class="mt-5 card">
                    <div class="card-body">
                        <div>
                            <canvas id="AgentsMoneyCollection"></canvas>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@include('admin.home.include._card_styles')

@push('scripts')

<script>
    var __yMonths =  {{ Js::from($months) }};
    var __xtrxMonthlyContributionData =  {{ Js::from($trxContData) }};

    const data = {
    labels: __yMonths,
    datasets: [{
        label: 'Contribution Chart',
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgb(255, 99, 132)',
        data: __xtrxMonthlyContributionData,

    }]
    };
    const config = {
    type: 'line',
    data: data,
    options: {}
    };
    const ContributionCharts = new Chart(
    document.getElementById('ContributionCharts'),
    config
    );
</script>

<script>
    var __yMonths =  {{ Js::from($months) }};
    var __xtrxMonthlyWithdrawalData =  {{ Js::from($trxWithData) }};

    const dataWithdrwal = {
    labels: __yMonths,
    datasets: [{
        label: 'Withdrawal Chart',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgb(75, 192, 192)',
        data: __xtrxMonthlyWithdrawalData,

    }]
    };
    const configWithdrwal = {
    type: 'line',
    data: dataWithdrwal,
    options: {}
    };
    const WithdrawalCharts = new Chart(
    document.getElementById('WithdrawalCharts'),
    configWithdrwal
    );
</script>

<script>
    var __yMonths =  {{ Js::from($months) }};
    var __xMonthlyUsersData =  {{ Js::from($monthlyRegisteredUsers) }};

    const dataUsers = {
    labels: __yMonths,
    datasets: [{
        label: 'Users Chart',
        backgroundColor: 'rgb(255, 205, 86)',
        borderColor: 'rgb(255, 205, 86)',
        data: __xMonthlyUsersData,

    }]
    };
    const configUsers = {
    type: 'line',
    data: dataUsers,
    options: {}
    };
    const users = new Chart(
    document.getElementById('users'),
    configUsers
    );
</script>

<script>
    var __yAgentName =  {{ Js::from($agentsMoneyCollection) }};
    var __xAgentData =  {{ Js::from($agentsMoneyCollectionData) }};

    const dataAgents = {
    labels: __yAgentName,
    datasets: [{
        label: 'Total Amount Collectd by Agents',
        backgroundColor: 'rgba(153, 102, 255, 0.2)',
        borderColor: 'rgba(153, 102, 255, 0.2)',
        data: __xAgentData,

    }]
    };
    const configAgents = {
    type: 'bar',
    data: dataAgents,
    options: {}
    };
    const AgentsMoneyCollection = new Chart(
    document.getElementById('AgentsMoneyCollection'),
    configAgents
    );
</script>


@endpush
@endsection
