@extends('Layout.app')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm3O5N1fP52tnpdSqPt71joqjd9xOkcek"></script>
<script type="text/javascript">  
 
</script>

@section('content')
        <!--inner-aboutus-->
      
          <!--resultstext-->
          
          <div class="row" >
          @include('Arabic.Candadties.partialjobs')
          </div>
 @endsection 
 @section('scripts')

 <script type="text/javascript" src="/js/slick.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
              getcandidate(page);
            }
        }
    });
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
          getcandidate($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
    function getcandidate(page) {
        $.ajax({
            url : '/morejobs?' ,
            dataType: 'json',
            data:{page:page,job:1}
        }).done(function (data) {
            $('.row').html(data);
            location.hash;
        }).fail(function () {
            alert('jobs could not be loaded.');
        });
    }
    </script>
    @endsection
 
          <!--row-->
          
  
    