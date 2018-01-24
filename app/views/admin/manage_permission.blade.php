<style>
/* admin permission box starts */
 .admin_menus {
	width: 100%;
	float: left;
	line-height: 50px;
	border-top: 1px dotted #BBB;
	/*text-indent: 10px;
	list-style: none;*/
	list-style: none!important;
/*	background-color: #CCCCCC;*/
}

.admin_menus li {
	border-width: 1px;
}

.admin_menus li:hover {
	background: #F7F7F7;
}
.admin_menus ul li{
	margin-right:0;
}
.admin_menus ul{margin-left:0;}
.admin_menus ul li span.per-block b{width: 10%;}
.admin_menus ul li span.per-block{
/*	background: #EEE;*/
	margin-left:0px!important;
	margin-top:0px; 
	padding-left: 0px!important;
	height: 70px;
	line-height:15px;
	vertical-align:middle!important; 
	text-align:left;
	text-indent:0px;
/*	width:8.33%;*/
	font-size:12px;
	display:inline-table;
	}

.admin_menus span{
	float: left;
	/*margin-right: 12px;*/
	width:16%;
	}
.admin_menus input{
	clear:none !important;
	margin:0;
	padding:0;
	margin-top: 1.5em;
	margin-left: 0.5em;
	height:auto !important;
	width:auto !important;
	}
	
li.admin_menus li input {
	margin-left: 0;
}
.admin_menus span.per-block{
	float: left;
	/*margin-right: 12px;*/
	/*width:8.333%;*/
	}
 /* admin permission box ends */
</style>


<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Permission panel</h3>
        </div>

        <div class="box-body">
		<ul class="permissions">				
					<li class="admin_menus"><span class="per-block"><strong>Modules</strong></span><strong><?php echo $heading;?></strong></li>
					<?php echo $menus; ?>
				
				</ul>			
		</div>        				
        <div style="clear:both"></div>
    </div>
</section>
<script>
function setPermission(obj){
	id   = obj.value.split("_");
	flag = obj.checked;
	$.ajax({
		  url: "{{ Request::root() }}/admin/ajax/updatePermission/"+id[0]+"/"+id[1]+"/"+flag,
		  context: document.body
		}).done(function(data) {
			

		})
}
</script>