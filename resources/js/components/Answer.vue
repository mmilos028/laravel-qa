<script>
	export default
	{
		props: ['answer', 'baseurl'],
		data () {
			return {
				editing: false,
				body: this.answer.body,
				bodyHtml: this.answer.body_html,
				id: this.answer.id,
				questionId: this.answer.question_id,
				beforeEditCache: null
			}
		},
		
		methods: {
			edit () {
				this.beforeEditCache = this.body;
				this.editing = true;
			},
			cancel() {
				this.body = this.beforeEditCache;
				this.editing = false;
			},
			
			update() {			
				//axios.patch(`${this.baseurl}/questions/${this.questionId}/answers/${this.id}`, {
				axios.patch(this.endpoint, {
					body: this.body					
				})
				.then(res => {
					//console.log(res);
					this.editing = false;
					this.bodyHtml = res.data.body_html;
					
					this.$toast.success(res.data.message, "Success", { timeoout: 3000} );
				})
				.catch(err => {
				    //console.log(err.response);
					//console.log("Something went wrong");
					
					this.$toast.error(err.response.data.message, "Error", { timeoout: 3000} );
					//alert(err.response.data.message);
				});
			},
			
			destroy() {
				this.$toast.question('Are you sure ?', 'Confirm', {
				    timeout: 20000,
				    close: false,
				    overlay: true,
				    displayMode: 'once',
				    id: 'question',
				    zindex: 999,
				    title: 'Confirm',
				    message: 'Are you sure ?',
				    position: 'center',
				    buttons: [
				        ['<button><b>YES</b></button>', (instance, toast) => {
				        	
							axios.delete(this.endpoint)
							.then(res => {
								$(this.$el).fadeOut(500, () => {
									//alert(res.data.message);
									this.$toast.error(res.data.message, "Error", { timeoout: 3000} );
								})
							});
				 
				            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				 
				        }, true],
				        ['<button>NO</button>', function (instance, toast) {
				 
				            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				 
				        }],
				    ]				 
				});
			
			}
		},
		
		computed: {
			
			isInvalid() {
				return this.body.length < 10;
			},
			
			endpoint(){
				return `${this.baseurl}/questions/${this.questionId}/answers/${this.id}`;
			}
		}
	}
</script>