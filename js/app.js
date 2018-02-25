// Cardova splash screen handler
document.addEventListener('deviceready',DeviceReady,false);
document.addEventListener('pause',DevicePause,false);
document.addEventListener('resume',DeviceResume,false);

var splashScreenStatus=1;
function splashScreenCHK(){if(splashScreenStatus==1){navigator.splashscreen.show()}else{navigator.splashscreen.hide();clearInterval(splashScreenCHKInterval)}}

function DeviceReady(){
	var splashScreenCHKInterval=setInterval(function(){splashScreenCHK()},1)
	if(cordova.platformId=='android'){StatusBar.overlaysWebView(false);StatusBar.backgroundColorByHexString('#b71c1c');StatusBar.styleLightContent()}
}

function DevicePause(){
	//nothing
}

function DeviceResume(){
	//nothing
}










// Prototypes
Date.prototype.toIsoString=function(){this.getTimezoneOffset();var t=function(t){var e=Math.floor(Math.abs(t));return(e<10?"0":"")+e};return this.getFullYear()+"-"+t(this.getMonth()+1)+"-"+t(this.getDate())};










// Dom7
var $ = Dom7;

// Get theme & color
var storedData = localStorage.getItem('f7form-settings')
var theme = 'auto';
var color = 'red';
if(storedData) {
    try {
        theme = JSON.parse(storedData).theme;
		color = JSON.parse(storedData).color;
    } catch(e) {}
} else {
    try {
        theme = document.cookie.match(new RegExp('theme=([^;]+)'))[1];
		color = document.cookie.match(new RegExp('color=([^;]+)'))[1];
    } catch(e) {}
}

if(document.location.search.indexOf('theme=')>=0){theme=document.location.search.split('theme=')[1].split('&')[0];}
if(document.location.search.indexOf('color=')>=0){color=document.location.search.split('color=')[1].split('&')[0];}

if(theme!='md'&&theme!='ios'){theme='auto'}
if(color!='red'&&color!='green'&&color!='blue'&&color!='pink'&&color!='orange'){color='red'}






var window_resize_counter=0;


