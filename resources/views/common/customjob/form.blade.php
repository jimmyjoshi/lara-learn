<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', 'Name :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}
        </div>
    </div>
</div>
general<div class="box-body">
    <div class="form-group">
        {{ Form::label('age', 'Age :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('age', null, ['class' => 'form-control', 'placeholder' => 'Age', 'required' => 'required']) }}
        </div>
    </div>
</div>
general<div class="box-body">
    <div class="form-group">
        {{ Form::label('color', 'Color :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('color', null, ['class' => 'form-control', 'placeholder' => 'Color', 'required' => 'required']) }}
        </div>
    </div>
</div>
general