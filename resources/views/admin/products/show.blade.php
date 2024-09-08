@extends('admin.layouts.admin')

@section('title', __('views.admin.products.show.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('views.admin.products.show.title') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <th>{{ __('views.admin.products.show.name') }}</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.products.show.price') }}</th>
                                <td>{{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.products.show.description') }}</th>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.products.show.stock') }}</th>
                                <td>{{ $product->stock }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.products.show.supplier') }}</th>
                                <td>{{ $product->supplier ? $product->supplier->name : __('views.admin.products.show.no_supplier') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.products.show.created_at') }}</th>
                                <td>{{ $product->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('views.admin.products.show.updated_at') }}</th>
                                <td>{{ $product->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('admin.products') }}" class="btn btn-primary">{{ __('views.admin.products.show.back') }}</a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">{{ __('views.admin.products.show.edit') }}</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('views.admin.products.show.delete_confirm') }}')">
                            {{ __('views.admin.products.show.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
