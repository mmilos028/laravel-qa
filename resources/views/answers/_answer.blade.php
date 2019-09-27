<div class="media post">
	@include('shared._vote', [
		'model' => $answer
	])
	
	<div class="media-body">        						
		{!! $answer->body_html !!}
		<div class="row">
			<div class="col-4">
				<div class="ml-auto">
					@if(Auth::user() && Auth::user()->can('update', $answer))
					<a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">
						Edit
					</a>
					@endif
					
					@if(Auth::user() && Auth::user()->can('delete', $answer))
					<form class="form-delete" method="post" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
						@method('DELETE')
						@csrf
						<button type="submit" class="btn btn-sm btn-outline-danger" onClick="return confirm('Are you sure ?')">
							Delete
						</button>
					</form>
					@endif
				</div>                    				
			</div>
			<div class="col-4">
				&nbsp;
			</div>
			<div class="col-4">        							
				<user-info :model="{{ $answer }}" label="Answered"></user-info>
			</div>
		</div>    						
	</div>
</div>