(async() => {

	window.__Framework = {

		'helpers': {

			getElemPosition	:	(e) => {
				const position = {
					x: 0,
					y: 0
				};

				if (null === e) {
					return position;
				}

				var rect = null;

				try {
					rect = e.getBoundingClientRect();
				} catch (err) {
					rect = null;
					window.console.error(`Unable to calculate getBoundingClientRect for ${e.tagName ?? 'NULL'}`, e);
				}

				if (null !== rect) {
					position.x = Math.round( rect.x );
					position.y = Math.round( rect.y );
				} else {
					while (e) {      
						if (e.tagName) {
							position.y = top + e.offsetTop;
							position.x = left + e.offsetLeft;       
							e = e.offsetParent;
						} else {
							e = e.parente;
						}
					}
				}

				return position;
			},


			getTimezoneOffset		:	()	=>	{
				var d = null;

				try {
					d = new Date().getTimezoneOffset()
				} catch (err) {
					window.console.error(`Unable to resolve local timezone offset`, err);
					d = null;
				}
				
				return d;
			},


			getTime					:	()	=>	{
				var d = new Date();
				return new Date(Date.UTC(d.getUTCFullYear(), d.getUTCMonth(), d.getUTCDate(), d.getUTCHours(), d.getUTCMinutes(), d.getUTCSeconds(), d.getUTCMilliseconds())).getTime();
			},


			getMeta			:	(name)	=>	{
				if (null === name || 'string' !== typeof name || 0 === name.trim().length)
					return '';
				
				const meta = document.querySelector(`meta[name="${name}"][content]`);
				if (null !== meta) {
					const attr = meta.getAttribute('content');
					if (null !== attr && 'string' === typeof attr) {
						return attr;
					}
				}
				return '';
			},


			randomString			:	(length = 8, characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')	=>	{
				if (null === length || 'number' !== typeof length) {
					length = 8;
				}

				if (null === characters || 'string' !== typeof characters) {
					characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
				}

				var buffer = '';
				
				while (length--) {
					buffer += characters[Math.floor(Math.random() * characters.length)];
				}

				return buffer;
			},


			checkNavigationSrollPos	:	() => {
				const nav = document.querySelector('.active-navigation'),
					__scrollY = window.scrollY || 0;
				
				if (null !== nav) {
					if (__scrollY >= 75) {
						if (!nav.classList.contains('nav-shadow')) {
							nav.classList.add('nav-shadow');
						}
					} else {
						if (nav.classList.contains('nav-shadow')) {
							nav.classList.remove('nav-shadow');
						}
					}
				}
			},


			showToast				:	(type = 'info', message, closeAfterMs = 5000) => {

				if (null === type || 'string' !== typeof type) {
					type = 'info';
				}

				var styleClass = 'jgrowl_info';

				switch (type) {
					case 'success':
						styleClass = 'jgrowl_success';
						break;

					case 'warning':
						styleClass = 'jgrowl_warning';
						break;
					
					case 'error':
						styleClass = 'jgrowl_error';
						break;

					default:
						styleClass = 'jgrowl_info';
						
				}

				try {
					$.jGrowl(`${message.toString()}`, {
						life: parseInt(closeAfterMs) || 5000,
						theme: styleClass
					});
				} catch (err) {}
			},

			
			initializeCodeMirror	:	async(elem, options)	=>	{
				return new Promise(async(resolve, reject) => {

					if (null === elem || 'object' !== typeof elem || !('innerHTML' in elem) || null == options || 'object' !== typeof options)
						reject(false);

					var editor = null;

					options.value = elem.innerHTML;

					try {
						editor = CodeMirror.fromTextArea(elem , options);
					} catch(err) {
						editor = null;
						reject(err);
					}

					if (null !== editor) {
						window.__Framework.__cache.CM.editor = editor;
					}

					resolve(true);

				});
			}


		},

		'__cache': {
			CM: {
				editor: null,
				view: {
					data: null
				}
			}
		}

	}

	

	Number.prototype.zeroPad = function(l) {
		l = l || 2;
		return (new Array(l).join('0') + this).slice(l * -1);
	 };

	window.addEventListener('scroll', window.__Framework.helpers.checkNavigationSrollPos);
	window.addEventListener('resize', window.__Framework.helpers.checkNavigationSrollPos);

	window.__Framework.helpers.checkNavigationSrollPos();

})(),
$(async() => {

	/*********************************************************************
	 * 
	 * Extending jQuery
	 * 
	 */

	$.loadScript = (url, options ) => {
		var __options = $.extend( options || {}, {
			dataType:	'script',
			cache:		true,
			async:		true,
			url:		url
		} );
	
		return $.ajax( __options );
	}


	await $.loadScript('https://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.9/jquery.jgrowl.min.js').done(async function(a, b) {
		window.console.log(`Loaded jGrowl v.1.4.9`);
	}).fail(async function(a, b, c) {
		window.console.warn(`Unable to load and initialize jGrowl`);
	});


	function showSpinner(form) {
		if (null === form || 'object' !== typeof form) {
			return;
		}
		const b = $(form).find('#submit'), c = $(form).find('.CodeMirror');
		if (b.length) {
			$(b).find('svg:nth-child(1)').addClass('__hidden');
			$(b).find('svg:nth-child(2)').removeClass('__hidden');
			const d = $(b).find('div:nth-child(2)');
			if (d.length) {
				var t = $(d).text();
				if (null === t || 'string' !== typeof t) {
					t = '';
				}
				$(d).attr('data-text', t).attr('aria-hidden', 'true').addClass('__hidden').text('');
				
			}
			
		}

		if (c.length) {
			$(c).addClass('loading-bg');
		}
	}

	function hideSpinner(form) {
		if (null === form || 'object' !== typeof form) {
			return;
		}
		const b = $(form).find('#submit'), c = $(form).find('.CodeMirror');
		if (b.length) {
			$(b).find('svg:nth-child(1)').removeClass('__hidden');
			$(b).find('svg:nth-child(2)').addClass('__hidden');
			const d = $(b).find('div:nth-child(2)');
			if (d.length) {
				var t = $(d).attr('data-text');
				if (null === t || 'string' !== typeof t) {
					t = '';
				}
				$(d).removeAttr('data-text').removeAttr('aria-hidden').removeClass('__hidden').text(t);
				
			}
		}

		
		if (c.length) {
			$(c).removeClass('loading-bg');
		}
	}

	function disableForm(form) {
		if (null === form || 'object' !== typeof form) {
			return;
		}
		$(form).find('input, select, button[type="submit"]').prop('disabled', true);
	}

	function enableForm(form) {
		if (null === form || 'object' !== typeof form) {
			return;
		}
		$(form).find('input, select, button[type="submit"]').prop('disabled', false).removeAttr('aria-disabled');
	}

	function disableCodeEditor() {
		try {
			window.__Framework.__cache.CM.editor.setOption('readOnly', true);
		} catch (err) {}
	}

	function enableCodeEditor() {
		try {
			window.__Framework.__cache.CM.editor.setOption('readOnly', false);
		} catch (err) {}
	}

	function processCaptchaError(err, form = null) {

		var message = null;

		if (null !== err && 'string' === typeof err) {
			err = err.trim().toLowerCase();
			switch (err) {
				case 'rate-limited':
					message = 'You are being rate limited by hCaptcha API. Please try again later.'
					break;
				
				case 'network-error':
					message = 'There are network connection issues with hCaptcha endpoints. Please try again later.';
					break;

				case 'invalid-data':
					message = 'Invalid data is not accepted by hCaptcha endpoints. Please try again later.';
					break;

				case 'challenge-error':
					message = 'Challenge encountered error on setup';
					break;

				case 'challenge-closed':
					message = 'Captcha challenge closed by user. Please verify that you are not a robot.';
					break;
				
				case 'challenge-expired':
					message = 'Time limit to answer challenge has expired.';
					break;

				case 'missing-captcha':
					message = 'No captcha was found. This is probably our fault so please try again or contact the site administrator.';
					break;

				case 'invalid-captcha-id':
					message = 'Captcha does not exist for ID provided. This is probably our fault so please try again or contact the site administrator.'
					break;

				case 'internal-error':
					message = 'hCaptcha client encountered an internal error. There is nothing we can do about it. Please try again.'
					break;

				default:
					message = 'Please verify that you are not a robot.';
			}
		}

		window.console.warn('hCaptcha challenge failed', err);
		window.__Framework.helpers.showToast('warning', message, 7500);

		enableCodeEditor();
		enableForm(form);
		hideSpinner(form);
	}


	/*********************************************************************
	 * 
	 * Authenticaton: Password Protected Paste
	 * 
	 */

	const authPasteForm = $('#authPasteForm');

	if (authPasteForm.length) {
		
		const token = $(authPasteForm).find('input[name="token"]').val();

		enableForm(authPasteForm);

		$(authPasteForm).on('submit', async function(event) {
			event.preventDefault();
			disableForm(authPasteForm);
			showSpinner(authPasteForm);


			const form = {
				password:	$('#password').val(),
				_token	:	$('input[name="_token"][type="hidden"]').val()
			};

			const result = {
				'success'	:	false
			};

			$.ajax({
				url: `/paste/auth/${token}`,
				cache: false,
				async: true,
				method: 'POST',
				dataType: 'text',
				headers: {
					'Cache-Control'	:	'no-cache',
					'Pragma'		:	'no-cache'
				},
				data: form
			}).done(function (response, textStatus, jqXHR) {

				var data = null;

				if (null !== response && 'string' === typeof response) {
					try {
						data = JSON.parse(response);
					} catch (err) {
						data = null;
						window.console.warn('Unable to parse response', err);
					}
				}

				if (null !== data && 'object' === typeof data && 'success' in data && 'boolean' === typeof data.success && true === data.success) {
					result.success = true;
					var message = ('message' in data && null !== data.message && 'string' === typeof data.message && data.message.trim().length > 0) ? data.message.trim() : 'Success';
					window.__Framework.helpers.showToast('success', message, 2500);
					window.setTimeout(() => {
						window.location.reload();
					}, 2501);

				} else {
					var message = (null !== data && null !== data.message && 'string' === typeof data.message && data.message.trim().length > 0) ? data.message.trim() : 'Sorry, but something went wrong.';
					window.__Framework.helpers.showToast('error', message, 5000);
				}
				
			}).fail(function (jqXHR, textStatus, errorThrown) {
				
				var data = null;
				try {
					data = JSON.parse(jqXHR.responseText);
				} catch (err) {
					data = null;
				}

				if (null !== data) {
					if ('success' in data) {
						result.success = data.success;
					}
				}

				var message = (null !== data.message && 'string' === typeof data.message && data.message.trim().length > 0) ? data.message : 'Sorry, but something went wrong.'
				window.__Framework.helpers.showToast('error', message, 5000);

			}).always(function (jqXHR, textStatus, err) {
				if (!result.success) {
					enableForm(authPasteForm);
				}

				hideSpinner(authPasteForm);
			});
		});
	}



	/*********************************************************************
	 * 
	 * View Paste
	 * 
	 */

	const viewPasteForm = $('#viewPasteForm');

	if (viewPasteForm.length) {

		window.__Framework.__cache.CM.view.data = $('#__data').text();

		$('#__data').html('').remove();

		const textArea = document.getElementById('editor');
		
		var options = {
			darkTheme: true,
			lineNumbers: true,
			readOnly: true,
			lineWrapping: true,
			spellcheck: false,
			autocorrect: false,
		};

		if ('__szkfrm' in window && null !== window.__szkfrm && 'object' === typeof window.__szkfrm && Object.entries(window.__szkfrm).length === 2 && 'mode' in window.__szkfrm && 'string' === typeof window.__szkfrm.mode && String(window.__szkfrm.mode).trim().length > 0) {
			const mode = window.__szkfrm.mode;
			if ('htmlmixed' === mode) {
				options['mode'] = {
					name: 'htmlmixed',
					scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i, mode: null}, {matches: /(text|application)\/(x-)?vb(a|script)/i, mode: 'vbscript'}]
				};
			} else {
				options['mode'] = mode;
			}
		}

		await window.__Framework.helpers.initializeCodeMirror(textArea, options).then(async(result) => {
			
			try {
				window.__Framework.__cache.CM.editor.getDoc().setValue(window.__Framework.__cache.CM.view.data);

				$('#textarea-wrapper').css({
					'visibility': '',
					'min-height': '',
					'height': ''
				});
			} catch (err) {
				window.console.error('Unable to update textarea value', err);
			}

			$('#copy').on('click', async function(e) {
				if (null === e || 'object' !== typeof e || !('which' in e) || null === e.which) {
					return;
				}

				e.preventDefault();

				if (e.which === 1) {
					var failed = false;

					$(this).prop('disabled', true).attr('aria-disabled', true);

					try {
						navigator.clipboard.writeText(window.__Framework.__cache.CM.view.data);
					} catch (err) {
						window.console.error('Unable to write text to clipboard', err);
						failed = true;
					}
				
					if (!failed) {
						window.__Framework.helpers.showToast('info', 'Copied text to clipboard!', 5000);
					}

					window.setTimeout(() => {
						$('#copy').removeAttr('aria-disabled').prop('disabled', false);
					}, 1000);
				}
				
			});

			$('#download').on('click', async function(e) {
				if (null === e || 'object' !== typeof e || !('which' in e) || null === e.which) {
					return;
				}

				e.preventDefault();

				if (e.which === 1) {

					$(this).prop('disabled', true).attr('aria-disabled', true);

					var filename = $(this).attr('data-token');
					if (null === filename || 'string' !== typeof filename) {
						filename = window.__Framework.helpers.randomString(7);
					}
					
					const a = document.createElement('a');

					var buffer = '';

					try {
						buffer = encodeURIComponent(window.__Framework.__cache.CM.view.data)
					} catch (err) {
						window.console.error('Unable to alter the download content', err);
						buffer = '';
					}
					
					a.setAttribute('href', 'data:text/plain;charset=utf-8,' + buffer);
					a.setAttribute('download', `${filename}.txt`);

					a.classList.add('__hidden');
					a.setAttribute('aria-hidden', 'true');
					a.setAttribute('rel', 'noindex nofollow');

					document.body.appendChild(a);

					a.click();

					window.setTimeout(() => {
						a.remove();
					}, 125);
					

					window.setTimeout(() => {
						$('#download').removeAttr('aria-disabled').prop('disabled', false);
					}, 1000);
				}
			});

			$('#download, #copy').removeAttr('aria-disabled').prop('disabled', false);

		}).catch(async(error) => {
			window.console.error('Unable to initialize CodeMirror', error);
		});
	}


	/*********************************************************************
	 * 
	 * Create Paste
	 * 
	 */

	const createPasteForm = $('#createPasteForm');
	if (createPasteForm.length) {

		function processErrors(errors) {
			
			for (const [key, value] of Object.entries(errors)) {
				
				switch (key) {

					case 'content': {
						
						$('#createPasteForm .CodeMirror').addClass('input-error');
						$('#createPasteForm #content-error').removeClass('__hidden').removeAttr('aria-hidden').text(value);

						window.setTimeout(() => {
							$('#createPasteForm .CodeMirror').removeClass('input-error');
							$('#createPasteForm #content-error').addClass('__hidden').attr('aria-hidden', 'true').text('');
						}, 10000);
						
						break;
					}

					default: {
						$(`#createPasteForm #${key}`).addClass('input-error');
						$(`#createPasteForm #${key}-error`).removeClass('__hidden').removeAttr('aria-hidden').text(value);

						window.setTimeout(() => {
							$(`#createPasteForm #${key}`).removeClass('input-error');
							$(`#createPasteForm #${key}-error`).addClass('__hidden').attr('aria-hidden', 'true').text('');
						}, 10000);
					}

				}
			}

		}

		const textArea = document.getElementById('editor'), options = {
			darkTheme: true,
			lineNumbers: true,
			spellcheck: false,
			autocorrect: false,
		};

		await window.__Framework.helpers.initializeCodeMirror(textArea, options).then(async(result) => {
			$('#textarea-wrapper').css({
				'visibility': '',
				'min-height': '',
				'height': ''
			});

			$(createPasteForm).find('#submit').removeAttr('aria-disabled').prop('disabled', false);
		}).catch(async(error) => {
			window.console.error('Unable to initialize CodeMirror', error);
		});

		$('#privacy').on('change', async function(event) {
			if ($(this).val() === '2') {
				$('#password-wrapper').removeAttr('aria-hidden').removeClass('__hidden')
			} else {
				$('#password-wrapper').attr('aria-hidden', 'true').addClass('__hidden')
			}
		});

		$(createPasteForm).on('submit', async function(event) {
			event.preventDefault();
			disableForm(createPasteForm);
			showSpinner(createPasteForm);
			disableCodeEditor();

			const result = {
				'success'	:	false,
				'message'	:	null,
				'errors'	:	[],
				'data'		:	[]
			};

			try {
				await window.hcaptcha.execute(window.__hCaptchaWidgetID, { async: true }).then(async({ response, key }) => {
	
					const form = {
						'title'					:	$('#title').val(),
						'content'				:	window.__Framework.__cache.CM.editor.getValue(),
						'syntax'				:	$('#syntax').val(),
						'expire'				:	$('#expire').val(),
						'privacy'				:	$('#privacy').val(),
						'password'				:	$('#password').val(),
						'_token'				:	$('input[name="_token"][type="hidden"]').val(),
						'h-captcha-response'	:	response
					};
		
					$.ajax({
						url: '/paste/create',
						cache: false,
						async: true,
						method: 'POST',
						dataType: 'text',
						headers: {
							'Cache-Control'	:	'no-cache',
							'Pragma'		:	'no-cache'
						},
						data: form
					}).done(function (response, textStatus, jqXHR) {
		
						var data = null;
		
						if (null !== response && 'string' === typeof response) {
							try {
								data = JSON.parse(response);
							} catch (err) {
								data = null;
								window.console.warn('Unable to parse response', err);
							}
						}
		
						if (null !== data && 'object' === typeof data && 'success' in data && 'boolean' === typeof data.success && true === data.success) {
		
							result.success = data.success;
		
							if ('message' in data && null !== data.message && 'string' === typeof data.message) {
								result.message = data.message;
							}
		
							if ('data' in data && null !== data.data && 'undefined' !== typeof data.data) {
								result.data = data.data;
							}
							
							window.__Framework.__cache.CM.editor.getDoc().setValue('');
							window.__Framework.helpers.showToast('success', 'Successfully created a paste! Redirecting...', 2500);
							window.setTimeout(() => {
								window.location.href = `/view/${result.data.id}`;
							}, 2500);
		
						} else {
							var message = (null !== result.message && 'string' === typeof result.message && result.message.trim().length > 0) ? result.message : 'Sorry, but something went wrong.'
							window.__Framework.helpers.showToast('error', message, 5000);
						}
						
					}).fail(function (jqXHR, textStatus, errorThrown) {
						
						var data = null;
						try {
							data = JSON.parse(jqXHR.responseText);
						} catch (err) {
							data = null;
						}
		
						if (null !== data) {
							if ('errors' in data && Object.keys(data.errors).length > 0) {
								result.errors = data.errors;
								processErrors(result.errors);
							}
							if ('message' in data) {
								result.message = data.message;
							}
							if ('success' in data) {
								result.success = data.success;
							}
						}
		
						var message = (null !== result.message && 'string' === typeof result.message && result.message.trim().length > 0) ? result.message : 'Sorry, but something went wrong.'
						window.__Framework.helpers.showToast('error', message, 5000);
		
					}).always(function (jqXHR, textStatus, err) {
						if (!result.success) {
							enableForm(createPasteForm);
							enableCodeEditor();
						}
		
						hideSpinner(createPasteForm);
					});
				})
				.catch(async(err) => {
					processCaptchaError(err, createPasteForm);
				});
			} catch (err) {
				window.console.error('Unable to execute hCaptcha challenge.', err);

				if ('string' !== typeof err) {
					err = err.toString();
				}

				if (err.includes('Error: Cannot read properties of undefined')) {
					window.__Framework.helpers.showToast('error', 'Oops! Unable to present a captcha challenge. Please check your internet connectivity and disable any AdBlockers and try again.', 7500);
				} else {
					window.__Framework.helpers.showToast('error', 'Oops! You have caught a super rare error. This is probably our fault so contact the site administrator.', 7500);
				}

				window.setTimeout(() => {
					enableForm(createPasteForm);
					hideSpinner(createPasteForm);
					enableCodeEditor();
				}, 2500);
			}
		});
	}

});