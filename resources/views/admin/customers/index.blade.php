@extends('admin.layouts.admin')

@section('title', __('views.admin.customers.index.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-rounded">
                {{ __('views.admin.customers.index.add') }}
            </a>
        </div>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('views.admin.customers.index.table_header_name') }}</th>
                    <th>{{ __('views.admin.customers.index.table_header_email') }}</th>
                    <th>{{ __('views.admin.customers.index.table_header_phone') }}</th>
                    <th>{{ __('views.admin.customers.index.table_header_address') }}</th>
                    <th>{{ __('views.admin.customers.index.table_header_created_at') }}</th>
                    <th>{{ __('views.admin.customers.index.table_header_updated_at') }}</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $customer->updated_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.customers.show', $customer->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.customers.index.show') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.customers.edit', $customer->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.customers.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.customers.index.delete') }}" onclick="return confirm('{{ __('views.admin.customers.index.delete_confirm') }}')">
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
