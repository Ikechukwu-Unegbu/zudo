<h3 class="text-center">User Positive Feedback</h3>
<table class="table">
  <thead class="">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Allowed Use</th>
      <th scope="col">Visibility</th>
      <th scope="col">Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($reviews as $review)
    <tr>
      <th scope="row">{{$review->id}}</th>
      <td>{{$review->usage}}</td>
      <td>@if($review->share == 0) Unpublished @else Published @endif</td>
      <td>{{$review->created_at}}</td>
      <th>
        <button class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#exampleModal-{{$review->id}}">View</button>
        <button class="btn btn-sm">Publish</button>
      </th>
    </tr>
    @include('pages.support.include._view_feedback')
    @endforeach
  </tbody>
</table>


<div>
  {{$reviews->links()}}
</div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" >
  Launch demo modal
</button> -->

<!-- Modal -->