var app = new Framework7({
  root: '#app',
  id: 'com.jcp.ews',
  version: '2.0.0',
  root: '#app',
  animateNavBackIcon: true,
  theme: theme,
  dialog: {
    title: 'EWS',
	preloaderTitle: 'Please wait...',
	progressTitle: 'Please wait...',
  },
  'lazy': {
    'placeholder': 'data:image/gif;base64,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',
    'threshold': 0,
    'sequential': true,
  },
    routes: routes,
  panel: {
    leftBreakpoint: 768,
    rightBreakpoint: 1280,
  },
    on: {
	resize: function(){
		/*console.log('window_resize_counter: '+window_resize_counter);*/
		if(app.width>=1280){/*console.log('split: show 3 views');*/$('.panel-left,.view-main,.panel-right').addClass('panel-visible-by-breakpoint');split_view_width=(($('#app').width()-260)/2)+'px';$('.view-main').css('margin-right',split_view_width);$('.panel-right').css('width',split_view_width)}
		else if(app.width>=768){/*console.log('split: show 2 views');*/$('.panel-left,.view-main').addClass('panel-visible-by-breakpoint');}
		else{/*console.log('split: show 0 views');*/$('.panel-left,.view-main,.panel-right').removeClass('panel-visible-by-breakpoint');$('.view-main').css('margin-right','0px');}
		window_resize_counter=(window_resize_counter + 1);
		if(window_resize_counter<6){setTimeout(function(){$(window).trigger('resize')},100)}else{window_resize_counter=0}
	},
	routerAjaxStart: function(xhr, options){$('.panel-backdrop').show();},
	routerAjaxError: function(xhr, options){$('.panel-backdrop').hide();try{app.toast.close();}catch(e){}},
	routeChanged: function(xhr, options){$('.panel-backdrop').hide();try{app.toast.close();}catch(e){}},
	routerAjaxComplete: function(xhr, options){
		$('.panel-backdrop').hide();
		if(xhr.status!=200){
			var toastOnRouterAjaxError = app.toast.create({
				text: '<img class="browser-only" src="'+app.data.co_creator_image+'"/>Oops! EWS couldn\'t load the requested page. <br class="browser-only">Check your internet connectivity and retry.',
				position: 'bottom',
				closeButton: true,
				closeButtonText: 'Close',
			});
			toastOnRouterAjaxError.open();
		}
	},
	pageInit: function(page){
	//console.log(app.view.main.router.history)
	},
	pageAfterIn: function(e, page){
		//
	},
	formStoreData: function(form,data){
		app.data[form.id] = data;
	}
	//Page events for all
  },

  data: function () {
    return {
		creator_image: 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBQYFBAYGBQYHBwYIChAKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMCUoKSj/2wBDAQcHBwoIChMKChMoGhYaKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCj/wgARCAAoACgDASIAAhEBAxEB/8QAGgAAAwEBAQEAAAAAAAAAAAAAAAUGBAECA//EABgBAQADAQAAAAAAAAAAAAAAAAIAAQME/9oADAMBAAIQAxAAAAHd7XUgkhXybZu3JsGaDdlndDxorx6KiPgALF4doOhU9gKv/8QAHxAAAgIBBQEBAAAAAAAAAAAAAwQBAgUREhMUIgAV/9oACAEBAAEFAsYZiSu3Lu3PxOEyMsWYifse11nHGwGS8WNixjXZ/Rg0QvYDtVOUPIUhSEtARea3yhQVacMf7sD6yxJ1TdtyP3mxvOzSulZrFgab/wD/xAAaEQACAwEBAAAAAAAAAAAAAAAAAQIRQQMQ/9oACAEDAQE/AUNFjmsOklRFrfWf/8QAGxEBAAIDAQEAAAAAAAAAAAAAAQADAhEhMRD/2gAIAQIBAT8BEm45B7KqXLrK61eyylHhuefMWf/EACYQAAEEAgEDAwUAAAAAAAAAAAEAAgMREiExEzJRBEFhIkJxgZH/2gAIAQEABj8ClhDm83kfwnNk9OHVoHyV20nRS9wQdrXwiTsEC72VJTjG+/2g7qSs+CpvUP7QNJww39qzbBK9rTr6U+SUmEMbZL2rEBoHlHpuyA0QPdZV/fZUZDldIl0mQ8OV8ScUh1Dwm5G2+H7TiaLb0hpN5R0mkr//xAAhEAEAAwACAgIDAQAAAAAAAAABABEhMUFRYYGRcaHB4f/aAAgBAQABPyFW67Tvn/EM43lrHnPRKFyOhKlH4dmBfmXA5+7PxGuBPkM8wj4cswxQrqrze6ggKzHlrK+43u0vpN5b3Red/cKygMpe2Zh3GoFKq21Zs7p6rfDmCNgs7gw9ThEaPiGa0Gv8lSwvSH6mWVaaPr4l2Qfwti6kC3kHvdM/LWPZonTP/9oADAMBAAIAAwAAABC+QztDGAL3/8QAGBEAAwEBAAAAAAAAAAAAAAAAAAERIUH/2gAIAQMBAT8Q04TVEoxH3GPIlpDoWkE0/8QAGhEAAwEBAQEAAAAAAAAAAAAAAAEhETFRYf/aAAgBAgEBPxB8pYlRlQizweOBUm+D6S8G5DBH/8QAHxABAQACAwADAQEAAAAAAAAAAREAITFBUWGBkXHx/9oACAEBAAE/EE6xzUADkrrg7ytETVRTZqLriYECNAgHn+4wT2bIYGd4VhFAajqbc5d9yGigBbEnvR9QfKvnnPwpR8swVKLS6QVWr+bxb9D2iqPUr7xYgk0YWSzay/vWPJjGk0I2yrj4xoElraYMUZvtuFcEh8h4S72dYh0GgSGDq6vUesi+mplpKA5iTeA6exiCx4Xf3moeNkXKcdkPi5DUXZteBXZrAXadyGKjifPfeKfQ4yKwCPgwhaamyz65MFstq8378GSEpULZ3LxklSWLNfuFVpIAEdX3+Z//2Q==',
		co_creator_image: 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBQYFBAYGBQYHBwYIChAKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMCUoKSj/2wBDAQcHBwoIChMKChMoGhYaKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCj/wgARCAAoACgDASIAAhEBAxEB/8QAGwAAAgIDAQAAAAAAAAAAAAAAAAUEBgIDBwH/xAAYAQEBAQEBAAAAAAAAAAAAAAADAQIABP/aAAwDAQACEAMQAAAB6Nho8BKvBcadbmFCOnXoLPTMIJELOeirAMXUVQQENUByUgOP/8QAHxAAAwACAgIDAAAAAAAAAAAAAQIDAAQFERBBISIz/9oACAEBAAEFAsObXLymw5nozqLJ89uehDXkLbkRsT49qyJH221InEhpj89+5iPd+iisEwh2zk0lnvcuBKzqi23tinj/xAAbEQACAwADAAAAAAAAAAAAAAAAAQIDEhARMf/aAAgBAwEBPwHBjjQmTmkyT6LrJeCP/8QAGxEAAwACAwAAAAAAAAAAAAAAAAECAxIQETH/2gAIAQIBAT8B2NkNCQ0RPaIRjle8f//EACEQAAEDAwUBAQAAAAAAAAAAAAEAAhEDEBIhIjFBUSOh/9oACAEBAAY/ArFrGOeeF9qDmj1B9I5NN6j8RkSnUxAKezcGT+rRZeIHsEhR2hSZ2ZNt3CMDbK00C3P3joWdAyjlS9sjlH6EDwaW/8QAIRABAAICAQMFAAAAAAAAAAAAAQARITFBUWGhgZHB0eH/2gAIAQEAAT8hamsFSHLQwhG3D6YFDQSPVZk3zNhNjWjtLHAWZtJYze1dIHn2jo7JpiuMaJAUsDDmWu5m4nxgoKrblCCz1H0yIFDpOR9ZymzB/UBCDA8kQN6xPVn/2gAMAwEAAgADAAAAEI+T28jgYAf/xAAYEQEBAQEBAAAAAAAAAAAAAAABABEhMf/aAAgBAwEBPxA0xx7AZ1y0MmFjVmHLWF4S2//EABgRAQEBAQEAAAAAAAAAAAAAAAEAESFx/9oACAECAQE/EPN0zJR5DFYqEC9nmjtl/8QAIBABAAICAgIDAQAAAAAAAAAAAQARIUExYVFxgaGxwf/aAAgBAQABPxAaMqZOIhY4aP65U+IkBqFWvYH0zqwM/T4eoCioNTP+6yhSRmZCMC4HlxCDupSg4a8emZ8BsARUjs21DADdlWtwDdoKbVtJh3geEbz+ywSDViEfnZQs653d48SrfR/YNKxtaIK6sF1TeXvtjG8ZzqVq7sRb5pmvmGo0f2P7ChCUVpkurjqeWcJsvzxiMVOoCgvFma1Cqoq5t/Z//9k=',
    };
  },
  methods: {
	//Root methods
	method_name: function(datetime_input,seconds){
	},
	get_warrior__success: function(view,arguments){
		app.data.get_warrior = arguments;
		setTimeout(function(){app.views[view.goto].router.navigate('/warrior/');},100);
	},
  },


});


