<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $product->name }} ({{ $product->sku }})</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-9 col-lg-9 col-xl-9">
                    <p><b>Created By: </b>{{ $product->created_by }}</p>
                    <p><b>category: </b>{{ $product->category_id }}</p>
                    <p><b>Quantity: </b>{{ $product->quantity }} {{ $product->unit_id }}</p>
                    <p><b>Price Buy: </b>{{ $product->price_buy }}<i class="fa-solid fa-dong-sign"></i></p>
                    <p><b>Price Sale: </b>{{ $product->price_sale }}<i class="fa-solid fa-dong-sign"></i></p>
                    <p><b>Description: </b>{{ $product->short_description }}</p>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3">
                    <img src="{{ $product->photo }}" class="rounded mx-auto d-block" alt="img {{ $product->sku }}" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
