<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {!! Form::open(['url' => route('categories.store'), 'method' => 'POST', 'id' => 'unit-create-form', 'class' => 'mx-1 mx-md-4']) !!}
            <div class="modal-header">
                <h4 class="modal-title">Add Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div><!-- /.modal-header -->

            <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-6 col-xl-6 mb-6">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Name']) !!}
                        </div>

                        <div class="col-lg-6 col-xl-6 mb-6">
                            {!! Form::label('parent_id', 'Parent category') !!}
                            {!! Form::select('parent_id', $parent_category, null, ['class' => 'form-select w-100', 'placehoder' => 'Parent category']) !!}
                        </div>

                        <div class="col-lg-6 col-xl-6 mb-6">
                            {!! Form::label('type', 'Type') !!}
                            {!! Form::select('type', ['product' => 'Product', 'gift' => 'Gift', 'other' => 'Other'], 'product', ['class' => 'form-select w-100', 'required', 'placehoder' => 'Type']) !!}
                        </div>

                        <div class="clearfix"><br /></div>

                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                {!! Form::label('description', 'Description') !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control w-100', 'placehoder' => 'Descripton']) !!}
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.modal-body -->

            <div class="modal-footer">
                {!! Form::submit('Add', ['id' => 'category-create-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
                <button type="button" class="btn btn-secondary btn-block bg-secondary mb-3" data-dismiss="modal">Close</button>
            </div><!-- /.modal-footer -->
        {!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
