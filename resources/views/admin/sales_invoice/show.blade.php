@extends('admin.layouts.admin')

@section('title', __('Sales Invoice Details'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('Sales Invoice Details') }}</h3>
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>{{ __('Sales Order ID') }}</dt>
                        <dd>{{ $salesInvoice->sales_order_id }}</dd>

                        <dt>{{ __('Invoice Date') }}</dt>
                        <dd>{{ $salesInvoice->invoice_date->format('d-m-Y') }}</dd>

                        <dt>{{ __('Total Amount') }}</dt>
                        <dd>{{ $salesInvoice->total_amount }}</dd>

                        <dt>{{ __('Created At') }}</dt>
                        <dd>{{ $salesInvoice->created_at }}</dd>

                        <dt>{{ __('Updated At') }}</dt>
                        <dd>{{ $salesInvoice->updated_at }}</dd>
                    </dl>
                    <a href="{{ route('admin.sales.invoices') }}" class="btn btn-primary">{{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
