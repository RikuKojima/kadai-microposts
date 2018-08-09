<!--//共通のお気に入りボタンを設置-->

<!--すでに追加済み-->
@if (Auth::user()->is_like($micropost->id))
        {!! Form::open(['route' => ['user.rm_like', $micropost->id], 'method' => 'delete','style'=>'display:inline-block; ']) !!}
        {!! Form::submit('unfavorite', ['class' => "btn btn-success  btn-xs form-inline"]) !!}
        {!! Form::close() !!}
@else
<!--まだ追加していない->追加-->
        {!! Form::open(['route' => ['user.add_like', $micropost->id],'style'=>'display:inline-block;']) !!}
        {!! Form::submit('favorite', ['class' => "btn btn-primary  btn-xs form-inline"]) !!}
        {!! Form::close() !!}
@endif
