<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
			<p>Hi <strong>{{$firstname}}</strong> ,<br> Thanks for registering with NARC Knowledgebase.<br>
			To verify your email, please click in the link: {{ URL::to('email/verify?token=', $token) }}.<br/>
			This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.</p>
		</div>
	</body>
</html>
