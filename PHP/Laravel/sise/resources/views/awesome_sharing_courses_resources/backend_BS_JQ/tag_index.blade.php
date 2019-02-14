<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="{{ asset('sise/backend/scripts/jquery/jquery-1.7.1.js') }}"></script>
<link href="{{ asset('sise/backend/style/authority/basic_layout.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('sise/backend/style/authority/common_style.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ asset('sise/backend/scripts/authority/commonAll.js') }}"></script>
<script type="text/javascript" src="{{ asset('sise/backend/scripts/fancybox/jquery.fancybox-1.3.4.js') }}"></script>
<script type="text/javascript" src="{{ asset('sise/backend/scripts/fancybox/jquery.fancybox-1.3.4.pack.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('sise/backend/style/authority/jquery.fancybox-1.3.4.css') }}" media="screen"></link>
<script type="text/javascript" src="{{ asset('sise/backend/scripts/artDialog/artDialog.js?skin=default') }}"></script>
<title>信息管理系统</title>
<script type="text/javascript">
	$(document).ready(function(){
		/** 新增   **/
	    $("#addBtn").fancybox({
	    	// 'href'  : 'house_edit.html',
	    	// 'href'  : {{ route('tag.index') }},
	    	'href'  : '/tag',
	    	'width' : 733,
	        'height' : 530,
	        'type' : 'iframe',
	        'hideOnOverlayClick' : false,
	        'showCloseButton' : false,
	        'onClosed' : function() { 
	        	// window.location.href = 'house_list.html';
	        	// window.location.href = {{ route('tag.index') }};
	        	window.location.href = '/tag';
	        }
	    });
		
	    /** 导入  **/
	    $("#importBtn").fancybox({
	    	'href'  : '/xngzf/archives/importFangyuan.action',
	    	'width' : 633,
	        'height' : 260,
	        'type' : 'iframe',
	        'hideOnOverlayClick' : false,
	        'showCloseButton' : false,
	        'onClosed' : function() { 
	        	// window.location.href = 'house_list.html';
	        	window.location.href = '/tag';
	        }
	    });
		
	    /**编辑   **/
	    $("a.edit").fancybox({
	    	'width' : 733,
	        'height' : 530,
	        'type' : 'iframe',
	        'hideOnOverlayClick' : false,
	        'showCloseButton' : false,
	        'onClosed' : function() { 
	        	// window.location.href = 'house_list.html';
	        	window.location.href = '/tag';
	        }
	    });
	});
	/** 用户角色   **/
	var userRole = '';

	/** 模糊查询来电用户  **/
	function search(){
		// $("#submitForm").attr("action", "house_list.html?page=" + 1).submit();
		// $("#submitForm").attr("action", "tag?page=" + 1).submit();
		getSearch();
		// $("#submitForm").attr("action", "tag?page=" + 1 + "&by=" + by + "&tag=" + tag + "&enabled=" + enabled).submit();
	}

	function getSearch(){
		// var by = $('#username').val();
		// var tag = $('#tag').val();
		// var enabled = $('#enabled').val();
		// console.log(by);
		// console.log(tag);
		// console.log(enabled);
		// alert(by);
		// $("#submitForm").attr("action", "tag?page=" + 1 + "&by=" + by + "&tag=" + tag + "&enabled=" + enabled).submit();
		$("#submitForm").attr("action", "tag").submit();
	}

	/** 新增   **/
	function add(){
		$("#submitForm").attr("action", "/xngzf/archives/luruFangyuan.action").submit();	
	}
	 
	/** Excel导出  **/
	function exportExcel(){
		if( confirm('您确定要导出吗？') ){
			var fyXqCode = $("#fyXq").val();
			var fyXqName = $('#fyXq option:selected').text();
//	 		alert(fyXqCode);
			if(fyXqCode=="" || fyXqCode==null){
				$("#fyXqName").val("");
			}else{
//	 			alert(fyXqCode);
				$("#fyXqName").val(fyXqName);
			}
			$("#submitForm").attr("action", "/xngzf/archives/exportExcelFangyuan.action").submit();	
		}
	}
	
	/** 删除 **/
	function del(fyID){
		// 非空判断
		if(fyID == '') return;
		if(confirm("您确定要删除吗？")){
			// $("#submitForm").attr("action", "/xngzf/archives/delFangyuan.action?fyID=" + fyID).submit();			
			// alert("tag/" + fyID);return
			$("#deleteForm").attr("action", "tag/" + fyID).submit();			
			// window.location.href='tag';
		}
	}
	
	/** 批量删除 **/
	function batchDel(){
		if($("input[name='IDCheck']:checked").size()<=0){
			art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'至少选择一条', ok:true,});
			return;
		}
		// 1）取出用户选中的checkbox放入字符串传给后台,form提交
		var allIDCheck = "";
		$("input[name='IDCheck']:checked").each(function(index, domEle){
			bjText = $(domEle).parent("td").parent("tr").last().children("td").last().prev().text();
			// alert(bjText);
			// 用户选择的checkbox, 过滤掉“已审核”的，记住哦
			if($.trim(bjText)=="已审核"){
// 				$(domEle).removeAttr("checked");
				$(domEle).parent("td").parent("tr").css({color:"red"});
				$("#resultInfo").html("已审核的是不允许您删除的，请联系管理员删除！！！");
// 				return;
			}else{
				allIDCheck += $(domEle).val() + ",";
			}
		});
		// 截掉最后一个","
		if(allIDCheck.length>0) {
			allIDCheck = allIDCheck.substring(0, allIDCheck.length-1);
			allIDCheck = allIDCheck.split(',');
			// 赋给隐藏域
			$("#allIDCheck").val(allIDCheck);
			if(confirm("您确定要批量删除这些记录吗？")){
				// 提交form
				// $("#submitForm").attr("action", "/xngzf/archives/batchDelFangyuan.action").submit();
					$("#deleteForm").attr("action","tag/" + allIDCheck).submit();
				// for ( IDCheck of allIDCheck ) {
					// $("#deleteForm").attr("action","tag/" + IDCheck).submit();
					// console.log("tag/" + IDCheck);
				// }
				// $("#submitForm").attr("action", "tag").submit();
			}
		}
	}

	/** 普通跳转 **/
	function jumpNormalPage(page){
		// $("#submitForm").attr("action", "house_list.html?page=" + page).submit();
		// console.log({{ $tags->currentpage() + 1 }});
		// $("#submitForm").attr("action", "tag?page=" + page).submit();
		location.href = "tag?page=" + page;
	}
	
	/** 输入页跳转 **/
	function jumpInputPage(totalPage){
		// 如果“跳转页数”不为空
		if($("#jumpNumTxt").val() != ''){
			var pageNum = parseInt($("#jumpNumTxt").val());
			// 如果跳转页数在不合理范围内，则置为1
			if(pageNum<1 | pageNum>totalPage){
				art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'请输入合适的页数，\n自动为您跳到首页', ok:true,});
				pageNum = 1;
			}
			// $("#submitForm").attr("action", "house_list.html?page=" + pageNum).submit();
			// $("#submitForm").attr("action", "tag?page=" + pageNum).submit();
		location.href = "tag?page=" + pageNum;
		}else{
			// “跳转页数”为空
			art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'请输入合适的页数，\n自动为您跳到首页', ok:true,});
			// $("#submitForm").attr("action", "house_list.html?page=" + 1).submit();
			// $("#submitForm").attr("action", "tag?page=" + 1).submit();
		location.href = "tag?page=" + pageNum + 1;
		}
	}
