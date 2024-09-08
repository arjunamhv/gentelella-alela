@extends('admin.layouts.admin')

@section('title', __('views.admin.receivings.show.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('views.admin.receivings.show.title') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <th>{{ __('views.admin.receivings.show.purchase_order_id') }}</th>
                                <td>{{ $receiving->purchase_order_id }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.receivings.show.receiving_date') }}</th>
                                <td>{{ $receiving->receiving_date->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.receivings.show.quantity_received') }}</th>
                                <td>{{ number_format($receiving->quantity_received) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.receivings.show.created_at') }}</th>
                                <td>{{ $receiving->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.receivings.show.updated_at') }}</th>
                                <td>{{ $receiving->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('admin.purchase.receiving') }}" class="btn btn-primary">{{ __('views.admin.receivings.show.back') }}</a>
                    <a href="{{ route('admin.purchase.receiving.edit', $receiving->id) }}" class="btn btn-warning">{{ __('views.admin.receivings.show.edit') }}</a>
                    <form action="{{ route('admin.purchase.receiving.destroy', $receiving->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('views.admin.receivings.show.delete_confirm') }}')">
                            {{ __('views.admin.receivings.show.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
