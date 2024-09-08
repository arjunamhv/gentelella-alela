@extends('admin.layouts.admin')

@section('title', __('views.admin.purchase_orders.create.title'))

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route' => 'admin.purchase.orders.store', 'method' => 'post', 'class' => 'form-horizontal form-label-left']) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier_id">
                    {{ __('views.admin.purchase_orders.create.supplier') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{ Form::select('supplier_id', $suppliers, old('supplier_id'), [
                        'id' => 'supplier_id',
                        'class' => 'form-control col-md-7 col-xs-12' . ($errors->has('supplier_id') ? ' parsley-error' : ''),
                        'required'
                    ]) }}
                    @if ($errors->has('supplier_id'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('supplier_id') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order_date">
                    {{ __('views.admin.purchase_orders.create.order_date') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="order_date" type="date"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('order_date')) parsley-error @endif"
                        name="order_date" value="{{ old('order_date') }}" required>
                    @if ($errors->has('order_date'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('order_date') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <!-- Produk dan Kuantitas -->
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_id">
                    {{ __('views.admin.purchase_orders.create.products') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{ Form::select('product_id', $products, old('product_id'), [
                        'id' => 'product_id',
                        'class' => 'form-control col-md-7 col-xs-12' . ($errors->has('product_id') ? ' parsley-error' : ''),
                        'placeholder' => __('views.admin.purchase_orders.create.select_product'),
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
                    {{ __('views.admin.purchase_orders.create.quantity') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="quantity" type="number" min="1"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('quantity')) parsley-error @endif"
                        name="quantity" value="{{ old('quantity') }}" required>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                    {{ __('views.admin.purchase_orders.create.status') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{ Form::select('status', [
                        'pending' => __('views.admin.purchase_orders.create.status_pending'),
                        'completed' => __('views.admin.purchase_orders.create.status_completed'),
                        'canceled' => __('views.admin.purchase_orders.create.status_canceled')
                    ], old('status'), [
                        'id' => 'status',
                        'class' => 'form-control col-md-7 col-xs-12' . ($errors->has('status') ? ' parsley-error' : '')
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
                    <a class="btn btn-primary" href="{{ route('admin.purchase.orders') }}">
                        {{ __('views.admin.purchase_orders.create.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        {{ __('views.admin.purchase_orders.create.save') }}
                    </button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
