@extends('admin.layouts.admin')

@section('title', __('views.admin.suppliers.show.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('views.admin.suppliers.show.title') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <th>{{ __('views.admin.suppliers.show.name') }}</th>
                                <td>{{ $supplier->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.suppliers.show.email') }}</th>
                                <td>{{ $supplier->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.suppliers.show.phone') }}</th>
                                <td>{{ $supplier->phone }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.suppliers.show.address') }}</th>
                                <td>{{ $supplier->address }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.suppliers.show.created_at') }}</th>
                                <td>{{ $supplier->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.suppliers.show.updated_at') }}</th>
                                <td>{{ $supplier->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('admin.suppliers') }}" class="btn btn-primary">{{ __('views.admin.suppliers.show.back') }}</a>
                    <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="btn btn-warning">{{ __('views.admin.suppliers.show.edit') }}</a>
                    <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('views.admin.suppliers.show.delete_confirm') }}')">
                            {{ __('views.admin.suppliers.show.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
