<div id="modal3" class="modal">
	<div class="modal-content">
		<div class="card blue-grey darken-1">
            <form method="POST" name="RemarkForm" action="{{ route('remarks.store', ['id' => $task->id]) }}">
                @csrf
				<div class="card-content white-text">
					<span class="card-title">備註</span>
					<br>
					<div class="input-field col s12">
						<i class="material-icons prefix">mode_edit</i>
						<input class="validate" name="title" type="text">
						<label for="icon_prefix2">備註主題</label>
					</div>
                    <div class="input-field col s12">
						<i class="material-icons prefix">mode_edit</i>
						<input class="validate" name="remark" type="text">
						<label for="icon_prefix2">備註內容</label>
					</div>
					<br>
                    <button type="submit" data-position="top" data-tooltip="新增備註" class="btn waves-effect waves-light tooltipped right black">新增備註</button>
					<br><br>
				</div>
			</form>
		</div>
	</div>
</div>