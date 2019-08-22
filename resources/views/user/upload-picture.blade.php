<div class="modal fade" id="uploadPicture" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Staff Picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('upload.picture', $user->id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="col-md-5">
                            <img id="preview" height="200px" width="200px" />
                        </div>
                        <label for="recipient-name" class="col-form-label">Picture FIle:</label>
                        <input type="file" class="form-control" id="picture" name="image" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span>
                            Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>