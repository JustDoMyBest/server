<!DOCTYPE html>
<html>
<head>
<title>信息管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="{{ asset('sise/backend/scripts/jquery/jquery-1.7.1.js') }}"></script>
<link href="{{ asset('sise/backend/style/authority/basic_layout.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('sise/backend/style/authority/common_style.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ asset('sise/backend/scripts/authority/commonAll.js') }}"></script>
<script type="text/javascript" src="{{ asset('sise/backend/scripts/jquery/jquery-1.4.4.min.js') }}"></script>
<script src="{{ asset('sise/backend/scripts/My97DatePicker/WdatePicker.js') }}" type="text/javascript" defer="defer"></script>
<script type="text/javascript" src="{{ asset('sise/backend/scripts/artDialog/artDialog.js?skin=default') }}"></script>
<script type="text/javascript">
module_name = "file";
	$(document).ready(function() {
		/*
		 * 提交
		 */
		$("#submitbutton").click(function() {
			if(validateForm()){
				checkFyFhSubmit();
			}
		});
		
		/*
		 * 取消
		 */
		$("#cancelbutton").click(function() {
			/**  关闭弹出iframe  **/
			window.parent.$.fancybox.close();
		});
		
		var result = 'null';
		if(result =='success'){
			/**  关闭弹出iframe  **/
			window.parent.$.fancybox.close();
		}
	});
	
	/** 检测房源房号是否存在  **/
// 	function checkFyFh(){
// 		// 分别获取小区编号、栋号、层号、房号
// 		var fyID = $('#fyID').val();
// 		var fyXqCode = $("#fyXq").val();
// 		var fyDh = $("#fyDh").val();
// 		var fyCh = $("#fyCh").val();	
// 		var fyFh = $("#fyFh").val();
// 		var tag = $("#tag").val();
// 		if(fyXqCode!="" && fyDh!="" && fyCh!="" && fyFh!=""){
// 			// 给房屋坐落地址赋值
// 			$("#fyZldz").val($('#fyDh option:selected').text() + fyCh + "-" + fyFh);
// 			// 异步判断该房室是否存在，如果已存在，给用户已提示哦
// 			$.ajax({
// 				type:"POST",
// 				url:"checkFyFhIsExists.action",
// 				// data:{"_token": "{{ csrf_token() }}", "fangyuanEntity.fyID":fyID, "tag": tag,"fangyuanEntity.fyXqCode":fyXqCode, "fangyuanEntity.fyDhCode":fyDh, "fangyuanEntity.fyCh":fyCh, "fangyuanEntity.fyFh":fyFh},
// 				data:{"_token": "{{ csrf_token() }}", "fyID":fyID, "tag": tag,"fangyuanEntity.fyXqCode":fyXqCode, "fangyuanEntity.fyDhCode":fyDh, "fangyuanEntity.fyCh":fyCh, "fangyuanEntity.fyFh":fyFh},
// 				dataType : "text",
// 				success:function(data){
// // 					alert(data);
// 					// 如果返回数据不为空，更改“房源信息”
// 					if(data=="1"){
// 						//  art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'该房室在系统中已经存在哦，\n请维护其他房室数据', ok:true,});
// 						 $("#fyFh").css("background", "#EEE");
// 						 $("#fyFh").focus();
// 						 return false;
// 					}
// 				}
// 			});
// 		}
// 	}
	
