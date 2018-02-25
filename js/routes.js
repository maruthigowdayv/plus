var routes = [

{
path: '/compatibility-check/',
componentUrl: './pages/compatibility-check.html',
},

{
path: '/update/',
componentUrl: './pages/update.html',
},

{
path: '/passcode/',
componentUrl: './pages/passcode/index.html',
name: 'passcode',
routes: [
		{
			path: 'assistance/',
			componentUrl: './pages/passcode/assistance.html',
		},
		{
			path: 'create/',
			componentUrl: './pages/passcode/create.html',
		},
		{
			path: 'recover/',
			componentUrl: './pages/passcode/recover.html',
		},
		{
			path: 'faqs/',
			componentUrl: './pages/passcode/faqs.html',
		},
		{
			path: 'help/',
			componentUrl: './pages/passcode/help.html',
		},
		],
},

{
path: '/dashboards/',
componentUrl: './pages/dashboards/index.html',
routes: [
		{
			path: 'product-enrichment/',
			componentUrl: './pages/dashboards/product-enrichment.html',
		},
		{
			path: 'image-enrichment/',
			componentUrl: './pages/dashboards/product-enrichment.html',
		},
		{
			path: 'plano-assistance/',
			componentUrl: './pages/dashboards/plano-assistance.html',
		},
		],
},

{
path: '/panel-left/',
componentUrl: './pages/panel-left.html',
name: 'panel-left',
},

{
path: '/panel-right/',
componentUrl: './pages/panel-right.html',
name: 'panel-right',
},

{
path: '/account/',
componentUrl: './pages/account.html',
},

{
path: '/warrior/',
componentUrl: './pages/warrior.html',
},

{
path: '/tasks/',
componentUrl: './pages/tasks/index.html',
name: 'tasks',
routes: [
		{
			path: 'view/',
			componentUrl: './pages/tasks/view.html',
		},
		]
},

{
path: '/notifications/',
componentUrl: './pages/notifications/index.html',
name: 'notifications',
routes: [
		{
			path: 'view/',
			componentUrl: './pages/notifications/view.html',
		},
		]
},

{
path: '/settings/',
componentUrl: './pages/settings.html',
name: 'settings',
},

{
path: '/about/',
componentUrl: './pages/about/index.html',
routes: [
		{
			path: 'about-project-plus/',
			componentUrl: './pages/about/about-project-plus.html',
		},
		{
			path: 'vision-and-mission/',
			componentUrl: './pages/about/vision-and-mission.html',
		},

		{
			path: 'core-team-and-contributors/',
			componentUrl: './pages/about/core-team-and-contributors.html',
		},

		{
			path: 'platform-usage-and-stats/',
			componentUrl: './pages/about/platform-usage-and-stats.html',
		},

		{
			path: 'version-history/',
			componentUrl: './pages/about/version-history.html',
		},
		],
},

{
path: '/help/',
componentUrl: './pages/help/index.html',
name: 'help',
routes: [
		{
			path: 'videos/',
			componentUrl: './pages/help/videos.html',
		},
		{
			path: 'faqs/',
			componentUrl: './pages/help/faqs.html',
		},
		{
			path: 'support/',
			componentUrl: './pages/help/support.html',
		},
		],
},

{
path: '/modules/',
componentUrl: './pages/modules/index.html',
name: 'modules',
routes: [

		{
		path: 'get-more-modules/',
		componentUrl: './pages/modules/get-more-modules/index.html',
		routes: [
				{
					path: 'form/',
					componentUrl: './pages/modules/get-more-modules/form.html',
				},
				],
		},
		
		],
},

{
path: '(.*)',
componentUrl: './pages/404.html',
name: '404',
},

];
