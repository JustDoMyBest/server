<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@include('awesome_sharing_courses_resources.backend_BS_JQ.layouts.header')
@include('awesome_sharing_courses_resources.backend_BS_JQ.layouts.script')
<title>信息管理系统</title>
<script type="text/javascript">

var fancybox_onClosed_href = '/contact_us';
var module_name = 'contact_us

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
							{{-- 文件标题&nbsp;&nbsp;<input value="{{ session('name') }}" type="text" name="name" class="ui_input_txt02" /> --}}
							留言者联系方式&nbsp;&nbsp;<input value="{{ session('contact_information') }}" type="text" name="contact_information" class="ui_input_txt02" />
							留言者留言&nbsp;&nbsp;<input value="{{ session('text') }}" type="text" name="text" class="ui_input_txt02" />

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
							<th>留言者联系方式</th>
							<th>留言者留言</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
						@foreach ($contact_uses as $contact_us)
                            <tr>
								<td><input type="checkbox" name="IDCheck" value="{{ $contact_us->id }}" class="acb" /></td>
                                <td>{{ $contact_us->id }}</td>
								<td>{{ $contact_us->contact_information }}</td>
                                <td>{{ $contact_us->text }}</td>
								<td>{{ $contact_us->enabled }}</td>
								<td>
                                    {{-- <a href="{{ route('contact_us.edit', $contact_us->id) }}" class="edit">编辑</a>  --}}
									<a href="javascript:del('{{ $contact_us->id }}');">删除</a>
								</td>
							</tr>
                        @endforeach
						
					</table>
				</div>
				@include('awesome_sharing_courses_resources.backend_BS_JQ.module_common.module_index_paginate', ['models' => $contact_uses])
			</div>
		</div>
	</form>
</body>
</html>