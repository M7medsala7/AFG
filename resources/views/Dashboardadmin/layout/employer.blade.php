<li>
  <a href="{{url('/adminpanel/emp')}}">
  <i class="fa fa-users text-aqua">
  </i> {{isset($notification->data['user']['name'])?$notification->data['user']['name']:$notification
	->data['name']}} new employer added
  </a>
</li>

