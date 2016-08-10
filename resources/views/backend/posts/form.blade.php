@extends('layouts.backend')

@section('title', $post->exists ? 'Editing ' . $post->title : 'Create New Blog post')

@section('content')

	{!! Form::model($post, [
		'method' => $post->exists ? 'put' : 'post',
		'route' => $post->exists ? ['backend.posts.update', $post->id] : ['backend.posts.store']
	]) !!}

		<div class="form-group">
			{!! Form::label('title') !!}
			{!! Form::text('title', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('slug') !!}
			{!! Form::text('slug', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('published_at') !!}
			{!! Form::input('text', 'published_at', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group excerpt">
			{!! Form::label('excerpt') !!}
			{!! Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('body') !!}
			{!! Form::textarea('body', null, ['class' => 'form-control']) !!}
		</div>

		{!! Form::submit( $post->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary'] ) !!}

	{!! Form::close() !!}


	<script>
		$(document).ready(function() {
			$( 'input[name=title]' ).on('blur', function() {
				
				var slugElement = $('input=slug');
				if (slugElement.val()) {
					return;
				}

				slugElement.val(this.value.toLowerCase().replace('/[^a-z0-9-]+/g', '-').replace('/^-+|-+$/g', ''));


			});
		});
	</script>
@endsection