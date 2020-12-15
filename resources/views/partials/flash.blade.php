@if ($message = Session::get('success'))
   <notifications-user :message='"{{ $message }}"' :variant="'success'" :titre="'OPERATION REUSSIE'"
      :lien="'{{ Session::get('lien') }}'">
   </notifications-user>
@endif


@if ($message = Session::get('danger'))
   <notifications-user :message='"{{ $message }}"' :variant="'danger'" :titre="'OPERATION ECHOUEE'"
      :lien="'{{ Session::get('lien') }}'"></notifications-user>
@endif


@if ($message = Session::get('warning'))
   <notifications-user :message='"{{ $message }}"' :variant="'warning'" :titre="'FAIRE ATTENTION'"
      :lien="'{{ Session::get('lien') }}'"></notifications-user>
@endif


@if ($message = Session::get('info'))
   <notifications-user :message='"{{ $message }}"' :variant="'info'" :titre="'INFORMATIONS'"
      :lien="'{{ Session::get('lien') }}'"></notifications-user>
@endif
