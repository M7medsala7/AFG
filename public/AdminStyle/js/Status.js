var editor;

  $(document).ready(function(){

     var table= $('#Status').DataTable({
  
    select:true,
    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,
    "pagingType": "simple",
      dom: 'lBfrtip',
        buttons: [
           
            
            { extend: 'excel', className: 'btn btn-primary dtb' }
            
            
        ],

fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
$.fn.editable.defaults.send = "always";

$.fn.editable.defaults.mode = 'inline';



}
});

 



   $('#Status tfoot th').each(function () {



      var title = $('#Status thead th').eq($(this).index()).text();
               
 if($(this).index()>=1 && $(this).index()<=6)
        {

           $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
}
        

    });
  table.columns().every( function () {
  var that = this;
 $(this.footer()).find('input').on('keyup change', function () {
          that.search(this.value).draw();
            if (that.search(this.value) ) {
               that.search(this.value).draw();
           }
        });
      
 
   });



   
 });