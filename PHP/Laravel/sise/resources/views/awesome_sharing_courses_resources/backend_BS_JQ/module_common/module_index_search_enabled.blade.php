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