/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./app/View/Components/**/*.php',
		'./resources/**/*.blade.php',
		'./resources/views/components/**/*.blade.php',
		'./storage/framework/views/*.php',
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./resources/**/*.js',
	],
	theme: {
		extend: {
			colors: {
				theme: {
					100: 'var(--color-theme-100)',
					200: 'var(--color-theme-200)',
					300: 'var(--color-theme-300)',
					400: 'var(--color-theme-400)',
					500: 'var(--color-theme-500)',
					600: 'var(--color-theme-600)',
					700: 'var(--color-theme-700)',
					800: 'var(--color-theme-800)',
					900: 'var(--color-theme-900)',
					background: {
						primary: 'var(--color-theme-500)',
						lighter: 'var(--color-theme-400)',
						darker: 'var(--color-theme-600)',
					},
					foreground: {
						primary: 'var(--color-text-theme)',
						contrast: 'var(--color-text-theme-contrast)',
						lighter: 'var(--color-text-theme-lighter)',
						darker: 'var(--color-text-theme-darker)',
						reverse: 'var(--color-text-theme-reverse)'
					}
				},
				alert: {
					danger: 'var(--color-alert-danger)',
					warning: 'var(--color-alert-warning)',
					success: 'var(--color-alert-success)',
					info: 'var(--color-alert-info)',
				},
				muted: 'var(--color-muted)',
				white: 'var(--color-white)',
				transparent: 'var(--color-transparent)',
				current: 'var(--color-current)',
			},
			fontFamily: {
				satoshi: 'var(--font-family-satoshi)',
				inter: 'var(--font-family-inter)'
			}
		},
	},
	plugins: [],
}