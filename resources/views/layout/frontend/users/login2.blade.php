@extends('layout/frontend/layout_login')

@section('pagestyle')

<style>
    .centered-form .panel{
      background: rgba(255, 255, 255, 0.8);
      box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
      color: #4e5d6c;
    }

    .centered-form{
      margin-top: 60px;
    }
</style>

@stop

@section('content_base')

<div class="row centered-form">
  <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Accesso utente</h3>
      </div>
      <div class="panel-body">
        {{ Form::open(['action' => 'Auth\LoginController@login', 'method' => 'post']) }}
          <div class="row">
      <!--  <div class="col-xs-6 col-sm-6 col-md-6"> -->
              <div class="form-group">
                {{ $usr = Form::text('user', null, array('class'=>'form-control input-sm','placeholder'=>'Username')) }}
              </div>
      <!--  </div> -->
          {{-- <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                {{ Form::text('last_name', null, array('class'=>'form-control input-sm','placeholder'=>'Last Name')) }}
              </div>
            </div>--}}
          </div>

          {{--<div class="form-group">
            {{ Form::email('email', null, array('class'=>'form-control input-sm','placeholder'=>'Email Address')) }}
          </div>--}}

          <div class="row">
      <!--  <div class="col-xs-6 col-sm-6 col-md-6">   -->
              <div class="form-group">
                {{ $pwd = Form::password('password', array('class'=>'form-control input-sm','placeholder'=>'Password')) }}
              </div>
      <!--  </div>   -->
            {{--<div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                {{ Form::password('password_confirmation', array('class'=>'form-control input-sm','placeholder'=>'Confirm Password')) }}
              </div>
            </div>--}}
          </div>

          {{ Form::submit('Login', array('class'=>'btn btn-info btn-block')) }}

        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

@stop