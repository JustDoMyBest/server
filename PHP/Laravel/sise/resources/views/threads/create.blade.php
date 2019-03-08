@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">新建在线互动学习问答</div>

                    <div class="panel-body">
                        <form method="post" action="/threads">
                            {{ csrf_field() }}

                            <div class="form-group">
                                {{-- <label for="channel_id">Choose a Channel</label> --}}
                                <label for="channel_id">请选择一个在线互动学习问答类型</label>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    {{-- <option value="">Choose One...</option> --}}
                                    <option value="">请选择...</option>
                                    @foreach($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : ''}}>
                                            {{ $channel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">标题</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>

                            <div class="form-group">
                                <label for="body">内容</label>
                                <textarea name="body" id="body" class="form-control" rows="8"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">发布</button>

                            @if(count($errors))
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection