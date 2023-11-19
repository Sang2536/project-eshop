<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $invoice_discount->name }} - {{ $invoice_discount->code }}</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-4">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <h5><b>Info discount</b></h5>
                    <p><b>Created By:</b> {{ $invoice_discount->created_by }}</p>
                    <p><b>Type:</b> {{ $invoice_discount->type }}</p>
                    @if ($invoice_discount->type == 'fixed')
                        <p><b>Value:</b> {{ $invoice_discount->value }}<i class="fa-solid fa-dong-sign"></i></p>
                        <p><b>Value limit:</b> {{ $invoice_discount->rule_value }}<i class="fa-solid fa-dong-sign"></i></p>
                    @elseif ($invoice_discount->type == 'percent')
                        <p><b>Value:</b> {{ $invoice_discount->value }}%</p>
                        <p><b>Value limit:</b> {{ $invoice_discount->rule_value }}<i class="fa-solid fa-dong-sign"></i></p>
                    @elseif ($invoice_discount->type == 'gift')
                        <p><b>Value:</b> {{ $invoice_discount->value }}</p>
                        <p><b>Value limit:</b> {{ $invoice_discount->rule_value }}</p>
                    @endif
                    <p><b>Total quantity:</b> {{ $invoice_discount->quantity }}</p>
                    <p><b>The remaining amount:</b> {{ $invoice_discount->quantity }}</p>
                    <p><b>Start date:</b> {{ $invoice_discount->start_date }}</p>
                    <p><b>End date:</b> {{ $invoice_discount->end_date }}</p>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <h5><b>Conditions apply</b></h5>
                    <p><b>Contact rank:</b> {{ $invoice_discount->group_contact_id }}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