// 			$.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
//         }
// });
	/** 检测房源房号是否存在并提交form  **/
	function checkFyFhSubmit(){
		// 分别获取小区编号、栋号、层号、房号
		var fyID = $('#fyID').val();
		var title = $("#title").val();
		// var title = $("#title");
		// var email = $("#email").val();
		var description = $("#description").val();
		var filetype = $("#filetype").val();
		var tags = $("#tags").val();
		var file = $("#file");
		var enabled = $("#enabled").val();

		// var formdata = new FormData();
		var formdata = new FormData(document.getElementById("submitForm"));
		console.log(formdata);
		// formdata.append('_token', "{{ csrf_token() }}")
		// formdata.append('title', title)
		// formdata.append('_method', 'PUT')
		// formdata.append('title', '123')
		// formdata.append('description', description)
		// formdata.append('filetype', filetype)
		// formdata.append('tags', tags)
		// formdata.append('file', file[0].files[0])
		// formdata.append('enabled', enabled)
		console.log(formdata);
		console.log(formdata.get('title'));
		console.log(formdata.get('file'));
		// if(fyXqCode!="" && fyDh!="" && fyCh!="" && fyFh!=""){
		if(fyID!="" && title!="" && description!="" && enabled!=""){
			// 给房屋坐落地址赋值
			// $("#fyZldz").val($('#fyDh option:selected').text()  + fyCh + "-" + fyFh);
			// 异步判断该房室是否存在，如果已存在，给用户已提示哦
			// alert(window.location.host);
			// alert($('meta[name="csrf-token"]').attr('content'));
			$.ajax({

        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// },
				beforeSend: function(request) {
		            request.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
		        },
				// type:"PUT",
				// type:"PATCH",
				// url:"checkFyFhIsExists.action",
				url:"/" + module_name + "/" + fyID,
				type: 'post',
				// data:{"fangyuanEntity.fyID":fyID,"fangyuanEntity.fyXqCode":fyXqCode, "fangyuanEntity.fyDhCode":fyDh, "fangyuanEntity.fyCh":fyCh, "fangyuanEntity.fyFh":fyFh},
				// data:{
				// 	"_token":"{{ csrf_token() }}",
				// 	"title": title,
				// 	"description": description,
				// 	"filetype": filetype,
				// 	"tags": tags,
				// 	"file": file[0],
				// 	"enabled": enabled
				// 	},
				// data: {'title': '123'},
				// enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				// contentType: 'multipart/form-data',
				data: formdata,
				// dataType : "text",
				success:function(data){
// 					alert(data);
					// 如果返回数据不为空，更改“房源信息”
					if(data=="1"){
						//  art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'该房室在系统中已经存在哦，\n请维护其他房室数据', ok:true,});
						 $("#fyFh").css("background", "#EEE");
						 $("#fyFh").focus();
						 return false;
					}else{
						// $("#submitForm").attr("action", "/xngzf/archives/saveOrUpdateFangyuan.action").submit();
						// $("#submitForm").attr("action", "/tag/" + fyID).submit();
						alert('更新成功。');
						// location.href = '/tag/';
					}
				}
			});
		}
		return true;
	}
	
	/** 表单验证  **/
	function validateForm(){
		// if($("#fyXqName").val()==""){
		// 	art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'填写房源小区', ok:true,});
		// 	return false;
		// }
		// if($("#fyDh").val()==""){
		// 	art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'填写房源栋号', ok:true,});
		// 	return false;
		// }
		// if($("#fyCh").val()==""){
		// 	art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'填写房源层号', ok:true,});
		// 	return false;
		// }
		// if($("#fyFh").val()==""){
		// 	art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'填写房源房号', ok:true,});
		// 	return false;
		// }
		// if($("#fyZongMj").val()==""){
		// 	art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'填写房源面积', ok:true,});
		// 	return false;
		// }
		// if($("#fyJizuMj").val()==""){
		// 	art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'填写计租面积', ok:true,});
		// 	return false;
		// }
		// if($("#fyZldz").val()==""){
		// 	art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'填写房源座落地址', ok:true,});
		// 	return false;
		// }
		return true;
	}
