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
                                <option value="短期任務">短期任務</option>
                                <option value="中期任務">中期任務</option>
                                <option value="長期任務">長期任務</option>
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
                    <a @click="check_task()" data-position="top" data-tooltip="創建任務" class="btn waves-effect waves-light tooltipped right black">創建任務</a>
                    <br><br>
                </div>
            </form>
        </div>
	</div>
</div>