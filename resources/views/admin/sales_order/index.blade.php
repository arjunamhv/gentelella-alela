@extends('admin.layouts.admin')

@section('title', __('views.admin.sales_orders.index.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.sales.orders.create') }}" class="btn btn-primary btn-rounded">
                {{ __('views.admin.sales_orders.index.create') }}
            </a>
        </div>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('views.admin.sales_orders.index.table_header_id') }}</th>
                    <th>{{ __('views.admin.sales_orders.index.table_header_customer') }}</th>
                    <th>{{ __('views.admin.sales_orders.index.table_header_products') }}</th>
                    <th>{{ __('views.admin.sales_orders.index.table_header_quantity') }}</th>
                    <th>{{ __('views.admin.sales_orders.index.table_header_order_date') }}</th>
                    <th>{{ __('views.admin.sales_orders.index.table_header_total_amount') }}</th>
                    <th>{{ __('views.admin.sales_orders.index.table_header_status') }}</th>
                    <th>{{ __('views.admin.sales_orders.index.table_header_actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesOrders as $salesOrder)
                    <tr>
                        <td>{{ $salesOrder->id }}</td>
                        <td>{{ $salesOrder->customer->name }}</td>
                        <td>{{ $salesOrder->product->name }}</td>
                        <td>{{ $salesOrder->quantity }}</td>
                        <td>{{ $salesOrder->order_date->format('d-m-Y') }}</td>
                        <td>{{ number_format($salesOrder->total_amount, 2) }}</td>
                        <td>{{ ucfirst($salesOrder->status) }}</td>
                        <td>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.sales.orders.show', $salesOrder->id) }}"
                                data-toggle="tooltip" data-placement="top"
                                data-title="{{ __('views.admin.sales_orders.index.view') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-warning"
                                href="{{ route('admin.sales.orders.edit', $salesOrder->id) }}" data-toggle="tooltip"
                                data-placement="top" data-title="{{ __('views.admin.sales_orders.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.sales.orders.destroy', $salesOrder->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip"
                                    data-placement="top" data-title="{{ __('views.admin.sales_orders.index.delete') }}"
                                    onclick="return confirm('{{ __('views.admin.sales_orders.index.delete_confirm') }}')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