var app2 = new Vue({
  el: '#app-2',
  data: {
    message: 'You loaded this page on ' + new Date().toLocaleString()
  }
})


Template7.registerHelper('t7helper_formatedDate', function (datetime_input, seconds){
		
		// Today, 10:10 AM
		// Yesterday, 10:10 AM
		// Mon, 01 Jan, 10:10 AM
		// 01 Jan 2017, 10:10 AM

		datetime_input_split=datetime_input.split(' ');
		datetime_converted_split=new Date(datetime_input).toString().split(' ');

		date = new Date(datetime_input).toString().substring(0,15);

		day_name = datetime_converted_split[0];
		month_name = datetime_converted_split[1];
		day_number = datetime_converted_split[2];
		year = datetime_converted_split[3];
		
		today = new Date().toString().substring(0,15);
		yesterday = new Date();yesterday.setDate(new Date().getDate()-1);

		if(seconds==0){time = datetime_input_split[1].substring(0,5) + ' ' + datetime_input_split[2];}else{time = datetime_input_split[1] + ' ' + datetime_input_split[2];}

		if(date==today){date='Today'}
		else if(date==yesterday){date='Yesterday'}

		if( year != new Date().getFullYear() ) {date=day_number+' '+month_name+' '+year}else{date=day_name+', '+day_number+' '+month_name}

		return date + ', ' + time;
});








