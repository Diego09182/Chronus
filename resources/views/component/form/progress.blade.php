<div id="modal1" class="modal">
    <div class="modal-content">
        <div class="card blue-grey darken-1">
            <form id="progress-form">
                @csrf
                <div class="card-content white-text">
                    <span class="card-title">選擇進度</span>
                    <p class="range-field">
                        <input name="progress" type="range" id="progress-range" min="0" max="100"/>
                    </p>
                    <br>
                    <button type="button" id="submit-progress" class="btn waves-effect waves-light tooltipped right black" data-position="top" data-tooltip="選擇進度">
                        選擇進度
                    </button>
                    <br><br>
                </div>
            </form>
        </div>
    </div>
</div>