@extends('layouts.patient')
@section('title', 'Patient Notifications Page')
@section('description', 'View Notifications')

@section('content')
 <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"> Notifications</i>
        </li>
    </ol>
        @include('notifications.status_message')
        @include('notifications.errors_message')

<div class="container-fluid">
  <h3>Notifications</h3>
    <div class="row">
      <div class="col col-md-1"></div>
      <div class="col col-md-10">
        <table class="table table-stripped" style="margin-top:20px;">
          <tr style="background-color:lightcyan;">
            <th>Date</th>
            <th>Time</th>
            <th style="text-align:center;">Notification</th>
          </tr>
          @foreach($user->notifications as $notificaion)
            <tr>
              <td class="col-md-3"> {{ date('l d-M-Y', strtotime($notificaion->created_at)) }}</td>
              <td class="col-md-1"> {{ date('h:m a', strtotime($notificaion->created_at)) }}</td>
              <td class="col-md-8" style="text-align:center">
                {{ $notificaion->data['data'] }}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class="col col-md-1"></div>
    </div>
</div>

@endsection

@section('jscript')
<script>

</script>
@endsection
