@extends('admin.layouts.admin')

@section('title', __('views.admin.products.index.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-rounded">
                {{ __('views.admin.products.index.add') }}
            </a>
        </div>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>{{ __('views.admin.products.index.table_header_name') }}</th>
                <th>{{ __('views.admin.products.index.table_header_price') }}</th>
                <th>{{ __('views.admin.products.index.table_header_description') }}</th>
                <th>{{ __('views.admin.products.index.table_header_stock') }}</th>
                <th>{{ __('views.admin.products.index.table_header_created_at') }}</th>
                <th>{{ __('views.admin.products.index.table_header_updated_at') }}</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $product->updated_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.products.show', $product->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.products.index.show') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-xs btn-info" href="{{ route('admin.products.edit', $product->id) }}" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.products.index.edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.products.index.delete') }}" onclick="return confirm('{{ __('views.admin.products.index.delete_confirm') }}')">
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
