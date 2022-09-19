<div class="modal fade" id="new-channel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Channel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('panel.channel.create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Channel Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>
                    {{-- <div class="form-group">
                <label for="" class="form-label">Pick Agent</label>
                <!-- <label for="exampleFormControlSelect1">Example select</label> -->
                <select class="form-control" agent id="exampleFormControlSelect1">
                    <option value="">Pick Agent</option>
                    @foreach ($agents as $agent)
                    <option value="{{$agent->id}}">{{$agent->name}}</option>
                    @endforeach
                </select>

            </div> --}}
                    <div class="form-group">
                        <label for="" class="form-label">Channel Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Phone No.</label>
                        <input type="number" name="mobile" class="form-control" value="{{ old('mobile') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">
                            Channel Description:
                        </label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
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
