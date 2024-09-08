@extends('admin.layouts.admin')

@section('title', __('views.admin.purchase_invoices.index.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.purchase.invoice.create') }}" class="btn btn-primary btn-rounded">
                {{ __('views.admin.purchase_invoices.index.create') }}
            </a>
        </div>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('views.admin.purchase_invoices.index.table_header_id') }}</th>
                    <th>{{ __('views.admin.purchase_invoices.index.table_header_purchase_order') }}</th>
                    <th>{{ __('views.admin.purchase_invoices.index.table_header_invoice_date') }}</th>
                    <th>{{ __('views.admin.purchase_invoices.index.table_header_total_amount') }}</th>
                    <th>{{ __('views.admin.purchase_invoices.index.table_header_actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchaseInvoices as $purchaseInvoice)
                    <tr>
                        <td>{{ $purchaseInvoice->id }}</td>
                        <td>{{ $purchaseInvoice->purchaseOrder->id }}</td>
                        <td>{{ $purchaseInvoice->invoice_date->format('d-m-Y') }}</td>
                        <td>{{ number_format($purchaseInvoice->total_amount, 2) }}</td>
                        <td>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.purchase.invoice.show', $purchaseInvoice->id) }}" data-toggle="tooltip" data-placement="top" title="{{ __('views.admin.purchase_invoices.index.view') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.purchase.invoice.edit', $purchaseInvoice->id) }}" data-toggle="tooltip" data-placement="top" title="{{ __('views.admin.purchase_invoices.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.purchase.invoice.destroy', $purchaseInvoice->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="{{ __('views.admin.purchase_invoices.index.delete') }}" onclick="return confirm('{{ __('views.admin.purchase_invoices.index.delete_confirm') }}')">
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
