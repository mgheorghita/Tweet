<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close cleanOnClose" data-dismiss="modal">
                   <span aria-hidden="true">&times;</span>
                   <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                 Add Tweet
                </h4>
            </div>
            <div class="modal-body">
                <form id="tweetForm" method="POST" action="main">
                    <div class="form-group">
                        <label>Tweet Content</label>
                        <textarea  maxlength="140" name="tweetContent" class="form-control" id="tweetContent" rows="3"></textarea>
                        <label id="tweetContent_error" hidden>Content is empty</label> </br>
                        <label id="tweetContentLimit_error">Character limit is 140</label>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label>Image</label>-->
<!--                        <input type="file" class="form-control" id="imageFile" placeholder="Select Image"/>-->
<!--                    </div>-->
                </form>
            </div>
            <div class="modal-footer">
                <button id="tweetSubmit" value="submit" class="btn btn-primary" data-dismiss="modal">Add</button>
                <button type="button" class="btn btn-primary cleanOnClose" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>