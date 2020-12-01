@if ($message = Session::get('success'))
   <notifications-user :message='"{{ $message }}"' :variant="'success'" :titre="'OPERATION REUSSIE'">
   </notifications-user>
@endif


@if ($message = Session::get('danger'))
   <notifications-user :message='"{{ $message }}"' :variant="'error'" :titre="'OPERATION ECHOUEE'"></notifications-user>
@endif


@if ($message = Session::get('warning'))
   <notifications-user :message='"{{ $message }}"' :variant="'warning'" :titre="'FAIRE ATTENTION'"></notifications-user>
@endif


@if ($message = Session::get('info'))
   <notifications-user :message='"{{ $message }}"' :variant="'info'" :titre="'INFORMATIONS'"></notifications-user>
@endif
