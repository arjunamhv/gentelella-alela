@extends('admin.layouts.admin')

@section('title', __('Sales Invoices'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('Sales Invoices') }}</h3>
                </div>
                <div class="panel-body">
                    <a href="{{ route('admin.sales.invoices.create') }}" class="btn btn-primary">{{ __('Create Invoice') }}</a>
                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sales Order ID</th>
                                <th>Invoice Date</th>
                                <th>Total Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->sales_order_id }}</td>
                                    <td>{{ $invoice->invoice_date->format('d-m-Y') }}</td>
                                    <td>{{ $invoice->total_amount }}</td>
                                    <td>
                                        <a href="{{ route('admin.sales.invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">{{ __('View') }}</a>
                                        <a href="{{ route('admin.sales.invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                                        <form action="{{ route('admin.sales.invoices.destroy', $invoice->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure you want to delete this item?') }}')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
