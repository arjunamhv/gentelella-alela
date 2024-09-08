@extends('admin.layouts.admin')

@section('title', __('Create Sales Invoice'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'admin.sales.invoices.store', 'method' => 'post', 'class' => 'form-horizontal form-label-left']) }}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_order_id">
                        {{ __('Sales Order ID') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('sales_order_id', $salesOrders, null, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'sales_order_id', 'required']) }}
                        @if($errors->has('sales_order_id'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('sales_order_id') as $error)
                                    <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="invoice_date">
                        {{ __('Invoice Date') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="invoice_date" type="date" class="form-control col-md-7 col-xs-12 @if($errors->has('invoice_date')) parsley-error @endif"
                               name="invoice_date" value="{{ old('invoice_date') }}" required>
                        @if($errors->has('invoice_date'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('invoice_date') as $error)
                                    <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_amount">
                        {{ __('Total Amount') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="total_amount" type="number" step="0.01" class="form-control col-md-7 col-xs-12 @if($errors->has('total_amount')) parsley-error @endif"
                               name="total_amount" value="{{ old('total_amount') }}" required>
                        @if($errors->has('total_amount'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('total_amount') as $error)
                                    <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a class="btn btn-primary" href="{{ route('admin.sales.invoices') }}">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
