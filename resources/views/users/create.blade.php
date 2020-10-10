<h1>登録ページ</h1>
{!! Form::open(['route'=>'users.store','enctype'=>'multipart/form-data']) !!}
<div class='form-group'>
    {!! Form::label('name', '名前') !!}
    {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
</div>
<div class='form-group'>
    {!! Form::label('file_path','プロフィール写真') !!}
    {!! Form::file('file_path') !!}
</div>
{!! Form::submit('登録する',['class'=>'btn btn-info']) !!}
{!! Form::close() !!}