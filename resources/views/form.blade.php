<form id="photo-form" method="post" enctype="multipart/form-data">
    <div class="form-inputs">
        <div class="form-group">
            <label for="photo-name">Name of the photo</label>
            <input type="text" class="form-control" name="photo-name" id="photo-name" placeholder="Name of the photo">
        </div>
        <div class="form-group">
            <label for="photo-file">Photo</label>
            <input type="file" name="photo-file" id="photo-file">
            <p class="help-block">Please use JPG or PNG files only.</p>
        </div>
        <button type="submit" class="btn btn-default">Add</button>
    </div>
    <div class="form-loading">
        <h2>Loading ...</h2>
    </div>
</form>


