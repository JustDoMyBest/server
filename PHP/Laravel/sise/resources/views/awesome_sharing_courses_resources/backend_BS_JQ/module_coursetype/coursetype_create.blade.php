@extends('awesome_sharing_courses_resources.backend_BS_JQ.layouts.app')

@section('content')
{{-- <script src=""></script> --}}
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">新增课程类型</div>
    
                    <div class="panel-body">
                        <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('coursetype.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">课程类型：</label>
    
                                <div class="col-md-6">
                                    <input placeholder="输入你想添加的文件类型" id="title" type="string" class="form-control" name="type"
                                        value="{{ old('type') }}"
                                        required autofocus>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">课程类型描述：</label>
    
                                <div class="col-md-6">
                                    <input placeholder="输入你想添加的文件类型描述" id="description" type="string" class="form-control" name="description"
                                        value="{{ old('description') }}" required>
                                </div>
                            </div>

                            {{-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> <label for="tag" class="col-md-4 control-label">文件标签：</label>
                                <div class="col-md-6">
                                    <select id="tag" type="string" class="form-control" name="tag" multiple size="2">
                                        <option value="">--请选择--</option>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
    
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {{-- <label for="password" class="col-md-4 control-label">Password</label> --}}
                                <label for="enabled" class="col-md-4 control-label">是否启用：</label>
    
                                <div class="col-md-6">
                                    {{-- <input id="password" type="password" class="form-control" name="password" required> --}}
                                    <div id="enabled" class="checkbox">
                                        <label>
                                            <input type="checkbox" name="enabled" {{ old('enabled') ? 'checked' : '' }}> 选中，马上启用。
                                        </label>
                                    </div>
    
                                    {{-- @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif --}}
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        创建
                                    </button>
    
                                    {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a> --}}

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection