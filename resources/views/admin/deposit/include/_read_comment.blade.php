
<!-- Modal -->
<div class="modal fade" id="read-{{$trx->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" id="modal-backg">
    <div  class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Comment by {{$trx->agent->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="background-color: #eef2f5;" class="modal-body">
        <div>
            @foreach($trx->comment as $comment)
            <div class="container justify-content-center mt-5 border-left border-right">
                <div class="d-flex justify-content-center py-2">
                    <div class="second py-2 px-2"> <span class="text1">{{$comment->comment}}</span>
                        <div class="d-flex justify-content-between py-1 pt-2">
                            <div><img src="https://i.imgur.com/tPvlEdq.jpg" width="18"><span class="text2">By: {{$comment->user->name}}</span></div>
                            <!-- <div><span class="text3">Upvote?</span><span class="thumbup"><i class="fa fa-thumbs-o-up"></i></span><span class="text4">3</span></div> -->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>
</div>