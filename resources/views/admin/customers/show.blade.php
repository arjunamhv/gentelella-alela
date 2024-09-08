@extends('admin.layouts.admin')

@section('title', __('views.admin.customers.show.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('views.admin.customers.show.title') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <th>{{ __('views.admin.customers.show.name') }}</th>
                                <td>{{ $customer->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.customers.show.email') }}</th>
                                <td>{{ $customer->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.customers.show.phone') }}</th>
                                <td>{{ $customer->phone }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.customers.show.address') }}</th>
                                <td>{{ $customer->address }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.customers.show.created_at') }}</th>
                                <td>{{ $customer->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.customers.show.updated_at') }}</th>
                                <td>{{ $customer->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('admin.customers') }}" class="btn btn-primary">{{ __('views.admin.customers.show.back') }}</a>
                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-warning">{{ __('views.admin.customers.show.edit') }}</a>
                    <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('views.admin.customers.show.delete_confirm') }}')">
                            {{ __('views.admin.customers.show.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
