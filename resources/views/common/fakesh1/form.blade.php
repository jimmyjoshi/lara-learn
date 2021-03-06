<div class="box-body">
    <div class="form-group">
        {{ Form::label('queue', 'Queue :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('queue', null, ['class' => 'form-control', 'placeholder' => 'Queue', 'required' => 'required']) }}
        </div>
    </div>
</div>
jobs<div class="box-body">
    <div class="form-group">
        {{ Form::label('payload', 'Payload :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('payload', null, ['class' => 'form-control', 'placeholder' => 'Payload', 'required' => 'required']) }}
        </div>
    </div>
</div>
jobs<div class="box-body">
    <div class="form-group">
        {{ Form::label('attempts', 'Attempts :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('attempts', null, ['class' => 'form-control', 'placeholder' => 'Attempts', 'required' => 'required']) }}
        </div>
    </div>
</div>
jobs<div class="box-body">
    <div class="form-group">
        {{ Form::label('reserved_at', 'Reserved_at :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('reserved_at', null, ['class' => 'form-control', 'placeholder' => 'Reserved_at', 'required' => 'required']) }}
        </div>
    </div>
</div>
jobs<div class="box-body">
    <div class="form-group">
        {{ Form::label('available_at', 'Available_at :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('available_at', null, ['class' => 'form-control', 'placeholder' => 'Available_at', 'required' => 'required']) }}
        </div>
    </div>
</div>
jobs<div class="box-body">
    <div class="form-group">
        {{ Form::label('created_at', 'Created_at :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('created_at', null, ['class' => 'form-control', 'placeholder' => 'Created_at', 'required' => 'required']) }}
        </div>
    </div>
</div>
jobs