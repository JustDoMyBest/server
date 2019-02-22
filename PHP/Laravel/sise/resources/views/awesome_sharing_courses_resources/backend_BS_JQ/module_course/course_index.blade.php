<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@include('awesome_sharing_courses_resources.backend_BS_JQ.layouts.header')
@include('awesome_sharing_courses_resources.backend_BS_JQ.layouts.script')
<title>信息管理系统</title>
<script type="text/javascript">

var fancybox_onClosed_href = '/course';
var module_name = 'course';

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
							课程标题&nbsp;&nbsp;<input value="{{ session('title') }}" type="text" name="title" class="ui_input_txt02" />
							课程类型&nbsp;&nbsp;<input value="{{ session('coursetype') }}" type="text" name="coursetype" class="ui_input_txt02" />
							课程描述&nbsp;&nbsp;<input value="{{ session('description') }}" type="text" name="description" class="ui_input_txt02" />
							课程标签&nbsp;&nbsp;<input value="{{ session('tags') }}" type="text" name="tags" class="ui_input_txt02" />

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
							<th>课程标题</th>
							<th>课程类型</th>
							<th>课程描述</th>
							<th>课程标签</th>
							<th>课程文件</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
						@foreach ($courses as $course)
                            <tr>
								{{-- <td><input type="checkbox" name="IDCheck" value="14458619251417" class="acb" /></td> --}}
								<td><input type="checkbox" name="IDCheck" value="{{ $course->id }}" class="acb" /></td>
                                <td>{{ $course->id }}</td>
								{{-- <td><a href="/storage/{{ $course->course_path }}">{{ $course->title }}</a></td> --}}
								<td>{{ $course->title }}</td>
								@if(isset($course->coursetype))
									<td>{{ $course->coursetype->type }}</td>
								@else
									<td>无</td>
								@endif
                                <td>{{ $course->description}}</td>
                                <td>{{ $course->tags }}</td>
                                {{-- <td>{{ $course->files?implode(',', $course->files) }}</td> --}}
                                <td>
									{{-- {{ $course->files?implode(',', $course->files): }} --}}
									@foreach ($course->files as $file)
										{{-- <a href="{{ $file->file_path }}">{{ $course->title }}</a> --}}
										<a href="{{ $file->realFilePath }}">{{ $file->title }}</a>
										{{-- {{ dd($file->file_path) }} --}}
										{{-- {{ dd($file->realFilePath) }} --}}
										{{-- <a href="{{ $file->filePath }}">{{ $file->title }}</a> --}}
										{{-- <a href="{{ $file->file_path }}">22</a> --}}
										<br>
									@endforeach
								</td>
								<td>{{ $course->enabled }}</td>
								<td>
									{{-- <a href="house_edit.html?fyID=14458619251417" class="edit">编辑</a>  --}}
                                    <a href="{{ route('course.edit', $course->id) }}" class="edit">编辑</a> 
									{{-- <a href="javascript:del('14458619251417');">删除</a> --}}
									<a href="javascript:del('{{ $course->id }}');">删除</a>
								</td>
							</tr>
                        @endforeach
						
					</table>
				</div>
				@include('awesome_sharing_courses_resources.backend_BS_JQ.module_common.module_index_paginate', ['models' => $courses])
			</div>
		</div>
	</form>
</body>
</html>
