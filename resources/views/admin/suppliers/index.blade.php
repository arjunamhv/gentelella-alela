@extends('admin.layouts.admin')

@section('title', __('views.admin.suppliers.index.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary btn-rounded">
                {{ __('views.admin.suppliers.index.add') }}
            </a>
        </div>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('views.admin.suppliers.index.table_header_name') }}</th>
                    <th>{{ __('views.admin.suppliers.index.table_header_email') }}</th>
                    <th>{{ __('views.admin.suppliers.index.table_header_phone') }}</th>
                    <th>{{ __('views.admin.suppliers.index.table_header_address') }}</th>
                    <th>{{ __('views.admin.suppliers.index.table_header_created_at') }}</th>
                    <th>{{ __('views.admin.suppliers.index.table_header_updated_at') }}</th>
                    <th>{{ __('views.admin.suppliers.index.table_header_actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>{{ $supplier->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $supplier->updated_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.suppliers.show', $supplier->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.suppliers.index.show') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.suppliers.edit', $supplier->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.suppliers.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.suppliers.index.delete') }}" onclick="return confirm('{{ __('views.admin.suppliers.index.delete_confirm') }}')">
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
