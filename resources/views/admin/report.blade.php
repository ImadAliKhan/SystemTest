@extends('layouts.admin')

@section('content')
 <div class="row">
 <h1 class="page-header">Revenue Report</h1>
  @php
   $total_income=0;
   $total_expense=0;
  @endphp
  @if(Session::has('delete_entry'))

      <div id="message-success" class="message message-success">
        <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{Session('delete_entry')}}
        </div>
      <div class="dismiss">
      <a href="#message-success"></a>
      </div>
      </div>

        @endif
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Description</th>
        <th>Revenue Type</th>
        <th>Amount</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
         
           {!! method_field('delete') !!}
        @if(isset($revenue_entries))

        @foreach($revenue_entries as $revenue_entry)

      <tr>
        <td>{{$revenue_entry->name}}</td>
        <td>{{$revenue_entry->date}}</td>
        <td>{{$revenue_entry->description}}</td>
        <td>{{$revenue_entry->revenue_type->name}}</td>
        <td>
             <?php
              


              if($revenue_entry->revenue_type->id==1)
             {
            echo '<i class="fa fa-plus-square" aria-hidden="true"></i>';
            $total_income+=$revenue_entry->amount;
             }
            else{
            echo '<i class="fa fa-minus-square" aria-hidden="true"></i>';
            $total_expense+=$revenue_entry->amount;

            }

            ?>

            {{$revenue_entry->amount}}</td>
        <td> <a href="{{route('admin.edit',$revenue_entry->id)}}" title="Edit" ><i class="fa fa-edit">&nbsp;&nbsp;&nbsp;&nbsp;</i></a>
         <a href="javascript:void(0);" onclick="delete_record()" ><i class="fa fa-trash"></i></a>
        
            <form id="Formdata" action="{{route('admin.destroy',$revenue_entry->id)}}" method="POST">
             <input type="hidden" name="_method" value="DELETE">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
        </form>
        </td>
       
      </tr>

        @endforeach

        @endif
    <tr>
        <td colspan="2">Total Income : {{$total_income}} </td>
        <td colspan="2">Total Expense : {{$total_expense}} </td>
        <td colspan="2">Balance : <span style="font-weight: bold;">{{$total_income-$total_expense}}</span> </td>

    </tr>
    
    </tbody>
  </table>
</div>
<div class="row">

        <div class="col-sm-6 col-sm-offset-5">
          {{$revenue_entries->links()}}
        </div>
        
      </div>
@endsection

@section('scripts')
<script type="text/javascript">
    
    function delete_record()
    {
        // alert('sad');
        $("#Formdata").submit();
    }
</script>

@stop