//POST API FUNCTION
function http_api__post(view, type, params, retry){

	params['device'] = app.device.name;
	params['version'] = app.version;
	if(!params['passcode']&&app.form.getFormData("passcode")){params['passcode'] = app.form.getFormData("passcode").hash;}
		
	retry = retry || 0;

	result = '';

	if( params['progress'] && retry == 0 ){ app.dialog.progress(params['progress']); }
	else if( type == 'form' && retry == 0 ){ $('.panel-backdrop').show(); $('.page-current .form .submit i').hide(); $('.page-current .form .submit .preloader').show(); }

	app.request({

		async: true,

		method: 'POST',

		contentType: "application/json; charset=utf-8",

		url: 'https://www.jcpenney.tech/api/index.php',

		data: JSON.stringify(params),

		dataType: 'json',

		timeout: 30000,
		
		success: function(data, status, xhr){

			console.log("Response: SUCCESS\n\nStatus: " + status + "\n\nData: " + JSON.stringify(data) + "\n\n" + "XHR: " + JSON.stringify(xhr))
			
			retry = retry + 1;
			
			try{data = JSON.parse(data)}catch(e){}
						
			if(!data){result = {todo: 'alert', title: 'Sorry!', message: 'We did not receive any response from API server. Contact EWS support team to fix this issue.'};}
			
			else if(!data.todo){result = {todo: 'alert', title: 'Sorry!', message: 'We did not receive valid TDA response from API server. Contact EWS support team to fix this issue.'};}
			
			else if(data.todo != 'retry' && data.todo != 'alert' && data.todo != 'next' && data.todo != 'goto' && data.todo != 'alert_next' && data.todo != 'alert_goto'){result = {todo: 'alert', title: 'Sorry!', message: 'We did not receive valid CMD response from API server. Contact EWS support team to fix this issue.'};}
			
			else if(data.todo=='retry'){
				if( retry < 1 ){
					result = {todo: 'retry'};
				} else {
					result = {todo: 'alert', title: 'Sorry!', message: 'We did our best to reach API server but we couldn\'t succeed. Check your internet connectivity and retry.'};
				}
			}
					
			else if(data.todo.indexOf('alert')!=-1){
					if(!data.title||!data.message){
						result = {todo: 'alert', title: 'Sorry!', message: 'We did not receive valid ALT response from API server. Contact EWS support team to fix this issue.'};
					} else {
							if(data.todo.indexOf('next')!=-1){
								if(!data.next){
									result = {todo: 'alert', title: 'Sorry!', message: 'We did not receive valid ALTNXT response from API server. Contact EWS support team to fix this issue.'};
								} else {
									result = {todo: 'alert_next', title: data.title, message: data.message, next: data.next, arguments: data.arguments};
								}
							}
							
							else if(data.todo.indexOf('goto')!=-1){
								if(!data.goto){
									result = {todo: 'alert', title: 'Sorry!', message: 'We did not receive valid ALTGTP response from API server. Contact EWS support team to fix this issue.'};
								} else {
									result = {todo: 'alert_goto', title: data.title, message: data.message, goto: data.goto};
								}
							}

							else {
									result = {todo: 'alert', title: data.title, message: data.message};
							}
					}
			}

			else if(data.todo=='next'){
				if(!data.next){
					result = {todo: 'alert', title: 'Sorry!', message: 'We did not receive valid NXT response from API server. Contact EWS support team to fix this issue.'};
				} else {
					result = {todo: 'next', next: data.next, arguments: data.arguments};
				}
			}
			
			else if(data.todo=='goto'){
					if(!data.goto){
						result = {todo: 'alert', title: 'Sorry!', message: 'We did not receive valid GTP response from API server. Contact EWS support team to fix this issue.'};
					} else {
						result = {todo: 'goto', goto: data.goto};
					}
			}
			
			http_api__post__callback(view, type, params, retry, result);
		
		},
		
		error: function(xhr, status){
			
			console.log("Response: ERROR\n\nStatus: "+ status + '\n\nXHR: ' + JSON.stringify(xhr))

			retry = retry + 1;

			if( retry < 1 ){
				result = {todo: 'retry'};
			} else {
				result = {todo: 'alert', title: 'Sorry!', message: 'We did our best to reach API server but we couldn\'t succeed. Check your internet connectivity and retry.'};
			}

			http_api__post__callback(view, type, params, retry, result);

		}
		
	});

}

