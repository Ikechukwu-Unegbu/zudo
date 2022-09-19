
<div class="modal fade" id="new-channel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">New Channel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('panel.channel.create')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="" class="form-label">Channel Name:</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Pick Agent</label>
                <!-- <label for="exampleFormControlSelect1">Example select</label> -->
                <select class="form-control" agent id="exampleFormControlSelect1">
                    <option value="">Pick Agent</option>
                    @foreach($agents as $agent)
                    <option value="{{$agent->id}}">{{$agent->name}}</option>
                    @endforeach
                </select>

            </div>  
            <div class="form-group">
                <label for="" class="form-label">
                    Channel Description:
                </label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <!-- <label for="" class="form-label"></label> -->
                <button style="float: right;" class="btn btn-sm btn-primary">Create</button>
            </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
    </div>
  </div>
</div>