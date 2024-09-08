@extends('admin.layouts.admin')

@section('title', __('views.admin.purchase_invoices.show.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('views.admin.purchase_invoices.show.title') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <th>{{ __('views.admin.purchase_invoices.show.purchase_order') }}</th>
                                <td>{{ $purchaseInvoice->purchaseOrder->id }} - {{ $purchaseInvoice->purchaseOrder->supplier->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.purchase_invoices.show.invoice_date') }}</th>
                                <td>{{ $purchaseInvoice->invoice_date->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.purchase_invoices.show.total_amount') }}</th>
                                <td>{{ number_format($purchaseInvoice->total_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.purchase_invoices.show.created_at') }}</th>
                                <td>{{ $purchaseInvoice->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.purchase_invoices.show.updated_at') }}</th>
                                <td>{{ $purchaseInvoice->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('admin.purchase.invoice') }}" class="btn btn-primary">{{ __('views.admin.purchase_invoices.show.back') }}</a>
                    <a href="{{ route('admin.purchase.invoice.edit', $purchaseInvoice->id) }}" class="btn btn-warning">{{ __('views.admin.purchase_invoices.show.edit') }}</a>
                    <form action="{{ route('admin.purchase.invoice.destroy', $purchaseInvoice->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('views.admin.purchase_invoices.show.delete_confirm') }}')">
                            {{ __('views.admin.purchase_invoices.show.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
