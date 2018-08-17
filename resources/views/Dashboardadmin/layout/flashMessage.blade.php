
div.container
@if(Session::has('flash_message'))
  

  <script>
  	swal({
  position: 'top-end',
  type: 'success',
  title: '{{Session::get('flash_message')}}',
  showConfirmButton: false,
  timer: 3500
})
  </script>>
  	@endif