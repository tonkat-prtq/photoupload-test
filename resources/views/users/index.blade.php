@foreach($users as $user)
<div class="user-name">
  {{ $user->name }}
</div>
<div class="image">
  <img src="{{ $user->file_path }}">
</div>
@endforeach