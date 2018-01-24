<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/mockjax/jquery.mockjax.js"></script>
<script src="/admin_root/js/plugins/multiselect/jquery.multi-select.js"></script>
<script src="/admin_root/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>
<script src="https://cdn.datatables.net/scroller/1.4.3/js/dataTables.scroller.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script
<link rel="stylesheet" href="/admin_root/css/plugins/datepicker/datepicker.css">
<link rel="stylesheet" href="/admin_root/css/plugins/multiselect/multi-select.css">

<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Items</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="#">Home</a>
							<i class="icon-angle-right"></i>
						</li>
					</ul>
					
				</div>
		<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Item Listings
								</h3>
								<div>

								</div>
								<div>

								</div>
								<nav align="right">
										<ul style="list-style:none">
										  <li>
									&nbsp;&nbsp;Filter By Category

										{{ Form::open(array('url' => 'admin/books')) }}

									{{ Form::select('category_id',$list_categories,$category_id,array('class' => 'form-control chosen-select','id' => 'category_filter', 'style'=> 'width:300px;')) }}

									{{ Form::close() }}										  		

										  		  </li>


											<li>
									&nbsp;&nbsp;Filter By Author
									{{ Form::open(array('url' => 'admin/books')) }}
										{{ Form::select('author_id',$list_authors,$author_id,array('class' => 'form-control','id' => 'author_filter')) }}
									{{ Form::close() }}										   
										   </li>
										   <li>
										  	 <a href="{{ Request::root() }}/admin/books/create" class="btn btn-primary">Add new</a>
										   </li>
										</ul>
									</nav>									
									
																	
							</div>
							<div class="box-content nopadding">
								
								<table id="example" class="table table-hover table-nomargin table-bordered table-condensed table-responsive">
        <thead>
            <tr>
            <th>ID</th>
                <th>Name</th>
											<th>Name(Nepali)</th>
											<th>Category</th>
											<!--<th>Submitted by</th>-->
											<!--<th>Status</th>-->
											<th>View</th>
											<th>Edit</th>
											<th>Delete</th>
            </tr>

        </thead>
        <tfoot>
        </tfoot>
    </table>
							</div>
						</div>
					</div>
				
				</div>				
</div>

<script type="text/javascript">
	
	$( "#category_filter").change(function() {
		var jcategory_id = $("#category_filter").val();
		//window.location = "{{ Request::root() }}/admin/books?category_id=" + jcategory_id;
		
      alert(jcategory_id);
		
	});
	$( "#author_filter").change(function() {
		var jauthor_id = $("#author_filter").val();
		window.location = "{{ Request::root() }}/admin/books?author_id=" + jauthor_id;
	});
	
        
  $(document).ready(function() {
    $('#example').DataTable( {
        //"processing": true,
        //"serverSide": true,
         "searching": true,
         //"deferRender":    true,
           // "scrollY":        800,
            //"scrollCollapse": true,
            //"scroller":       true,

        "ajax": "{{ Request::root() }}/all_books",
        "columns" :[
        	{"data" : "orm_category.id"},
        	{"data" : "name"},
        	{"data" : "name_nepali"},
        	{"data" : "orm_category.name"},
        	//{"data" : "name_nepali"},
        	
        	
        	{
            "data": null,
           	 render:function(data, type, row)
            	{
     			 return '<i class="glyphicon-display"></i> <a href="{{ Request::root() }}/admin/books/'+data.id+'">Show</a>';
            	},
            "targets": -1
        	},
        	{
            "data": null,
           	 render:function(data, type, row)
            	{
     			 return '<a href="{{ Request::root() }}/admin/books/manage_book/'+data.id+'"><i class="icon-edit"></i> Edit</a>';
            	},
            "targets": -1
        	},
    		{
            "data": null,
            	render:function(data, type, row)
            	{
     			 return '<a onclick= "return doConfirm()" href="{{ Request::root() }}/admin/book_main/delete/'+data.id+'">delete</a>';
            	},
            "targets": -1
        	}

        	

        ],
         
    } );

    

} );

  
     function doConfirm(){
    	 return confirm("Are you sure you want to delete?");
    }
 

 

</script>