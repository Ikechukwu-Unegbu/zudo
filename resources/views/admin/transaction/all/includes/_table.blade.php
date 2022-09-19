<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Customer ID</th>
      <th scope="col">Agent ID</th>
      <th>Date</th>
      <th>Credit</th>
      <th>Debit</th>
    </tr>
  </thead>
  <tbody>
   @foreach($transactions as $transaction)
   <tr>
      <th scope="row">{{$transaction->id}}</th>
      <td>{{$transaction->customer->name}}</td>
      <td>{{$transaction->customer->id}}</td>
      <td>{{$transaction->agent->name}}</td>
      <td>{{$transaction->created_at}}</td>
      <td>@if($transaction->trx_type ==1){{$transaction->amount}}@else - @endif</td>
      <td>@if($transaction->trx_type ==0){{$transaction->amount}}@else - @endif</td>
    </tr>
   @endforeach
  </tbody>
  <div class="">
    {{$transactions->links()}}
  </div>
</table>