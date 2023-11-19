<div class="modal-dialog">
    <div class="modal-content">
        {{--
            C1: 'url' => ('name_url', $id)
            C@: 'route' => ['route.name', $id]
            C3: 'action' => ['AbcController@method', $id]
        --}}
        {!! Form::open(['url' => route("units.update", $unit->id), 'method' => 'PUT', 'id' => 'unit-edit-form', 'class' => 'mx-1 mx-md-4']) !!}
            <div class="modal-header">
                <h4 class="modal-title">Edit Unit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div><!-- /.modal-header -->

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6 mb-6">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $unit->name, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Name']) !!}
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 mb-6">
                        {!! Form::label('abbr', 'Abbr') !!}
                        {!! Form::text('abbr', $unit->abbr, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Abbr']) !!}
                    </div>

                    <div class="clearfix"><br /></div>

                    <div class="col-md-12 col-lg-12 col-xl-12 mb-12">
                        <div class="form-group">
                            {!! Form::label('short_description', 'Short Description') !!}
                            {!! Form::textarea('short_description', $unit->short_description, ['class' => 'form-control w-100', 'placehoder' => 'Short Descripton']) !!}
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-body -->

            <div class="modal-footer">
                {!! Form::submit('Update', ['id' => 'unit-update-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
                <button type="button" class="btn btn-secondary btn-block bg-secondary mb-3" data-dismiss="modal">Close</button>
            </div><!-- /.modal-footer -->
        {!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
