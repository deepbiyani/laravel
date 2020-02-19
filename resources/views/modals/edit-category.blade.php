<div class="modal" tabindex="-1" role="dialog" id="editCategoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="POST">
                {{ csrf_field()  }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" value="" placeholder="Category Name" required>
                    </div>
                    <div class="form-group">
                        <select id="edit-parent-dropdown" class="form-control" name="parent_id">
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

    </div>
</div>
