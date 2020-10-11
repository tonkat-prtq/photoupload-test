@foreach($users as $user)
<div class="user-name">
  {{ $user->name }}
</div>
<div class="image">
  <img src="{{ asset("storage/{$user->file_path}") }}" width="300px" height="300px"> {{-- 変更 --}}
</div>
@endforeach