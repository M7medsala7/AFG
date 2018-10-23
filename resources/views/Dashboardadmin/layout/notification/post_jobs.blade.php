@foreach(Auth::user()->unreadNotifications as $notification)
@if($notification['type']=='App\Notifications\PostJobs')
<li>
  <a href="{{url('/adminpanel/postjob')}}">
  <i class="fa fa-users text-aqua">
  </i> {{isset($notification->data['user']['name'])?$notification->data['user']['name']:$notification
	->data['name']}} added new job
  </a>
</li>


@endif
@endforeach

