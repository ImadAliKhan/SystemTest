@extends('layouts.admin')

@section('content')

<div class="well">
 
  {!! Form::open(['method'=>'POST','action'=>'AdminIncomeExpenseController@store','files'=>true]) !!}
 
    <fieldset>


        @if(Session::has('create_entry'))

      <div id="message-success" class="message message-success">
        <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{Session('create_entry')}}
        </div>
      <div class="dismiss">
      <a href="#message-success"></a>
      </div>
      </div>

        @endif

        <div class="row">
        
        @include('form_error')

        </div>

        <legend>Create Entry</legend>
        
        
  
        <div class="form-group row">
            {!! Form::label('name', 'Name:', ['class' => 'col-lg-2 control-label required']) !!}

            <div class="col-lg-4 row">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}

            </div>
        </div>

         <div class="form-group row">
            {!! Form::label('date', 'Date:', ['class' => 'col-lg-2 control-label required']) !!}
            <div class="col-lg-4 row">
              
                {!! Form::text('date', date('d-m-yy'), ['class' => 'form-control']) !!}

            </div>
        </div>
       
        <div class="form-group row">
            {!! Form::label('description', 'Details', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-4 row">
                {!! Form::textarea('description',null, ['class' => 'form-control', 'rows' => 3]) !!}
             
            </div>
        </div>
 
    
        <div class="form-group row">
            {!! Form::label('revenue_type', 'Revenue Type', ['class' => 'col-lg-2 control-label required'] )  !!}
            <div class="col-lg-4 row">
                {!!  Form::select('revenue_type_id', [''=>'Select Type']+$revenue_type_id,null, ['class' => 'form-control' ]) !!}
            </div>
        </div>

       <div class="form-group row">
            {!! Form::label('amount', 'Amount:', ['class' => 'col-lg-2 control-label required']) !!}
            <div class="col-lg-4 row">
                {!! Form::text('amount', null, ['class' => 'form-control']) !!}

            </div>
        </div>
 
       
        <div class="form-group row">
            <div class="col-lg-4 col-lg-offset-2">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary'] ) !!}
            </div>
        </div>
 
    </fieldset>
 
    {!! Form::close()  !!}
 
</div>



   

@endsection

@section('styles')

<style>
    .required:after{ 
        content:'*'; 
        color:red; 
        padding-left:5px;
    }
</style>
@stop

@section('scripts')



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); 
        date_input.datepicker({
            format: 'dd-mm-yyyy',        
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>

@stop