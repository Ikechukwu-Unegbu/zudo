  <!-- Right side columns -->
  <div class="col-lg-4">

<!-- Recent Activity -->
<div class="card">
  <div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
      <li class="dropdown-header text-start">
        <h6>Filter</h6>
      </li>

      <li><a class="dropdown-item" href="#">Today</a></li>
      <li><a class="dropdown-item" href="#">This Month</a></li>
      <li><a class="dropdown-item" href="#">This Year</a></li>
    </ul>
  </div>

  <div class="card-body">
    <h5 class="card-title">Withdrawal Log</h5>

    <div class="activity">

     @foreach($withdraws as $draw)
      <div class="activity-item d-flex">
          <div class="activite-label">
            @php($diffInDays = \Carbon\Carbon::parse($draw->created_at)->diffInDays())

            @php($showDiff = \Carbon\Carbon::parse($draw->created_at)->diffForHumans())

            @if($diffInDays > 0)

            @php($showDiff .= ', '.\Carbon\Carbon::parse($draw->created_at)->addDays($diffInDays)->diffInHours().' Hrs')

            @endif

            {{$showDiff}}
            <br>
            @if($draw->approved ==0)
            <span style="color:red; font-weight:bold;" class="alert-success">processing</span>
            @else 
            <span style="color:red; font-weight:bold;" class="alert-success">done</span>
            @endif
          </div>
          <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
          <div class="activity-content">
            You requested N {{$draw->amount}}
          </div>
      </div><!-- End activity item-->
     @endforeach

  </div>
</div>
<!-- End Recent Activity -->


</div><!-- End Right side columns -->