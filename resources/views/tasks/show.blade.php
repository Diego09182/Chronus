@extends('layouts.app')

@include('component.form.member')

@include('component.form.progress')

@include('component.form.remark')

<div id="modal4" class="modal">
    <div class="modal-content">
        <table class="responsive-table centered">
			@if($members->count() === 0)
				<br><br>
				<div class="row">
					<div class="col m12">
						<h3 class="center">目前沒有成員</h3>
					</div>
				</div>
			@else
				<div class="card">
					<thead>
						<tr>
							<th>成員名稱</th>
							<th>成員職位</th>
							<th>創建日期</th>
							<th>成員操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($members as $member)
						<tr>
							<td>{{ $member->name }}</td>
							<td>{{ $member->position }}</td>
							<td>{{ $member->created_at }}</td>
							<td>
								<form action="{{ route('members.destroy', ['id' => $task->id, 'member' => $member->id]) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" class='btn waves-effect waves-light black'><i class='tooltipped' data-delay='50' data-tooltip='刪除成員'><i class='material-icons'>delete</i></i></button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</div>
			@endif
        </table>
    </div>
</div>

<div id="modal5" class="modal">
	<div class="modal-content">
		@if($remarks->count() === 0)
			<br><br>
            <div class="row">
                <div class="col m12">
                    <h3 class="center">目前沒有註記</h3>
                </div>
            </div>
        @else
			@foreach ($remarks as $remark)
				<div class="card">
					<div class="card-content black-text">
						<h4 class="center">註記標題:{{ $remark->title }}</h4>
						<hr>
						<h4>註記內容:{{ $remark->content }}</h4>
						<form action="{{ route('remarks.destroy', ['id' => $task->id, 'remark' => $remark->id]) }}" method="POST">
							@csrf
							@method('DELETE')
							<button type="submit" class='btn waves-effect waves-light black right'><i class='tooltipped' data-delay='50' data-tooltip='刪除備註'><i class='material-icons'>delete</i></i></button>
						</form>
						<br>
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>

@section('content')

	@include('component.message')

	<div class='row'>
        <div class='col s12 m12'>
        	<div class='card'>
        		<div class='card-content center'>
        			<h5>
        				<div class='left'>任務重要性:
        					<b>{{ $task->importance }}</b>
        				</div>
        			</h5>
        			<h5>
						<div class='right'>任務狀態:
							<b id="task-status">
								@if($task->status == 0)
									未完成
								@elseif($task->status == 1)
									已完成
								@else
									未知狀態
								@endif
							</b>
						</div>
					</h5>
        			<br>
        			<h2>{{ $task->title }}</h2>
        			<h3>{{ $task->content }}</h3>
        			<br>
        			<div class='chip left black white-text'>
        				{{ $task->tag }}
        			</div>
        			<p class='right'>
						創建時間:{{ $task->created_at }}
                    </p>
        			<br>
                    <p class='right'>
                        @if($task->finish_time)
                            完成時間:{{ $task->finish_time }}
                        @else
                            尚未完成
                        @endif
                    </p>
        			<br><br>
					<div class="card-action">
						<div class="row">
							<a class='waves-effect waves-light btn black left' id="finish-task" data-id="{{ $task->id }}">
								<b>完成</b>
							</a>
							<a class='waves-effect waves-light btn black left' id="nofinish-task" data-id="{{ $task->id }}">
								<b>未完成</b>
							</a>
							<form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn waves-effect waves-light black right" onclick="return confirm('要刪除此項任務嗎?')">
                                    <i class="material-icons">delete</i>
                                </button>
                            </form>
						</div>
						<div class="row">
							<a class='btn waves-effect waves-light modal-trigger black left' href='#modal5'><i class='tooltipped' data-delay='50' data-tooltip='備註'><i class='material-icons'>chat</i></i></a>
							<a class='btn waves-effect waves-light modal-trigger black left' href='#modal4'><i class='tooltipped' data-delay='50' data-tooltip='成員'><i class='material-icons'>group</i></i></a>
							<a class='btn waves-effect waves-light modal-trigger black right' href='#modal2'><i class='tooltipped' data-delay='50' data-tooltip='添加成員'><i class='material-icons'>group_add</i></i></a>
							<a class='btn waves-effect waves-light modal-trigger black right' href='#modal3'><i class='tooltipped' data-delay='50' data-tooltip='新增備註'><i class='material-icons'>library_books</i></i></a>
							<a class='btn waves-effect waves-light modal-trigger black right' href='#modal1' ><i class='tooltipped' data-delay='50' data-tooltip='選擇進度'><i class='material-icons'>timeline</i></i></a>
						</div>
					</div>
        		</div>
				<div class='progress'>
					<div class='determinate black' id="task-progress" style='width: {{$task->progress}}%;'></div>
				</div>
        	</div>
        </div>
    </div>

    <div class="card">
    	<div class="card-content">
			<span class="card-title">檔案上傳</span>
			<form action="{{ route('tasks.files.store', $task->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="file-field input-field">
						<div class="btn">
							<span>File</span>
							<input name="file" type="file">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text">
						</div>
					@error('file')
						<span class="red-text">{{ $message }}</span>
					@enderror
				</div>
				<button type="submit" class="btn waves-effect waves-light">上傳</button>
			</form>
		</div>
	</div>

    <h5 class="center">附加檔案：</h5>
    <div class="row">
        @forelse ($task->files as $file)
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">{{ $file->file_name }}</span>
                        <p>檔案大小：{{ number_format($file->file_size / 1024, 2) }} KB</p>
                    </div>
                    <div class="card-action">
                        <a href="{{ route('tasks.files.download', $file->id) }}" class="btn">下載</a>
                        <form action="{{ route('tasks.files.destroy', $file->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn red">刪除</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col s12">
                <p>目前沒有上傳的檔案。</p>
            </div>
        @endforelse
    </div>

@endsection

@section('scripts')

<script>
	$(document).ready(function() {

		$('#finish-task').on('click', function(e) {
			e.preventDefault();
			let taskId = $(this).data('id');
			
			$.ajax({
				url: "{{ route('tasks.finish', ':id') }}".replace(':id', taskId),
				type: 'POST',
				data: {
					_token: "{{ csrf_token() }}"
				},
				success: function(response) {
					if (response.status == 1) {
						$('#task-status').html('已完成');
						$('#task-progress').css('width', '100%');
					}
				}
			});
		});

		$('#nofinish-task').on('click', function(e) {
			e.preventDefault();
			let taskId = $(this).data('id');
			
			$.ajax({
				url: "{{ route('tasks.nofinish', ':id') }}".replace(':id', taskId),
				type: 'POST',
				data: {
					_token: "{{ csrf_token() }}"
				},
				success: function(response) {
					if (response.status == 0) {
						$('#task-status').html('未完成');
						$('#task-progress').css('width', '0%');
					}
				}
			});
		});

		$('#submit-progress').on('click', function(e) {
			e.preventDefault();
			
			let progressValue = $('#progress-range').val();
			let taskId = {{ $task->id }};
			
			$.ajax({
				url: "{{ route('tasks.progress', ':id') }}".replace(':id', taskId),
				type: 'POST',
				data: {
					_token: "{{ csrf_token() }}",
					progress: progressValue
				},
				success: function(response) {
					if (response.success) {
						$('#task-progress').css('width', progressValue + '%');
						if (progressValue == 100) {
							$('#task-status').html('已完成');
						} else {
							$('#task-status').html('未完成');
						}
						$('#modal1').modal('close');
					}
				}
			});
		});

	});

</script>

@endsection