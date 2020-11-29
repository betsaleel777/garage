@if ($message = Session::get('success'))
   <notifications-user :message='"{{ $message }}"' :variant="'success'"></notifications-user>
@endif


@if ($message = Session::get('danger'))
   <notifications-user :message='"{{ $message }}"' :variant="'error'"></notifications-user>
@endif


@if ($message = Session::get('warning'))
   <notifications-user :message='"{{ $message }}"' :variant="'warning'"></notifications-user>
@endif


@if ($message = Session::get('info'))
   <notifications-user :message='"{{ $message }}"' :variant="'info'"></notifications-user>
@endif
