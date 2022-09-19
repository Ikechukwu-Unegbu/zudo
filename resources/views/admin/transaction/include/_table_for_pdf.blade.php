

<h2 class="text-primary"><b>Spartan Cooperative Limited</b></h2>

<div class="">
    <!-- <ul class="divst-group"> -->
    <p class="text-primary"><b>Transaction Report for {{$user['name']}}</b></p>
    <!-- </ul> -->
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Date</th>
      <th scope="col">Credit</th>
      <th scope="col">Debit</th>
      <th>Agent</th>
      <th>Approved</th>
      <th>Balance</th>
    </tr>
  </thead>
  <tbody>
    @foreach($transactions as $trx)
    <tr>
      <th scope="row">{{$trx['id']}}</th>
      <td> {{\Carbon\Carbon::parse($trx['created_at'])->format('j F, Y')}}</td>
      <td>@if($trx['trx_type']==1){{$trx['amount'] }} @endif</td>
      <td>@if($trx['trx_type']==0){{$trx['amount']}}@endif </td>
      <td>{{$trx['customer']['name']}}</td>
      <td>@if($trx['trx_type'] ==0 && $trx['approved']==0)Not Yet @elseif($trx['trx_type']==0 && $trx['approved']==1)Approved @endif</td>
      <td>{{$trx['total_bal']}}</td>
    </tr>
    @endforeach
  </tbody>
  <tr>
        <div><span style="font-weight: bold;" class="header_bold">Total Contribution: {{$total_credit}}</span></div>
        <div><span style="font-weight: bold;" class="header_bold">Total Withdrawal: {{$total_debit}}</span></div>
        <div class=""><span style="font-weight: bold;" class="header_bold">Balance:</span> {{$total_credit - $total_debit}}</div>
    </tr>
</table>