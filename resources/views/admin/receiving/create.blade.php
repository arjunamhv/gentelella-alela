@extends('admin.layouts.admin')

@section('title', 'Create Receiving')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route' => 'admin.purchase.receiving.store', 'class' => 'form-horizontal form-label-left']) }}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="purchase_order_id">
                        Purchase Order ID
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('purchase_order_id', $purchaseOrders, null, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'purchase_order_id', 'required']) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="receiving_date">
                        Receiving Date
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="receiving_date" type="date" class="form-control col-md-7 col-xs-12" name="receiving_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity_received">
                        Quantity Received
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="quantity_received" type="number" class="form-control col-md-7 col-xs-12" name="quantity_received" required min="1">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a class="btn btn-primary" href="{{ route('admin.purchase.receiving') }}">Cancel</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
