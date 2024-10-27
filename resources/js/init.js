
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

	const app = Vue.createApp({
		data() {
			return {
				task: '',
				content: '',
				importance: '',
				tag: '',
				whiteboard: '',
				list: '',
				message: '操作完成',
				activity: '',
				location: '',
				date:'',
				name:'',
				position:'',
				title:'',
				remark:'',
				delay: 1000
			};
		},
		methods: {
			check_task() {
				if (this.task.length === 0) {
					alert("任務主題一定要填寫");
					return false;
				}
				if (this.task.length > 15) {
					alert("任務主題不能大於十五個字");
					return false;
				}
				if (this.content.length === 0) {
					alert("任務內容一定要填寫");
					return false;
				}
				if (this.content.length > 30) {
					alert("任務內容不能大於三十個字");
					return false;
				}
				M.toast({html: '任務已成功新增！', displayLength: 3000});
				setTimeout(() => {
					TaskForm.submit();
				}, this.delay);
			},
			check_whiteboard() {
				if (this.whiteboard.length === 0) {
					alert("白板主題一定要填寫");
					return false;
				}
				M.toast({html: '白板已成功新增！', displayLength: 3000});
				setTimeout(() => {
					WhiteboardForm.submit();
				}, this.delay);
			},
			check_list() {
				if (this.list.length === 0) {
					alert("事項內容一定要填寫");
					return false;
				}
				if (this.list.length > 7) {
					alert("事項內容不能大於七個字");
					return false;
				}
				M.toast({html: '事項已成功新增！', displayLength: 3000});
				setTimeout(() => {
					ListForm.submit();
				}, this.delay);
			},
			check_member() {
				if (this.name.length === 0) {
					alert("成員名稱一定要填寫");
					return false;
				}
				if (this.name.length > 7) {
					alert("成員名稱不能大於七個字");
					return false;
				}
				if (this.position.length === 0) {
					alert("成員名稱一定要填寫");
					return false;
				}
				if (this.position.length > 7) {
					alert("成員職位不能大於七個字");
					return false;
				}
				M.toast({html: '成員已成功新增！', displayLength: 3000});
				setTimeout(() => {
					MemberForm.submit();
				}, this.delay);
			},
			check_remark() {
				if (this.title.length === 0) {
					alert("註記主題一定要填寫");
					return false;
				}
				if (this.title.length > 7) {
					alert("註記主題不能大於七個字");
					return false;
				}
				if (this.remark.length === 0) {
					alert("註記內容一定要填寫");
					return false;
				}
				if (this.remark.length > 100) {
					alert("註記內容不能大於100個字");
					return false;
				}
				M.toast({html: '註記已成功新增！', displayLength: 3000});
				setTimeout(() => {
					RemarkForm.submit();
				}, this.delay);
			},
			check_activity() {
				if (this.activity.length === 0) {
					alert("活動名稱一定要填寫");
					return false;
				}
				if (this.content.length === 0) {
					alert("活動內容一定要填寫");
					return false;
				}
				if (this.location.length === 0) {
					alert("活動地點一定要填寫");
					return false;
				}
				if (this.activity.length > 10) {
					alert("活動名稱不能大於十個字");
					return false;
				}
				if (this.content.length > 20) {
					alert("活動內容不能大於二十個字");
					return false;
				}
				if (this.location.length > 20) {
					alert("活動地點不能大於二十個字");
					return false;
				}
				M.toast({html: '活動已新增成功！', displayLength: 3000});
				setTimeout(() => {
					ActivityForm.submit();
				}, this.delay);
			},
			delActivity(id) {
				if (confirm("請確認是否刪除此活動？")) {
					M.toast({html: '活動已刪除成功！', displayLength: 3000});
					setTimeout(() => {
						location.href = "delActivity.php?id=" + id;
					}, this.delay);
				}
			},
			reset_task() {
				this.task = "";
				this.content = "";
				this.tag = "";
			},
			reset_whiteboard() {
				this.whiteboard = "";
			},
			reset_list() {
				this.list = "";
			},
			reset_activity() {
				this.activity = "";
			}
		}
	});
	
	app.mount('#app');
	