

<!-- Modal -->
<div class="modal fade" id="sms-seeting" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><b>SMS Switch Confirmation</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you sure about this? You are about to change the site SMS settings.</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <a href="{{route('settings.sms')}}" class="btn btn-primary btn-sm">Yes, Proceed</a>
      </div>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="e_debit-settings" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Online Debit Switch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you aware you are about to change the site WITHDRAWAL SETTINGS?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <a href="{{route('settings.debit')}}" class="btn btn-primary btn-sm">Understood, Continue</a>
      </div>
    </div>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="e_credit-settings" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">E-Credit Switch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>You are about to allow electronic contribution for everyone. Sure about that?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <a href="{{route('settings.credit')}}" class="btn btn-primary btn-sm">Understood, Continue</a>
      </div>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="user_data-settings" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">User Data Control</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You are about to alter user data access and editing privileges. Are you sure about that?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{route('settings.user_data')}}" class="btn btn-sm btn-primary">Understood, Continue</a>
      </div>
    </div>
  </div>
</div>




