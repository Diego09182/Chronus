@extends('layouts.app')

@section('content')

	@include('component.message')

    <div class="card">
		<form method="POST" name="ActivityForm" action="{{ route('activities.store') }}">
            @csrf
			<div class="card-content">
				<span class="card-title">活動</span>
				<div class="input-field col s12">
					<i class="material-icons prefix">mode_edit</i>
					<input class="validate" name="activity" v-model="activity" type="text"  @keyup.enter="check_activity()">
					<label for="icon_prefix2">活動名稱</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix">mode_edit</i>
					<input class="validate" name="content" v-model="content" type="text" @keyup.enter="check_activity()">
					<label for="icon_prefix2">活動內容</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix">mode_edit</i>
					<input class="validate" name="location" v-model="location" type="text" @keyup.enter="check_activity()">
					<label for="icon_prefix2">活動地點</label>
				</div>
				<div class="input-field col s12 black-text">
					<i class="material-icons prefix">mode_edit</i>
					<input type="text" class="datepicker" name="date" @keyup.enter="check_activity()">
                    <label for="icon_prefix2">活動時間</label>
				</div>
				<br>
				<a @click="check_activity()" data-position="top" data-tooltip="創建活動" class="waves-effect waves-light btn tooltipped right black">創建活動</a>
				<br><br>
			</div>
		</form>
	</div>
    <br><br><br>
	
@endsection
