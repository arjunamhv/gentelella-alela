@extends('admin.layouts.admin')

@section('title', __('views.admin.suppliers.create.title'))

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route' => 'admin.suppliers.store', 'method' => 'post', 'class' => 'form-horizontal form-label-left']) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    {{ __('views.admin.suppliers.create.name') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" type="text"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('name')) parsley-error @endif"
                        name="name" value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('name') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                    {{ __('views.admin.suppliers.create.email') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="email" type="email"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('email')) parsley-error @endif"
                        name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('email') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">
                    {{ __('views.admin.suppliers.create.phone') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="phone" type="text"
                        class="form-control col-md-7 col-xs-12 @if ($errors->has('phone')) parsley-error @endif"
                        name="phone" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('phone') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">
                    {{ __('views.admin.suppliers.create.address') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea id="address" class="form-control col-md-7 col-xs-12 @if ($errors->has('address')) parsley-error @endif"
                        name="address">{{ old('address') }}</textarea>
                    @if ($errors->has('address'))
                        <ul class="parsley-errors-list filled">
                            @foreach ($errors->get('address') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="{{ route('admin.suppliers') }}">
                        {{ __('views.admin.suppliers.create.cancel') }}</a>
                    <button type="submit" class="btn btn-success"> {{ __('views.admin.suppliers.create.save') }}</button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
