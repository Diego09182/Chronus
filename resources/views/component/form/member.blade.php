<div id="modal2" class="modal">
	<div class="modal-content">
		<div class="card blue-grey darken-1">
            <form method="POST" name="MemberForm" action="{{ route('members.store', ['id' => $task->id]) }}">
                @csrf
				<div class="card-content white-text">
					<span class="card-title">新增成員</span>
					<br>
					<div class="input-field col s12">
						<i class="material-icons prefix">mode_edit</i>
						<input class="validate" name="name" type="text">
						<label for="icon_prefix2">成員名稱</label>
					</div>
                    <div class="input-field col s12">
						<i class="material-icons prefix">mode_edit</i>
						<input class="validate" name="position" type="text">
						<label for="icon_prefix2">成員職位</label>
					</div>
					<br>
                    <button data-position="top" data-tooltip="新增成員" class="btn waves-effect waves-light tooltipped right black">新增成員</button>
					<br><br>
				</div>
			</form>
		</div>
	</div>
</div>