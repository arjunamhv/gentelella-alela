@extends('admin.layouts.admin')

@section('title', __('views.admin.sales_orders.show.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('views.admin.sales_orders.show.title') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <th>{{ __('views.admin.sales_orders.show.customer') }}</th>
                                <td>{{ $salesOrder->customer->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.sales_orders.show.order_date') }}</th>
                                <td>{{ $salesOrder->order_date->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.sales_orders.show.total_amount') }}</th>
                                <td>{{ number_format($salesOrder->total_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.sales_orders.show.status') }}</th>
                                <td>{{ $salesOrder->status }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.sales_orders.show.created_at') }}</th>
                                <td>{{ $salesOrder->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.sales_orders.show.updated_at') }}</th>
                                <td>{{ $salesOrder->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('admin.sales.orders') }}" class="btn btn-primary">{{ __('views.admin.sales_orders.show.back') }}</a>
                    <a href="{{ route('admin.sales.orders.edit', $salesOrder->id) }}" class="btn btn-warning">{{ __('views.admin.sales_orders.show.edit') }}</a>
                    <form action="{{ route('admin.sales.orders.destroy', $salesOrder->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('views.admin.sales_orders.show.delete_confirm') }}')">
                            {{ __('views.admin.sales_orders.show.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
