<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $category->name }} - {{ $category->code }}</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12 mb-12">
                    @empty(!$category->parent_id)
                        <p><b>Parent Category: </b>{{ $output['cate_name'] }} ({{$output['cate_code'] }})</p>
                    @endempty

                    <p><b>Type: </b>{{ $category->type }}</p>
                    <p><b>Created by: </b>{{ $output['username'] }} ({{ $output['user_uid'] }}) </p>

                    @empty(!$category->description)
                        <p><b>Desscription: </b>{{ $category->description }}</p>
                    @endempty
                </div>
            </di>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
