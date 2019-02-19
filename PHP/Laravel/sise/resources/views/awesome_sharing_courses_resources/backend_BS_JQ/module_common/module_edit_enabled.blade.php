
				<tr>
					<td class="ui_text_rt">状态</td>
					<td class="ui_text_lt">
						{{-- <select name="fangyuanEntity.fyDhCode" id="fyDh" class="ui_select01"> --}}
						<select name="enabled" id="enabled" class="ui_select01">
                            <option value="">--请选择--</option>
                            {{-- <option value="16" selected="selected">瑞景河畔16号楼</option>
                            <option value="75">瑞景河畔24号楼</option> --}}
                            {{-- <option value="1" {{ $filetype->enabled ? 'selected="selected"' : '' }} >1</option>
                            <option value="00" {{ !$filetype->enabled ? 'selected="selected"' : '' }} >0</option> --}}
                            <option value="1" {{ $model->enabled ? 'selected="selected"' : '' }} >1</option>
                            <option value="00" {{ !$model->enabled ? 'selected="selected"' : '' }} >0</option>
                        </select>
					</td>
				</tr>