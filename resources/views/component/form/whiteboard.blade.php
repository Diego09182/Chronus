<div id="modal3" class="modal">
	<div class="modal-content">
		<div class="card blue-grey darken-1">
			<form method="POST" name="WhiteboardForm" action="{{ route('whiteboards.store') }}">
				@csrf
				<div class="card-content white-text">
					<span class="card-title">白板</span>
					<div class="input-field col s12">
						<i class="material-icons prefix">mode_edit</i>
						<input class="validate" name="whiteboard" v-model="whiteboard" type="text" @keyup.enter="check_whiteboard()">
						<label for="icon_prefix2">白板內容</label>
					</div>
					<br>
					<a @click="check_whiteboard()" data-position="top" data-tooltip="創建白板" class="btn waves-effect waves-light tooltipped right black">創建白板</a>
					<br><br>
				</div>
			</form>
		</div>
	</div>
</div>