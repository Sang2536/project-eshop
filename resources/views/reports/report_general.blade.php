{{-- User --}}
@can('admnisrator')
    <div class="row">
        <h5>User Admin</h5>

        <div class="col-md-3 col-lg-3 col-xl-3 bg-info">
            All user
        </div>

        <div class="col-md-3 col-lg-3 col-xl-3 bg-danger">
            Admin user
        </div>

        <div class="col-md-3 col-lg-3 col-xl-3 bg-info">
            Staff user
        </div>

        <div class="clearfix"><br /></div>
    </div>
@endcan

{{-- Contact --}}
<div class="row">
    <h3>Contact</h3>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-info border rounded-3">
        <h5 class="mt-2"><b>Total</b></h5>
        <hr />
        <p> Created {{ $contacts['all_quantity'] }} unit</p>

        <a href="{{ route('contacts.index') }}" class="float-end link-danger"><i class="fa-solid fa-arrow-right"></i> More detail...</a>
    </div>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-danger border rounded-3">
        <h5 class="mt-2"><b>Status</b></h5>
        <hr />
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4">
                <p>Active: {{ $contacts['status']['active'] }}</p>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 border-start border-3 border-dark">
                <p>Inactive: {{ $contacts['status']['inactive'] }}</p>
            </div><div class="col-md-4 col-lg-4 col-xl-4 border-start border-3 border-dark">
                <p>Blocked: {{ $contacts['status']['blocked'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-danger border rounded-3">
        <h5 class="mt-2"><b>Type</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-danger border rounded-3">
        <h5 class="mt-2"><b>Rank</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="clearfix"><br /></div>
</div>

{{-- Category --}}
<div class="row">
    <h3>Category</h3>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-info border rounded-3">
        <h5 class="mt-2"><b>Total</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-danger border rounded-3">
        <h5 class="mt-2"><b>Type</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="clearfix"><br /></div>
</div>

{{-- Unit --}}
<div class="row">
    <h3>Unit</h3>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-info border rounded-3">
        <h5 class="mt-2"><b>Total</b></h5>
        <hr />
        <p> Created {{ $units['all_quantity'] }} unit</p>

        <a href="{{ route('units.index') }}" class="float-end link-danger"><i class="fa-solid fa-arrow-right"></i> More detail...</a>
    </div>

    <div class="clearfix"><br /></div>
</div>

{{-- Product --}}
<div class="row">
    <h3>Product</h3>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-info border rounded-3">
        <h5 class="mt-2"><b>All Product</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-danger border rounded-3">
        <h5 class="mt-2"><b>Type</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-danger border rounded-3">
        <h5 class="mt-2"><b>Thu chi</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="clearfix"><br /></div>
</div>

{{-- Invoice Discount --}}
<div class="row">
    <h3>Invoice Discount</h3>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-info border rounded-3">
        <h5 class="mt-2"><b>All Discount</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-danger border rounded-3">
        <h5 class="mt-2"><b>Type</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="col-md-3 col-lg-3 col-xl-3 bg-danger border rounded-3">
        <h5 class="mt-2"><b>Total Quantity</b></h5>
        <hr />
        <div class="row">
            ...
        </div>
    </div>

    <div class="clearfix"><br /></div>
</div>
