<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', 'Name :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('age', 'Age :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('age', null, ['class' => 'form-control', 'placeholder' => 'Age', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('bdate', 'Bdate :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('bdate', null, ['class' => 'form-control', 'placeholder' => 'Bdate', 'required' => 'required']) }}
        </div>
    </div>
</div>