@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Create - '. $repository->moduleTitle : 'Create')

@section('page-header')
    <h1>
        {{ isset($repository->moduleTitle) ? $repository->moduleTitle : '' }}
        <small>Create</small>
    </h1>
@endsection

@section('content')
    {{ Form::open([
        'route'     => $repository->getActionRoute('uploadSaveRoute'),
        'class'     => 'form-horizontal',
        'role'      => 'form',
        'files'     => true,
        'method'    => 'post'
    ])}}

        <div class="box box-success">
            <div class="box-header with-border">

                <h3 class="box-title">Create {{ isset($repository->moduleTitle) ? $repository->moduleTitle : '' }}</h3>

                <div class="box-tools pull-right">
                    @include('common.'.strtolower($repository->moduleTitle).'.header-buttons', [
                        'listRoute'     => $repository->getActionRoute('listRoute'),
                        'createRoute'   => $repository->getActionRoute('createRoute')
                    ])
                </div>
            </div>

            {{-- Event Form --}}
            <div class="form-group">
                {{ Form::label('csv', 'Upload CSV :', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::file('csv',  ['class' => 'form-control', 'required']) }}
                </div>
            </div>

        </div>

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route($repository->getActionRoute('listRoute'), 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
                </div>

                <div class="pull-right">
                    {{ Form::submit('Create', ['class' => 'btn btn-success btn-xs']) }}
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    {{ Form::close() }}
@endsection
