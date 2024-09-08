@extends('admin.layouts.admin')

@section('title', __('views.admin.receivings.index.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.purchase.receiving.create') }}" class="btn btn-primary btn-rounded">
                {{ __('views.admin.receivings.index.create') }}
            </a>
        </div>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('views.admin.receivings.index.table_header_id') }}</th>
                    <th>{{ __('views.admin.receivings.index.table_header_purchase_order_id') }}</th>
                    <th>{{ __('views.admin.receivings.index.table_header_receiving_date') }}</th>
                    <th>{{ __('views.admin.receivings.index.table_header_quantity_received') }}</th>
                    <th>{{ __('views.admin.receivings.index.table_header_actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($receivings as $receiving)
                    <tr>
                        <td>{{ $receiving->id }}</td>
                        <td>{{ $receiving->purchase_order_id }}</td>
                        <td>{{ $receiving->receiving_date->format('d-m-Y') }}</td>
                        <td>{{ $receiving->quantity_received }}</td>
                        <td>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.purchase.receiving.show', $receiving->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.receivings.index.view') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.purchase.receiving.edit', $receiving->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.receivings.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.purchase.receiving.destroy', $receiving->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.receivings.index.delete') }}" onclick="return confirm('{{ __('views.admin.receivings.index.delete_confirm') }}')">
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
