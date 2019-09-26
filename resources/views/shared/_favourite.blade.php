<a title="Click to mark as favourite {{ $name }} (Click again to undo)" 
class="favourite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favourited ? 'favourited' : '') }}"
onClick="event.preventDefault(); document.getElementById('favourite-{{ $name }}-{{ $model->id }}').submit()"
>
	<i class="fas fa-star fa-2x"></i>
	<span class="favourites-count">{{ $model->favourites_count }}</span>
</a>
<form id="favourite-{{ $name }}-{{ $model->id}}" action="{{ url('/') }}/{{ $firstURISegment }}/{{ $model->id }}/favourites" method="POST" style="display: none;">
	@csrf
	@if($model->is_favourited)
		@method('DELETE')
	@endif
</form>