<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Date</th>
      <th scope="col">Customer</th>
      <!-- <th>Amount</th> -->
      <th>Debit</th>
      <th>Credit</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    @foreach($transactions as $trx)
    <tr>
      <th scope="row">{{$trx->id}}</th>
      <td>{{$trx->created_at}}</td>
      <td>{{$trx->customer->name}}</td>
      <td>@if($trx->trx_type ==0){{$trx->amount}}@else - @endif</td>
      <td>@if($trx->trx_type ==1){{$trx->amount}}@else - @endif</td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
  <div class="">
    {{$transactions->links()}}
  </div>
 
</table>