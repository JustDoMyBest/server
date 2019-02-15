@extends('awesome_sharing_courses_resources.backend_BS_JQ.layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">新建用户组</div>
    
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('usergroup.store') }}">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="tag" class="col-md-4 control-label">用户组名：</label>
    
                                <div class="col-md-6">
                                    <input placeholder="输入你想添加的用户组名" id="name" type="string" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="tag" class="col-md-4 control-label">用户组描述：</label>
    
                                <div class="col-md-6">
                                    <input placeholder="输入你想添加的用户组描述" id="description" type="string" class="form-control" name="description" value="{{ old('description') }}" required>
                                </div>
                            </div>
    
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
    
                            {{-- <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
    
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