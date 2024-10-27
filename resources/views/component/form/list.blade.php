<div id="modal2" class="modal">
	<div class="modal-content">
		<div class="card blue-grey darken-1">
            <form method="POST" name="ListForm" action="{{ route('lists.store') }}">
                @csrf
				<div class="card-content white-text">
					<span class="card-title">發表事項</span>
					<div class="input-field col s12">
						<i class="material-icons prefix">mode_edit</i>
						<input class="validate" name="title" v-model="list" type="text">
						<label for="icon_prefix2">事項</label>
					</div>
					<br>
                    <a @click="check_list()" data-position="top" data-tooltip="創建事項" class="btn waves-effect waves-light tooltipped right black">創建事項</a>
					<br><br>
				</div>
			</form>
		</div>
	</div>
</div>