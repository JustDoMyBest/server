@extends('awesome_sharing_courses_resources.backend_BS_JQ.layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">创建标签</div>
    
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('tag.store') }}">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}
                                <label for="tag" class="col-md-4 control-label">标签名字：</label>
    
                                <div class="col-md-6">
                                    {{-- <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus> --}}
                                    <input placeholder="输入你想添加的标签名称" id="tag" type="string" class="form-control" name="tag" value="{{ old('tag') }}" required autofocus>
    
                                    {{-- @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif --}}
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {{-- <label for="password" class="col-md-4 control-label">Password</label> --}}
                                <label for="enabled" class="col-md-4 control-label">是否启用：</label>
    
                                <div class="col-md-6">
                                    {{-- <input id="password" type="password" class="form-control" name="password" required> --}}
                                    {{-- <input id="enabled" type="boolean" class="form-control" name="enabled" required> --}}
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