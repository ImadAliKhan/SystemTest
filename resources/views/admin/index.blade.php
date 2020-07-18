@extends('layouts.admin')

@section('content')

@if(Session::has('deleted_user'))

<p class="bg-danger">{{Session('deleted_user')}}</p>
@endif

@if(Session::has('create_user'))

<p class="bg-success">{{Session('create_user')}}</p>
@endif

@if(Session::has('edit_user'))

<p class="bg-success">{{Session('edit_user')}}</p>
@endif

<h1>Users</h1>
 <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Photo</th>

        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>

        <th>Status</th>

        <th>Created at</th>
        <th>Updated at</th>

      </tr>
    </thead>
    <tbody>
      <?php  if($users) 
      {
foreach ($users as $user) {

    ?>

 <tr>
        <td>{{$user->id}}</td>
        <td><img class="img-responsive img-circle" style="height: 50px;" src="{{$user->photo ? $user->photo->path : '/images/defaultuser.png'}}"></td>

        <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
        <td>{{$user->email}}</td>
        <td>{{$user->role->name}}</td>
        <td>{{$user->is_active==1 ? 'ACTIVE':'INACTIVE'}}</td>

        <td>{{$user->created_at->diffForHumans()}}</td>
        <td>{{$user->updated_at}}</td>

      </tr>
<?php }

      }?>
     
     
    </tbody>
  </table>
@endsection
