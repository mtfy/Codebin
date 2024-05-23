<h1>Codebin</h1>
<div>
	<p>Codebin is a lightweight alternative to <a href="https://en.wikipedia.org/wiki/Pastebin" target="_blank"><img src="https://i.imgur.com/A4SH1Ak.png" width="14" height="14" alt="Pastebin">&#160;Pastebin</a> built on top of <a href="https://github.com/laravel/laravel">the Laravel PHP Framework</a>. Feel free to use this as a reference, inspiration, or a base for your new project.</p>
 	<p><a href="https://github.com/laravel/laravel"><img src="https://img.shields.io/badge/Framework-Laravel-f55247" alt="Laravel" /></a>&#160;<a href="https://github.com/mtfy"><img src="https://img.shields.io/badge/Author-mtfy-399cbd" alt="Laravel" /></a></p>
</div>
<br />
<h2>About Codebin</h2>
<div>
	<p>Codebin is a privacy focused text sharing application which I designed and developed within a very small timeframe for my academic display on a programming course in Information and Communications Technology. I do not recommend using this in production unless you are skilled enough with Laravel to perform your own tests. The purpose for this repository is simply a Proof of Concept.</p>
	<ul>
		<li>Cleanly written Controllers, Models, and Helpers following the official standards defined in <a href="https://laravel.com/docs/10.x/">Laravel documentation</a></li>
		<li>hCAPTHCA protection against robots based on <a href="https://github.com/scyllaly/hCaptcha">scyllaly/hCaptcha</a></li>
		<li>Automatic paste deletion, if expiry is set</li>
		<li>Password protected pastes</li>
		<li>Option to view syntax highlighted snippet, or simply just a raw plain text version</li>
		<li>Responsive user interface for all devices</li>
	</ul>
</div>
<br />
<h2>Demo</h2>
<div>
	<a href="https://www.youtube.com/watch?v=xsyQqKXHgOE"><img src="https://i.imgur.com/DnOjdxN.jpg" width="426" height="240" alt="Codebin demo - 2024-05-23" /></a>
	<br />
	<a href="https://www.youtube.com/watch?v=xsyQqKXHgOE">&#x25b6;&#xfe0f; <strong>Watch on YouTube</strong></a>
</div>

<br />
<h2>Installation</h2>
<div>
	<p>Purchase a VPS for developing and deploying applications in staging and/or production. You may install it locally as well for development and testing purposes, steps below.</p>
	<ol>
		<li>Run <code>composer install</code> to install Laravel and its dependencies</li>
		<li>Run <code>npm i</code> to install <a href="https://tailwindcss.com/docs/installation">Tailwind</a> and <a href="https://vitejs.dev/">Vite</a></li>
		<li>Edit the <code>.env</code> file and fill in your MySQL host and its credentials</li>
		<li>Run the database migrations with <code>php artisan migrate</code></li>
		<li>Launch Laravel in development mode with <code>php artisan serve</code> and Vite with <code>npm run dev</code></li>
	</ol>
</div>
<br />
<h2>Remarks</h2>
<div>
	<ul>
		<li>Sign up and create an API key for <a href="https://www.hCaptcha.com/">hCaptcha</a> and place them accordingly in your <code>.env</code> file</li>
		<li>In order for the expired paste deletion to work properly, set an automatic task with command <code>php artisan app:process-expired-pastes</code> once a minute (eg. <a href="https://crontab.guru/examples.html">Crontab</a> for Linux and <a href="https://learn.microsoft.com/en-us/windows/win32/taskschd/task-scheduler-start-page">Task Scheduler</a> for Windows operating systems)</li>
	</ul>
</div>
<br />
<h2>Contributing</h2>
<div>
	<p>Contributors are welcome. Please follow the existing naming, and syntax policy for your pull request to be accepted.</p>
</div>
<br />
<h2>Plans for Future</h2>
<div>
	<ul>
		<li>Finish the optional user account system to allow users edit their own pastes when authenticated</li>
		<li>Add light theme</li>
		<li>Improve overall user experience</li>
		<li>Add a server-side encryption for contents of password protected pastes</li>
		<li>Implement a rate-limiting algorithm to prevent mass scraping (this can be achieved with eg. Cloudflare for now)</li>
		<li>Purchase a domain and setup a live demo in production</li>
	</ul>
</div>
