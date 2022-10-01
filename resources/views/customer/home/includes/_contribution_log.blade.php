<div class="col-12">
              <div class="card top-selling overflow-auto">

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

                <div class="card-body pb-0">
                  <h5 class="card-title">Contribution Log <span>| This Month</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Time</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($cons as $contribution)
                        <tr>
                            <th scope="row">{{$contribution->id}}</th>
                            <td><a href="#" class="text-primary fw-bold">{{$contribution->purpose}}</a></td>
                            <td>N {{$contribution->amount}}</td>
                            <td class="fw-bold">{{$contribution->agent->name ?? ''}}</td>
                            <!-- <td>{{$contribution->created_at}}</td> -->
                            <td>{{ date('Y M -d D', strtotime($contribution->created_at)) }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                  </table>
                    <div class="">{{$cons->links()}}</div>
                </div>

              </div>
            </div>
