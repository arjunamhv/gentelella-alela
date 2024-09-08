@extends('admin.layouts.admin')

@section('title', __('views.admin.purchase_invoices.edit.title'))

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::model($purchaseInvoice, ['route' => ['admin.purchase.invoice.update', $purchaseInvoice->id], 'method' => 'put', 'class' => 'form-horizontal form-label-left']) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="purchase_order_id">
                    {{ __('views.admin.purchase_invoices.edit.purchase_order') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{ Form::select(
                        'purchase_order_id',
                        $purchaseOrders,
                        old('purchase_order_id', $purchaseInvoice->purchase_order_id),
                        [
                            'id' => 'purchase_order_id',
                            'class' => 'form-control col-md-7 col-xs-12' . ($errors->has('purchase_order_id') ? ' parsley-error' : ''),
                            'placeholder' => __('views.admin.purchase_invoices.edit.select_purchase_order'),
                            'required',
                        ],
                    ) }}
                    @if ($errors->has('purchase_order_id'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('purchase_order_id') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="invoice_date">
                    {{ __('views.admin.purchase_invoices.edit.invoice_date') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="invoice_date" type="date"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('invoice_date')) parsley-error @endif"
                        name="invoice_date"
                        value="{{ old('invoice_date', $purchaseInvoice->invoice_date->format('Y-m-d')) }}" required>
                    @if ($errors->has('invoice_date'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('invoice_date') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_amount">
                    {{ __('views.admin.purchase_invoices.edit.total_amount') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="total_amount" type="number" step="0.01"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('total_amount')) parsley-error @endif"
                        name="total_amount" value="{{ old('total_amount', $purchaseInvoice->total_amount) }}" required>
                    @if ($errors->has('total_amount'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('total_amount') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="{{ route('admin.purchase.invoice') }}">
                        {{ __('views.admin.purchase_invoices.edit.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        {{ __('views.admin.purchase_invoices.edit.save') }}
                    </button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
