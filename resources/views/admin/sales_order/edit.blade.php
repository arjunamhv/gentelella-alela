@extends('admin.layouts.admin')

@section('title', __('views.admin.sales_orders.edit.title', ['id' => $salesOrder->id]))

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route' => ['admin.sales.orders.update', $salesOrder->id], 'method' => 'put', 'class' => 'form-horizontal form-label-left']) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_id">
                    {{ __('views.admin.sales_orders.edit.customer') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{ Form::select('customer_id', $customers, $salesOrder->customer_id, [
                        'id' => 'customer_id',
                        'class' => 'form-control col-md-7 col-xs-12' . ($errors->has('customer_id') ? ' parsley-error' : ''),
                        'required'
                    ]) }}
                    @if ($errors->has('customer_id'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('customer_id') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_id">
                    {{ __('views.admin.sales_orders.edit.products') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{ Form::select('product_id', $products, $salesOrder->product_id, [
                        'id' => 'product_id',
                        'class' => 'form-control col-md-7 col-xs-12' . ($errors->has('product_id') ? ' parsley-error' : ''),
                        'required'
                    ]) }}
                    @if ($errors->has('product_id'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('product_id') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity">
                    {{ __('views.admin.sales_orders.edit.quantity') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="quantity" type="number" min="1"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('quantity')) parsley-error @endif"
                        name="quantity" value="{{ $salesOrder->quantity }}" required>
                    @if ($errors->has('quantity'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('quantity') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order_date">
                    {{ __('views.admin.sales_orders.edit.order_date') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="order_date" type="date"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('order_date')) parsley-error @endif"
                        name="order_date" value="{{ $salesOrder->order_date->format('Y-m-d') }}" required>
                    @if ($errors->has('order_date'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('order_date') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_amount">
                    {{ __('views.admin.sales_orders.edit.total_amount') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="total_amount" type="number" step="0.01"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('total_amount')) parsley-error @endif"
                        name="total_amount" value="{{ $salesOrder->total_amount }}" required>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                    {{ __('views.admin.sales_orders.edit.status') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{ Form::select('status', [
                        'pending' => __('views.admin.sales_orders.create.status_pending'),
                        'completed' => __('views.admin.sales_orders.create.status_completed'),
                        'canceled' => __('views.admin.sales_orders.create.status_canceled')
                    ], $salesOrder->status, [
                        'id' => 'status',
                        'class' => 'form-control col-md-7 col-xs-12' . ($errors->has('status') ? ' parsley-error' : ''),
                        'required'
                    ]) }}
                    @if ($errors->has('status'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('status') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="{{ route('admin.sales.orders') }}">
                        {{ __('views.admin.sales_orders.edit.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        {{ __('views.admin.sales_orders.edit.save') }}
                    </button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
