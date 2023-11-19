@extends('layouts.app')

@section('title', 'Contacts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
            {!! Form::select('choose_contact', $list_contact, $contact->id, ['class' => 'form-select w-100', 'id'=> 'choose-contact', 'placehoder' => 'Contact']) !!}
        </div>

        <div class="clearfix"><br /></div>

        <div class="col-md-7 col-lg-7 col-xl-7 mb-3">
            <div class="text-center w-100">
                <h1 class="">
                    <b>
                        @empty($contact->prefix)
                            {{ $contact->prefix }}.
                        @endempty
                        {{ $contact->name }}
                    </b>
                </h1>
            </div>
            <div class="d-flex flex-row bd-highlight mb-3">
                <h5 class="w-100 text-center"><b>CID: {{ $contact->cid }}</b></h5>
            </div>
            <div class="d-flex flex-row bd-highlight mb-3">
                <p class="w-50"><b>Email:</b> {{ $contact->email }}</p>
                <p class="w-50"><b>Phone:</b>{{ $contact->phone }}</p>
            </div>
            <div class="d-flex flex-row bd-highlight mb-3">
                <p><b>Address:</b>{{ $contact->address }}</p>
            </div>

            <div class="d-flex flex-row bd-highlight mb-3">
                <p class="w-50"><b>Status:</b>{{ $contact->status }}</p>
                <p class="w-50"><b>Type:</b>{{ $contact->type }}</p>
                <p class="w-50"><b>Rank:</b>{{ $contact->rank }}</p>
            </div>
        </div>

        <div class="col-md-5 col-lg-5 col-xl-5 mb-4">
            {{-- <img src="{{ $contact->photo }}" alt="img {{ $contact->cid }}" /> --}}
            <img src="https://d1hjkbq40fs2x4.cloudfront.net/2017-08-21/files/landscape-photography_1645.jpg" class="img-thumbnail" alt="img {{ $contact->cid }}" />
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#choose-contact', function() {
            var contact_id = $('#choose-contact').val();

            console.log(contact_id);

            $.ajax({
                method: "GET",
                dataType: "json",
                // url: "/contacts/" . contact_id,
                url: '{{ route("contact.show", '. contact_id .') }}',
                success: function(response){
                    console.log(response);
                },
            });
        });
    });
</script>
@endpush
