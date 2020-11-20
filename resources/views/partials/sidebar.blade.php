<div class="ui top attached demo menu">
   <a href="{{ route('acceuil') }}" class="item"><i class="sidebar icon"></i>Smart-garage</a>
</div>
<div class="ui bottom attached segment pushable">
   <div class="ui inverted labeled icon left inline vertical sidebar menu" style="">
      <a href="{{ route('acceuil') }}" class="item"><i class="home icon"></i> Tableau de bord</a>
      <a href="{{ route('maintenance_index') }}" class="item"><i class="block layout icon"></i> Maintenance</a>
      <a class="item"><i class="smile icon"></i> CRM</a>
      <a class="item"><i class="calendar icon"></i> Stock</a>
      <a class="item"><i class="calendar icon"></i> Finance</a>
   </div>
   <div class="pusher">
      <div class="ui basic segment">
         @yield('content')
      </div>
   </div>
</div>
