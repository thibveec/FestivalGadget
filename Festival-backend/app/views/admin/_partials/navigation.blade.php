@if (Auth::user())

<div class="col-sm-6 nav">
    <ul class="nav">
        <div class="col-xs-6 navigation">
        <li class="{{ Request::is('admin/festivals*') ? 'active' : null }}"><a href="{{ URL::route('admin.festivals.index') }}"><i class="icon-headphones"></i> Festivals</a></li>
            </div>
            <div class="col-xs-6 navigation">
        <li class="{{ Request::is('admin/lineups*') ? 'active' : null }}"><a href="{{ URL::route('admin.lineups.index') }}"><i class="icon-star"></i> Lineups</a></li>
            </div>
        <div class="col-xs-6 navigation">
        <li class="{{ Request::is('admin/stages*') ? 'active' : null }}"><a href="{{ URL::route('admin.stages.index') }}"><i class="glyphicon glyphicon-tower"></i> Stages</a></li>
        </div>
        <div class="col-xs-6 navigation">
        <li class="{{ Request::is('admin/users*') ? 'active' : null }}"><a href="{{ URL::route('admin.users.index') }}"><i class="icon-user"></i> Users</a></li>
        </div>
        <div class="col-xs-6 navigation">
            <li class="{{ Request::is('admin/colors*') ? 'active' : null }}"><a href="{{ URL::route('admin.colors.index') }}"><i class="glyphicon glyphicon-tint"></i> Colors</a></li>
        </div>
        <div class="col-xs-6 navigation">
        <li><a href="{{ URL::route('admin.logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
        </div>


        @endif
    </ul>
</div>

