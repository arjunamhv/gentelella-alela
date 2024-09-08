@extends('admin.layouts.admin')

@section('title', __('views.admin.purchase_orders.edit.title', ['id' => $purchaseOrder->id]))

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route' => ['admin.purchase.orders.update', $purchaseOrder->id], 'method' => 'put', 'class' => 'form-horizontal form-label-left']) }}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier_id">
                        {{ __('views.admin.purchase_orders.edit.supplier') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('supplier_id', $suppliers, $purchaseOrder->supplier_id, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'supplier_id', 'required']) }}
                        @if($errors->has('supplier_id'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('supplier_id') as $error)
                                    <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order_date">
                        {{ __('views.admin.purchase_orders.edit.order_date') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="order_date" type="date" class="form-control col-md-7 col-xs-12 @if($errors->has('order_date')) parsley-error @endif"
                               name="order_date" value="{{ $purchaseOrder->order_date->format('Y-m-d') }}" required>
                        @if($errors->has('order_date'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('order_date') as $error)
                                    <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_id">
                        {{ __('views.admin.purchase_orders.edit.product') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('product_id', $products, $purchaseOrder->product_id, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'product_id', 'required']) }}
                        @if($errors->has('product_id'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('product_id') as $error)
                                    <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity">
                        {{ __('views.admin.purchase_orders.edit.quantity') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="quantity" type="number" class="form-control col-md-7 col-xs-12 @if($errors->has('quantity')) parsley-error @endif"
                               name="quantity" value="{{ $purchaseOrder->quantity }}" min="1" required>
                        @if($errors->has('quantity'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('quantity') as $error)
                                    <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_amount">
                        {{ __('views.admin.purchase_orders.edit.total_amount') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="total_amount" type="number" step="0.01" class="form-control col-md-7 col-xs-12 @if($errors->has('total_amount')) parsley-error @endif"
                               name="total_amount" value="{{ $purchaseOrder->total_amount }}" required>
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
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                        {{ __('views.admin.purchase_orders.edit.status') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('status', $statuses, $purchaseOrder->status, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'status', 'required']) }}
                        @if($errors->has('status'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('status') as $error)
                                    <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a class="btn btn-primary" href="{{ route('admin.purchase.orders') }}">{{ __('views.admin.purchase_orders.edit.cancel') }}</a>
                        <button type="submit" class="btn btn-success">{{ __('views.admin.purchase_orders.edit.save') }}</button>
                    </div>
                </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
