@extends('layouts.app')

@section('content')

    @include('component.message')

    @include('component.tools')

    @include('component.form.task')

    @include('component.form.list')

	@include('component.form.whiteboard')

	@include('component.form.activity')

    <div class="row">
        <div class="row">
            @if($tasks->count() >= 1)
                <ul class="pagination left">
                    @if ($tasks->onFirstPage())
                        <li class="disabled"><i class="material-icons">chevron_left</i></li>
                    @else
                        <li class="waves-effect"><a href="{{ $tasks->appends(['task_page' => $tasks->currentPage() - 1, 'list_page' => $lists->currentPage(), 'activity_page' => $activities->currentPage()])->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>
                    @endif
                    @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                        @if ($i === $tasks->currentPage())
                            <li class="active"><a href="{{ $tasks->appends(['task_page' => $i, 'list_page' => $lists->currentPage(), 'activity_page' => $activities->currentPage()])->url($i) }}">{{ $i }}</a></li>
                        @else
                            <li class="waves-effect"><a href="{{ $tasks->appends(['task_page' => $i, 'list_page' => $lists->currentPage(), 'activity_page' => $activities->currentPage()])->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    @if ($tasks->hasMorePages())
                        <li class="waves-effect"><a href="{{ $tasks->appends(['task_page' => $tasks->currentPage() + 1, 'list_page' => $lists->currentPage(), 'activity_page' => $activities->currentPage()])->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
                    @else
                        <li class="disabled"><i class="material-icons">chevron_right</i></li>
                    @endif
                </ul>
            @endif
            @if($lists->count() >= 1)
                <ul class="pagination right">
                    @if ($lists->onFirstPage())
                        <li class="disabled"><i class="material-icons">chevron_left</i></li>
                    @else
                        <li class="waves-effect"><a href="{{ $lists->appends(['task_page' => $tasks->currentPage(), 'list_page' => $lists->currentPage() - 1, 'activity_page' => $activities->currentPage()])->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>
                    @endif
                    @for ($i = 1; $i <= $lists->lastPage(); $i++)
                        @if ($i === $lists->currentPage())
                            <li class="active"><a href="{{ $lists->appends(['task_page' => $tasks->currentPage(), 'list_page' => $i, 'activity_page' => $activities->currentPage()])->url($i) }}">{{ $i }}</a></li>
                        @else
                            <li class="waves-effect"><a href="{{ $lists->appends(['task_page' => $tasks->currentPage(), 'list_page' => $i, 'activity_page' => $activities->currentPage()])->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    @if ($lists->hasMorePages())
                        <li class="waves-effect"><a href="{{ $lists->appends(['task_page' => $tasks->currentPage(), 'list_page' => $lists->currentPage() + 1, 'activity_page' => $activities->currentPage()])->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
                    @else
                        <li class="disabled"><i class="material-icons">chevron_right</i></li>
                    @endif
                </ul>
            @endif
        </div>
        @if($tasks->count() === 0)
            <div class="row">
                <div class="col m12">
                    <h3 class="center">目前沒有任務</h3>
                </div>
            </div>
        @endif
        <div class="row">
            <a href="{{ route('tasks.create')}}" class="waves-effect waves-light btn black">發表任務</a>
        </div>
        @foreach($tasks as $task)
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <h5>任務主題:{{ $task->title }}</h5>
                        <br>
                        <div class='chip left black white-text'>
                            {{ $task->tag }}
                        </div>
                        <br><br>
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
                        <br>
                    </div>
                    <div class="card-action">
                        <div class="row">
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-small btn-floating waves-effect waves-light black" onclick="return confirm('要刪除此項任務嗎?')">
                                    <i class="material-icons">delete</i>
                                </button>
                            </form>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-small waves-effect waves-light black right">
                                <i class="material-icons left">visibility</i>查看
                            </a>
                        </div>
                    </div>
                    <div class='progress'>
                        <div class="determinate black" style="width: {{ $task->progress }}%"></div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class='col s12 m4 right'>
            <ul class='collection with-header' id="sortable-list">
                <a class='collection-item black-text center'><h4>事項列表</h4></a>
                @if($lists->count() === 0)
                    <li class="collection-item">
                        <div class="row">
                            <div>
                                <h4 class="center">沒有事項</h4>
                            </div>
                        </div>
                    </li>
                @endif
                @foreach($lists as $list)
                    <li class="collection-item">
                        <div class="row">
                            <h4 class="flow-text">{{ $list->title }}</h4>
                            <form action="{{ route('lists.destroy', ['list' => $list]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='btn waves-effect waves-light black right' onclick="return confirm('要刪除此事項嗎?')"><i class='tooltipped' data-delay='50' data-tooltip='刪除事項'><i class='material-icons'>delete</i></i></button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    <div class="row">
        <div class="row">
            <h3 class="center">活動</h3>
        </div>
        <div class="row">
            <a href="{{ route('activities.create')}}" class="waves-effect waves-light btn black">發表活動</a>
        </div>
        @if($activities->count() === 0)
            <div class="row">
                <div class="col m12">
                    <h3 class="center">目前沒有活動</h3>
                </div>
            </div>
        @endif
        <div class="row">
            @if($activities->count() >= 1)
                <ul class="pagination">
                    @if ($activities->onFirstPage())
                        <li class="disabled"><i class="material-icons">chevron_left</i></li>
                    @else
                        <li class="waves-effect"><a href="{{ $activities->appends(['task_page' => $tasks->currentPage(), 'list_page' => $lists->currentPage(), 'activity_page' => $activities->currentPage() - 1])->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>
                    @endif
                    @for ($i = 1; $i <= $activities->lastPage(); $i++)
                        @if ($i === $activities->currentPage())
                            <li class="active"><a href="{{ $activities->appends(['task_page' => $tasks->currentPage(), 'list_page' => $lists->currentPage(), 'activity_page' => $i])->url($i) }}">{{ $i }}</a></li>
                        @else
                            <li class="waves-effect"><a href="{{ $activities->appends(['task_page' => $tasks->currentPage(), 'list_page' => $lists->currentPage(), 'activity_page' => $i])->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    @if ($activities->hasMorePages())
                        <li class="waves-effect"><a href="{{ $activities->appends(['task_page' => $tasks->currentPage(), 'list_page' => $lists->currentPage(), 'activity_page' => $activities->currentPage() + 1])->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
                    @else
                        <li class="disabled"><i class="material-icons">chevron_right</i></li>
                    @endif
                </ul>
            @endif
        </div>
        @foreach($activities as $activity)
            <div class="col s4 m4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="images/Chronus.png">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">{{ $activity->activity }}<i class="material-icons right">more_vert</i></span>
                        <h5 class="right">{{ $activity->date }}</h5>
                        @if($activity->date === date('Y-m-d'))
                            <p class="green-text">此活動到期</p>
                        @endif
                        <br><br>
                        <form method="POST" action="{{ route('activities.destroy', $activity->id) }}" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <div class="row">
                                <button type="submit" class="btn btn-small btn-floating waves-effect waves-light black left" onclick="return confirm('要刪除此活動嗎?')">
                                    <i class="material-icons">delete</i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">{{ $activity->activity }}<i class="material-icons right">close</i></span>
                        <h3>{{ $activity->content }}</h3>
                    </div>
                    @if($activity->date === date('Y-m-d'))
                        <div class='progress'>
                            <div class='determinate green' style='width:100%'></div>
                        </div>
                    @else
                        <div class='progress'>
                            <div class='determinate black' style='width:100%'></div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="container">
        <div class="row">
            <h3 class="center">白板</h3>
            <div class="col s12 m12">
                <div class="card horizontal small">
                    <div class="card-stacked">
                        <div class="card-content">
                            @if(isset($whiteboard->whiteboard) && isset($whiteboard->created_at))
                                <h4>
                                    <blockquote>
                                        {{ $whiteboard->whiteboard }}
                                    </blockquote>
                                </h4>
                                <br><br><br><br><br>
                                <h4 class="right">
                                    {{ $whiteboard->created_at }}
                                </h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
