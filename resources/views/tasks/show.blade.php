@extends('layouts.app')

<div id="modal3" class="modal">
	<div class="modal-content">
		<div class="card blue-grey darken-1 card">
			<form method="POST" name="ProgressForm" action="{{ route('tasks.progress', ['id' => $task->id]) }}">
				@csrf
				<div class="card-content white-text">
					<span class="card-title">選擇進度</span>
					<p class="range-field">
						<input name="progress" type="range" id="test5" min="0" max="100"/>
					</p>
					<br>
					<button type="submit" data-position="top" data-tooltip="選擇進度" class="btn waves-effect waves-light tooltipped">選擇進度</button>
					<br><br>
				</div>
			</form>
		</div>
	</div>
</div>

@section('content')
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
        				    <b>
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
        			<h3>{{ $task->title }}</h4>
        			<h5>{{ $task->content }}</h5>
        			<br>
        			<div class='chip left brown white-text'>
        				{{ $task->tag }}
        			</div>
        			<p class='right'>創建時間:
                        {{ $task->created_at }}
                    </p>
        			<br>
                    <p class='right'>完成時間:
                        @if($task->finish_time)
                            {{ $task->finish_time }}
                        @else
                            尚未完成
                        @endif
                    </p>
        			<br><br>
					<div class="card-action">
						<div class="row">
							<a class='waves-effect waves-light btn brown left' href='{{ route("tasks.finish", $task->id) }}'>
								<b>完成</b>
							</a>
							<a class='waves-effect waves-light btn brown left' href='{{ route("tasks.nofinish", $task->id) }}'>
								<b>未完成</b>
							</a>
							<form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class='btn waves-effect waves-light brown right'><i class='tooltipped' data-delay='50' data-tooltip='刪除任務'><i class='material-icons'>delete</i></i></a>
                            </form>
						</div>
						<div class="row">
							<a class='btn waves-effect waves-light modal-trigger brown right' href='#modal1'><i class='tooltipped' data-delay='50' data-tooltip='添加成員'><i class='material-icons'>group_add</i></i></a>
							<a class='btn waves-effect waves-light modal-trigger brown left' href='#modal2'><i class='tooltipped' data-delay='50' data-tooltip='成員'><i class='material-icons'>group</i></i></a>
							<a class='btn waves-effect waves-light brown right'><i class='tooltipped' data-delay='50' data-tooltip='字體縮小'><i class='material-icons'>zoom_out</i></i></a>
							<a class='btn waves-effect waves-light brown right'><i class='tooltipped' data-delay='50' data-tooltip='字體放大'><i class='material-icons'>zoom_in</i></i></a>
							<a class='btn waves-effect waves-light modal-trigger brown right' href='#modal3' ><i class='tooltipped' data-delay='50' data-tooltip='選擇進度'><i class='material-icons'>timeline</i></i></a>
						</div>
					</div>
        		</div>
				<div class='progress'>
        			<div class='determinate' style='width: {{$task->progress}}%;'></div>
        		</div>
        	</div>
        </div>
    </div>
@endsection
