<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    <!-- search form -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      {{-- <li class="{{request()->segment(2) == 'dashboard' ? 'active' :null}}"><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <!--<li class="{{request()->segment(2) == 'dashboard' ? 'active' :null}}"><a href="/build"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>-->
      <li class="{{request()->segment(2) == 'team-categories' ? 'active' :null}}"><a href="{{route('admin.team.categories.index')}}"><i class="fa fa-table"></i> <span>Team Categories</span></a></li>

      <li class="{{request()->segment(2) == 'scenarios' ? 'active' :null}}"><a href="{{route('admin.scenario.index')}}"><i class="fa fa-random"></i> <span>Scenarios</span></a></li>

      <li class="treeview @if(request()->segment(2) == 'questions' || request()->segment(2) == 'question') menu-open @endif">
        <a href="#">
          <i class="fa fa-fw fa-question-circle"></i> <span>Questions</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: @if(request()->segment(2) == 'questions' || request()->segment(2) == 'question') block @else none @endif;">
          <li class="@if(request()->segment(2) == 'questions') active @endif"><a href="{{route('admin.questions.index')}}"><i class="fa fa-circle-o"></i> All</a></li>
          <li class="@if(request()->segment(2) == 'question') active @endif"><a href="{{route('admin.questions.create')}}"><i class="fa fa-circle-o"></i> Create</a></li>
        </ul>
      </li>

      <li class="{{request()->segment(2) == 'games' ? 'active' :null}}"><a href="{{route('admin.game.index')}}"><i class="fa fa-fw fa-gamepad"></i> <span>Games</span></a></li>

      <li class="{{request()->segment(2) == 'settings' ? 'active' :null}}"><a href="{{route('admin.settings.edit', 'score')}}"><i class="fa fa-fw fa-cogs"></i> <span>Settings</span></a></li> --}}

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>