</script>
<style>
	.alt td{ background:black !important;}
</style>
</head>
<body>
	<form id="deleteForm" method="POST">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		{{-- <input type="hidden" name="_method" value="DELETE"> --}}
	</form>
	{{-- <form id="submitForm" name="submitForm" action="" method="post"> --}}
	<form id="submitForm" name="submitForm" action="" method="get">
		{{ csrf_field() }}
		<input type="hidden" name="allIDCheck" value="" id="allIDCheck"/>
		<input type="hidden" name="fangyuanEntity.fyXqName" value="" id="fyXqName"/>
		<div id="container">
			<div class="ui_content">
				<div class="ui_text_indent">
					<div id="box_border">
						<div id="box_top">搜索</div>
						<div id="box_center">

							{{-- 发布者姓名&nbsp;&nbsp;<input type="text" id="fyZldz" name="fangyuanEntity.fyZldz" class="ui_input_txt02" /> --}}
							发布者姓名&nbsp;&nbsp;<input value="{{ session('by') }}" type="text" id="username" name="by" class="ui_input_txt02" />
							{{-- 标签名&nbsp;&nbsp;<input type="text" id="fyZldz" name="fangyuanEntity.fyZldz" class="ui_input_txt02" /> --}}
							标签名&nbsp;&nbsp;<input value="{{ session('tag') }}" type="text" id="tag" name="tag" class="ui_input_txt02" />

							状态
							{{-- <select name="fangyuanEntity.fyStatus" id="fyStatus" class="ui_select01"> --}}
							<select name="enabled" id="enabled" class="ui_select01">
								<option value="all">--请选择--</option>
								<option value="0"
								@if (session('enabled')==='0')
									selected
								@endif>所有</option>
								<option value="00" 
								@if (session('enabled')==='00')
									selected
								@endif>0</option>
								<option value="1"
								@if (session('enabled')==='1')
									selected
								@endif>1</option>
								{{-- <option value="2">{{ $old['status'] }}</option> --}}

                            </select>
						</div>
						<div id="box_bottom">
							<input type="button" value="查询" class="ui_input_btn01" onclick="search();" /> 
							{{-- <input type="button" value="新增" class="ui_input_btn01" id="addBtn" />  --}}
							<input type="button" value="删除" class="ui_input_btn01" onclick="batchDel();" /> 
							{{-- <input type="button" value="导入" class="ui_input_btn01" id="importBtn" /> --}}
							{{-- <input type="button" value="导出" class="ui_input_btn01" onclick="exportExcel();" /> --}}
						</div>
					</div>
				</div>
			</div>
			<div class="ui_content">
				<div class="ui_tb">
					<table class="table" cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
						<tr>
							<th width="30"><input type="checkbox" id="all" onclick="selectOrClearAllCheckbox(this);" />
							</th>
							<th>id</th>
							<th>发布者姓名</th>
							<th>标签名</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
						@foreach ($tags as $tag)
                            <tr>
								{{-- <td><input type="checkbox" name="IDCheck" value="14458619251417" class="acb" /></td> --}}
								<td><input type="checkbox" name="IDCheck" value="{{ $tag->id }}" class="acb" /></td>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->user->name }}</td>
                                <td>{{ $tag->tag }}</td>
								<td>{{ $tag->enabled }}</td>
								<td>
									{{-- <a href="house_edit.html?fyID=14458619251417" class="edit">编辑</a>  --}}
                                    <a href="{{ route('tag.edit', $tag->id) }}" class="edit">编辑</a> 
									{{-- <a href="javascript:del('14458619251417');">删除</a> --}}
									<a href="javascript:del('{{ $tag->id }}');">删除</a>
								</td>
							</tr>
                        @endforeach
						
					</table>
				</div>
				<div class="ui_tb_h30">
					<div class="ui_flt" style="height: 30px; line-height: 30px;">
						共有
						{{-- <span class="ui_txt_bold04">90</span> --}}
                    <span class="ui_txt_bold04">{{ $tags->count() }}</span>
						条记录，当前第
						{{-- <span class="ui_txt_bold04">1 --}}
						<span class="ui_txt_bold04">{{ $tags->currentpage() }}
						/
						{{-- 9</span> --}}
						{{ $tags->lastpage() }}</span>
						页
					</div>
					<div class="ui_frt">
						<!--    如果是第一页，则只显示下一页、尾页 -->
						
							<input type="button" value="首页" class="ui_input_btn01"
								onclick="jumpNormalPage(1);" />
							<input type="button" value="上一页" class="ui_input_btn01"
								onclick="jumpNormalPage({{ $tags->currentpage() - 1 }});" />
							<input type="button" value="下一页" class="ui_input_btn01"
								onclick="jumpNormalPage({{ $tags->currentpage() + 1 }});" />
							<input type="button" value="尾页" class="ui_input_btn01"
								onclick="jumpNormalPage({{ $tags->lastpage() }});" />
						
						
						
						<!--     如果是最后一页，则只显示首页、上一页 -->
						
						转到第<input type="text" id="jumpNumTxt" class="ui_input_txt01" />页
							 {{-- <input type="button" class="ui_input_btn01" value="跳转" onclick="jumpInputPage(9);" /> --}}
							 <input type="button" class="ui_input_btn01" value="跳转" onclick="jumpInputPage({{ $tags->lastpage() }});" />
					</div>
				</div>
			</div>
		</div>
	</form>
<!-- <div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div> -->
</body>
</html>
