<div class="box-body">
    <div class="form-group">
        {{ Form::label('subscriber_id', 'Subscriber Id :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('subscriber_id', null, ['class' => 'form-control', 'placeholder' => 'Subscriber Id', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('subject', 'Subject :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Subject', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('body', 'Body :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('body', null, ['class' => 'form-control', 'placeholder' => 'Body', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('created_at', 'Created At :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('created_at', null, ['class' => 'form-control', 'placeholder' => 'Created At', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('updated_at', 'Updated At :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('updated_at', null, ['class' => 'form-control', 'placeholder' => 'Updated At', 'required' => 'required']) }}
        </div>
    </div>
</div>