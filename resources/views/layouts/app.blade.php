<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Chronus</title>
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/Chronus.ico') }}" type="image/x-icon" />
</head>
<body>
<div id="app">
    <div id="modal1" class="modal">
    	<div class="modal-content">
            <div class="card blue-grey darken-1">
                <form method="POST" name="TaskForm" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="card-content white-text">
                        <span class="card-title">發表任務</span>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mode_edit</i>
                            <input class="validate" name="title" v-model="task" type="text" size="15" length="15" @keyup.enter="check_task()">
                            <label for="icon_prefix2">任務主題</label>
                        </div>
                        <br>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mode_edit</i>
                            <textarea class="materialize-textarea" name="content" v-model="content" size="30" length="30" @keyup.enter="check_task()"></textarea>
                            <label for="icon_prefix2">任務內容</label>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select name="tag" v-model="tag">
                                    <option value="" disabled>選擇任務標籤</option>
                                    <option value="待處理">待處理</option>
                                    <option value="進行中">進行中</option>
                                </select>
                                <label>任務標籤:</label>
                            </div>
                            <div class="input-field col s6">
                                <select name="importance">
                                    <option value="" disabled>選擇任務重要性</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <label>任務重要性</label>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <p class="range-field">
                                <label>任務進度:</label>
                                <input type="range" name="progress" id="test5" min="0" max="100" />
                            </p>
                        </div>
                        <br>
                        <a @click="check_task()" data-position="top" data-tooltip="創建任務" class="btn waves-effect waves-light tooltipped">創建任務</a>
                        <br><br>
                    </div>
                </form>
            </div>
    	</div>
    </div>
    <div id="modal2" class="modal">
    	<div class="modal-content">
    		<div class="card blue-grey darken-1 card">
                <form method="POST" name="ListForm" action="{{ route('lists.store') }}">
                    @csrf
    				<div class="card-content white-text">
    					<span class="card-title">發表事項</span>
    					<div class="input-field col s12">
    						<i class="material-icons prefix">mode_edit</i>
    						<input class="validate" name="title" v-model="list" type="text" size="7" length="7">
    						<label for="icon_prefix2">事項</label>
    					</div>
    					<br>
                        <a @click="check_list()" data-position="top" data-tooltip="創建事項" class="btn waves-effect waves-light tooltipped">創建事項</a>
    					<br><br>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
    <div id="modal3" class="modal">
    	<div class="modal-content">
    		<div class="card blue-grey darken-1 card">
    			<form method="POST" name="WhiteboardForm" action="{{ route('whiteboards.store') }}">
					@csrf
    				<div class="card-content white-text">
    					<span class="card-title">白板</span>
    					<div class="input-field col s12">
    						<i class="material-icons prefix">mode_edit</i>
    						<input class="validate" name="whiteboard" v-model="whiteboard" type="text" size="25" length="25" @keyup.enter="check_whiteboard()">
    						<label for="icon_prefix2">白板內容</label>
    					</div>
    					<br>
    					<a @click="check_whiteboard()" data-position="top" data-tooltip="創建白板" class="btn waves-effect waves-light tooltipped">創建白板</a>
    					<br><br>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
    <div id="modal4" class="modal">
    	<div class="modal-content">
    		<div class="card blue-grey darken-1 card">
    			<form method="POST" name="ActivityForm" action="{{ route('activities.store') }}">
                    @csrf
    				<div class="card-content">
    					<span class="card-title">活動</span>
    					<div class="input-field col s12">
    						<i class="material-icons prefix">mode_edit</i>
    						<input class="validate" name="activity" v-model="activity" type="text" size="10" length="10" @keyup.enter="check_activity()">
    						<label for="icon_prefix2">活動名稱</label>
    					</div>
    					<div class="input-field col s12">
    						<i class="material-icons prefix">mode_edit</i>
    						<input class="validate" name="content" v-model="content" type="text" size="20" length="20" @keyup.enter="check_activity()">
    						<label for="icon_prefix2">活動內容</label>
    					</div>
    					<div class="input-field col s12">
    						<i class="material-icons prefix">mode_edit</i>
    						<input class="validate" name="location" v-model="location" type="text" size="20" length="20" @keyup.enter="check_activity()">
    						<label for="icon_prefix2">活動地點</label>
    					</div>
    					<div class="input-field col s12">
    						<i class="material-icons prefix">mode_edit</i>
							<input type="text" class="datepicker" name="date" @keyup.enter="check_activity()">
                            <label for="icon_prefix2">活動時間</label>
    					</div>
    					<br>
    					<a @click="check_activity()" data-position="top" data-tooltip="創建活動" class="waves-effect waves-light btn brown right tooltipped">創建活動</a>
    					<br>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>

    <navigation></navigation>

    <banner></banner>

    <tools></tools>

    <div class="container">
        @yield('content')
        <features></features>
    </div>

    <footers></footers>

</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/3.0.1/vue-router.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/init.js') }}"></script>
<script>
		$(document).ready(function() {
			$('.fixed-action-btn').floatingActionButton({
				direction: 'left',
				hoverEnabled: false
			});
			$('.parallax').parallax();
			$('.modal').modal();
			$('.materialboxed').materialbox();
			$('.tooltipped').tooltip();
			$('.collapsible').collapsible();
			$('.chips').chips();
			$('.carousel').carousel();
			$('select').formSelect();
			$('.sidenav').sidenav();
            $('.datepicker').datepicker();
		});
</script>
</html>
