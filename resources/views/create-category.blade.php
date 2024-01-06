<div class="offcanvas offcanvas-start" tabindex="-1" id="categoryDetail" aria-labelledby="categoryDetailLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="categoryDetailLabel">Category Details</h5>
    </div>
    <div class="offcanvas-body">

        <form action="" id="categoryDetailsForm" method="POST">
            @csrf
            <input type="hidden" id="category_id">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="status">
                    <label class="form-check-label" for="status">Status</label>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>

    </div>
</div>