</script>
</head>
<body>
<form id="submitForm" name="submitForm" enctype="multipart/form-data" action="/file/{{ $file->id }}" method="post">
{{-- <form id="submitForm" name="submitForm" action="/xngzf/archives/initFangyuan.action"> --}}
	{{ csrf_field() }}
	{{ method_field('put') }}
	{{-- <input type="hidden" name="fyID" value="14458625716623" id="fyID"/> --}}
	<input type="hidden" type="text" id="fyID" name="fyID" value="{{ $file->id }}" />
	<div id="container">
		<div id="nav_links">
			{{-- 当前位置：基础数据&nbsp;>&nbsp;<span style="color: #1A5CC6;">房源编辑</span> --}}
			当前位置：文件管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">文件编辑</span>
			<div id="page_close">
				<a href="javascript:parent.$.fancybox.close();">
					<img src="{{ asset('sise/backend/images/common/page_close.png') }}" width="20" height="20" style="vertical-align: text-top;"/>
				</a>
			</div>
		</div>
		<div class="ui_content">
			<table  cellspacing="0" cellpadding="0" width="100%" align="left" border="0">
				<tr>
					<td class="ui_text_rt" width="80"><a href="{{ $file->file_path }}">文件标题</a></td>
					<td class="ui_text_lt">
						<input type="text" id="title" name="title" value="{{ $file->title }}" class="ui_input_txt02"/>
					</td>
				</tr>
				{{-- <tr>
					<td class="ui_text_rt" width="80">文件标签</td>
					<td class="ui_text_lt">
						<input type="text" id="tag" value="{{ $file->filetype? $file->filetype->type: '无' }}" class="ui_input_txt02"/>
					</td>
				</tr> --}}
				<tr>
					<td class="ui_text_rt" width="80">文件描述</td>
					<td class="ui_text_lt">
						<input type="text" id="description" name="description" value="{{ $file->filetype? $file->filetype->type: '无' }}" class="ui_input_txt02"/>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">文件类型</td>
					<td class="ui_text_lt">
						<select id="filetype" name="filetype" type="string" class="form-control" name="filetype">
							<option value="">--请选择--</option>
							@foreach ($filetypes as $filetype)
								<option value="{{ $filetype->id }}" {{ $file->filetype_id === $filetype->id ? 'selected' : '' }}>{{ $filetype->type }}</option>
							@endforeach
						</select>
					</td>
				</tr>

				<tr>
					<td class="ui_text_rt">文件标签</td>
					<td class="ui_text_lt">
						<select id="tags" type="string" class="ui_select01" name="tags[]" multiple size="2">
							<option value="">--请选择--</option>
							@foreach ($tags as $tag)
								{{-- <option value="{{ $tag->tag }}" {{ $file->tag === $tag->tag ? 'selected' : '' }}>{{ $tag->tag }}</option> --}}
								<option value="{{ $tag->tag }}" {{ in_array($tag->tag, explode(',', $file->tags)) ? 'selected' : '' }}>{{ $tag->tag }}</option>
							@endforeach
						</select>
					</td>
				</tr>

				<tr>
					{{-- <td class="ui_text_rt">文件（不可多选）</td> --}}
					<td class="ui_text_rt">文件</td>
					<td class="ui_text_lt">
						{{-- <input id="files" type="file" class="form-control-file" name="files[]" value="{{ old('description') }}" required multiple> --}}
						{{-- <input id="file" type="file" class="form-control-file" name="file" required multiple> --}}
						<input id="file" name="file" type="file" required>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">状态</td>
					<td class="ui_text_lt">
						{{-- <select name="fangyuanEntity.fyDhCode" id="fyDh" class="ui_select01"> --}}
						<select name="enabled" id="enabled" class="ui_select01">
                            <option value="">--请选择--</option>
                            {{-- <option value="16" selected="selected">瑞景河畔16号楼</option>
                            <option value="75">瑞景河畔24号楼</option> --}}
                            <option value="1" {{ $file->enabled ? 'selected="selected"' : '' }} >1</option>
                            <option value="00" {{ !$file->enabled ? 'selected="selected"' : '' }} >0</option>
                        </select>
					</td>
				</tr>
				{{-- <tr>
					<td class="ui_text_rt">层号</td>
					<td class="ui_text_lt">
						<input type="text" id="fyCh" name="fangyuanEntity.fyCh" value="1"  class="ui_input_txt01"/>
					</td>
				</tr> --}}
				<tr>
					<td>&nbsp;</td>
					<td class="ui_text_lt">
						{{-- &nbsp;<input id="submitbutton" type="button" value="提交" class="ui_input_btn01"/> --}}
						&nbsp;<input type="submit" value="提交" class="ui_input_btn01"/>
						&nbsp;<input id="cancelbutton" type="button" value="取消" class="ui_input_btn01"/>
					</td>
				</tr>
			</table>
		</div>
	</div>
</form>
<!-- <div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div> -->
</body>
</html>