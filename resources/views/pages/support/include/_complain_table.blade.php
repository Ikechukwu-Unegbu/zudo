
<h3 class="text-center">Complains</h3>

<table class="table mt-4">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Complainant</th>
                <th scope="col">Complain ID</th>
                <th>Status</th>
                <th scope="col">Date</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               @foreach($complains as $complain)
                 <tr>
                    <th scope="row">{{$complain->id}}</th>
                    <td>{{$complain->complainant->name}}</td>
                    <td>{{$complain->number}}</td>
                    <td>
                        @if($complain->resolved == 0)
                        <i class="fa-solid fa-xmark"></i>
                        @else 
                        <i class="fa-solid fa-check"></i>
                        @endif
                    </td>
                    <td> {{\Carbon\Carbon::parse($complain['created_at'])->format('j F, Y')}}</td>
                    <th>
                        <button  data-toggle="modal" data-target="#view-{{$complain->id}}" class="btn btn-sm btn-primary">View</button>
                        <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#resolve-{{$complain->id}}">Mark As Resolved</button>
                    </th>
                </tr>
                @include('pages.support.include._complain_resolve')
                @include('pages.support.include._complain_view')
               @endforeach
            </tbody>
        </table>

        <div class="container">
            {{$complains->links()}}
        </div>