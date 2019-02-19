<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@include('awesome_sharing_courses_resources.backend_BS_JQ.layouts.header')
@include('awesome_sharing_courses_resources.backend_BS_JQ.layouts.script')
<title>信息管理系统</title>
<script type="text/javascript">

var fancybox_onClosed_href = '/file';
var module_name = 'file';

@include('awesome_sharing_courses_resources.backend_BS_JQ.module_common.module_index_js')
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
							{{-- 创建者姓名&nbsp;&nbsp;<input value="{{ session('by') }}" type="text" name="by" class="ui_input_txt02" /> --}}
							{{-- 标签名&nbsp;&nbsp;<input type="text" id="fyZldz" name="fangyuanEntity.fyZldz" class="ui_input_txt02" /> --}}
							文件标题&nbsp;&nbsp;<input value="{{ session('title') }}" type="text" name="title" class="ui_input_txt02" />
							文件类型&nbsp;&nbsp;<input value="{{ session('filetype') }}" type="text" name="filetype" class="ui_input_txt02" />
							文件描述&nbsp;&nbsp;<input value="{{ session('description') }}" type="text" name="description" class="ui_input_txt02" />
							文件标签&nbsp;&nbsp;<input value="{{ session('tags') }}" type="text" name="tags" class="ui_input_txt02" />

							@include('awesome_sharing_courses_resources.backend_BS_JQ.module_common.module_index_search_enabled')
						</div>
						<div id="box_bottom">
							<input type="button" value="查询" class="ui_input_btn01" onclick="search();" /> 
							<input type="button" value="删除" class="ui_input_btn01" onclick="batchDel();" />
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
							{{-- <th>创建者姓名</th> --}}
							{{-- <th>文件名</th> --}}
							<th>文件标题</th>
							<th>文件类型</th>
							<th>文件描述</th>
							<th>文件标签</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
						@foreach ($files as $file)
                            <tr>
								{{-- <td><input type="checkbox" name="IDCheck" value="14458619251417" class="acb" /></td> --}}
								<td><input type="checkbox" name="IDCheck" value="{{ $file->id }}" class="acb" /></td>
                                <td>{{ $file->id }}</td>
								<td><a href="/storage/{{ $file->file_path }}">{{ $file->title }}</a></td>
								@if(isset($file->filetype))
									<td>{{ $file->filetype->type }}</td>
								@else
									<td>无</td>
								@endif
                                <td>{{ $file->description}}</td>
                                <td>{{ $file->tags }}</td>
								<td>{{ $file->enabled }}</td>
								<td>
									{{-- <a href="house_edit.html?fyID=14458619251417" class="edit">编辑</a>  --}}
                                    <a href="{{ route('file.edit', $file->id) }}" class="edit">编辑</a> 
									{{-- <a href="javascript:del('14458619251417');">删除</a> --}}
									<a href="javascript:del('{{ $file->id }}');">删除</a>
								</td>
							</tr>
                        @endforeach
						
					</table>
				</div>
				@include('awesome_sharing_courses_resources.backend_BS_JQ.module_common.module_index_paginate', ['models' => $files])
			</div>
		</div>
	</form>
</body>
</html>
