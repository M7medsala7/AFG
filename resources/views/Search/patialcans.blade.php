@extends('Layout.app')

@section('content')
<br>
<br>
<br>
<br>

          <!--resultstext-->

 <div class="row" style="margin-left:3%;">
 @include('Search.subCandidates');
        
 </div>
        
          
         
   
        <!--inner-aboutus--> 
   
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
                getcan(page);
            }
        }
    });
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getcan($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
    function getcan(page) {
        $.ajax({
            url : '/morecandidates',
            dataType: 'json',
            data:{words:null,page:page,asd:1}
        }).done(function (data) {
          console.log("exedhxcui");
            $('.row').html(data);
            location.hash;
        }).fail(function () {
            alert('jobs could not be loaded.');
        });
    }
    </script>
    @endsection 