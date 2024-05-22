<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
<style type="text/css">

body {
	background-color: #f5f5f5;
	margin: 0;
	padding: 0;
	font-family: Arial, sans-serif;
}

.container {
	max-width: 500px;
	margin: 50px auto;
	padding: 20px;
	background-color: #fff;
	border-radius: 5px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
	animation: fade-in 0.5s ease-in-out;
}

@keyframes fade-in {
	from {
		opacity: 0;
		transform: translateY(-20px);
	}

	to {
		opacity: 1;
		transform: translateY(0);
	}
}

h1 {
	color: #333;
	font-size: 24px;
	margin: 0 0 20px;
	padding: 0;
}

.logo {
	max-width: 150px;
	margin-bottom: 20px;
}

p {
	margin: 0 0 20px;
	color: #555;
	font-size: 16px;
	animation: fade-in 0.5s ease-in-out;
}

.error-code {
	font-size: 48px;
	font-weight: bold;
	color: #e13300;
	margin: 0;
	padding: 0;
	animation: bounce-in 0.5s ease-in-out;
}

@keyframes bounce-in {
	from {
		transform: scale(0);
	}

	to {
		transform: scale(1);
	}
}

.error-message {
	font-size: 16px;
	color: #555;
	margin: 10px 0;
	padding: 0;
	animation: fade-in 0.5s ease-in-out;
}

.back-link {
	color: #e13300;
	text-decoration: none;
	opacity: 0.8;
	transition: opacity 0.3s ease-in-out;
}

.back-link:hover {
	opacity: 1;
}

</style>
</head>
<body>
	<div class="container">
		<img src="path/to/logo.png" alt="Company Logo" class="logo">
		<h1>Error</h1>
		<p class="error-code"><?php echo $heading; ?></p>
		<p class="error-message"><?php echo $message; ?></p>
		<p><a href="#" class="back-link">&larr; Go back</a></p>
	</div>

	<script>
		// Animate the "Go back" link on page load
		document.addEventListener('DOMContentLoaded', function() {
			var backLink = document.querySelector('.back-link');
			backLink.style.animation = 'fade-in 0.5s ease-in-out';
			backLink.style.animationFillMode = 'forwards';
		});
	</script>
</body>
</html>