function http_api__post__callback(view, type, params, retry, result){
	setTimeout(function(){
	if(type == 'form' && result.todo != 'retry'){ $('.panel-backdrop').hide(); $('.page-current .form .submit i').show(); $('.page-current .form .submit .preloader').hide();}

	if(result.todo=='alert'){if(type != 'background'){app.dialog.close();app.dialog.alert(result.message,result.title,function(){if(view.onAlertCallback){if(view.methods=='root'){app.methods[view.onAlertCallback](view,result.arguments)}else{app.views[view.methods].router.currentPageEl.f7Component.methods[view.onAlertCallback](view,result.arguments)}}})}}
	else if(result.todo=='alert_next'){app.dialog.close();app.dialog.alert(result.message,result.title,function(){if(view.methods=='root'){app.methods[result.next](view,result.arguments)}else{app.views[view.methods].router.currentPageEl.f7Component.methods[result.next](view,result.arguments)}})}
	else if(result.todo=='alert_goto'){app.dialog.close();app.dialog.alert(result.message,result.title,function(){app.views[view.goto].router.navigate(result.goto)})}
	else if(result.todo=='next'){if(view.methods=='root'){app.methods[result.next](view,result.arguments)}else{app.views[view.methods].router.currentPageEl.f7Component.methods[result.next](view,result.arguments)}}
	else if(result.todo=='goto'){app.views[view.goto].router.navigate(view,result.goto)}
	else if(result.todo=='retry'){http_api__post(view, type, params, retry)}
	else if(result.todo=='nothing'){}
	},1000)
	//introduce alert and retry or show retry button
}

$(document).once("click",".view-left,.view-main,.view-right",function(){
	app.root.trigger('resize')
})

$(document).on("click","a[data-goto]",function(){
	view = $(this).parents('.view').attr('data-name');
	if($(this).attr('data-view')){view = $(this).attr('data-view').replace('.view-','')}
	page = $(this).attr('data-goto');
	delay = 456;if(app.theme=='ios'){delay=0}
	setTimeout(function(){app.views[view].router.navigate(page)},delay);
});


$(document).on("click","*[data-action-get-warrior]",function(){
	view = $(this).parents('.view').attr('data-name');
	http_api__post({methods:'root',goto:view},'silent',{progress: 'Fetching warrior details..', todo: 'get_warrior', email: $(this).attr('data-action-get-warrior')});
});

$(document).on("click","a[data-link]",function(){
	window.open($(this).attr('data-link'), '_blank');
});

//Form input click parent enhanced focus
$(document).on("click", ".form .item-content", function() {
	$(this).find(".item-input-wrap input,.item-input-wrap textarea").focus();
});

function refresh_tasks_created_by_me(arguments){
		tasks = app.form.getFormData('tasks')
		tasks.push(arguments)
		app.form.storeFormData('tasks', tasks)
		app.data['settings'] = tasks;
		app.router.navigate('/account/?goto=tasks&focus=1');
}
