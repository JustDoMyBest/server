
				<div class="ui_tb_h30">
					<div class="ui_flt" style="height: 30px; line-height: 30px;">
						共有
						{{-- <span class="ui_txt_bold04">90</span> --}}
                    <span class="ui_txt_bold04">{{ $models->count() }}</span>
						条记录，当前第
						{{-- <span class="ui_txt_bold04">1 --}}
							{{-- {{dd($models)}} --}}
						<span class="ui_txt_bold04">{{ $models->currentpage() }}
						/
						{{-- 9</span> --}}
						{{ $models->lastpage() }}</span>
						页
					</div>
					<div class="ui_frt">
						<!--    如果是第一页，则只显示下一页、尾页 -->
						
							<input type="button" value="首页" class="ui_input_btn01"
								onclick="jumpNormalPage(1);" />
							<input type="button" value="上一页" class="ui_input_btn01"
								onclick="jumpNormalPage({{ $models->currentpage() - 1 }});" />
							<input type="button" value="下一页" class="ui_input_btn01"
								onclick="jumpNormalPage({{ $models->currentpage() + 1 }});" />
							<input type="button" value="尾页" class="ui_input_btn01"
								onclick="jumpNormalPage({{ $models->lastpage() }});" />
						
						
						
						<!--     如果是最后一页，则只显示首页、上一页 -->
						
						转到第<input type="text" id="jumpNumTxt" class="ui_input_txt01" />页
							 {{-- <input type="button" class="ui_input_btn01" value="跳转" onclick="jumpInputPage(9);" /> --}}
							 <input type="button" class="ui_input_btn01" value="跳转" onclick="jumpInputPage({{ $models->lastpage() }});" />
					</div>
				</div>