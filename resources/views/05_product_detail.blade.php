<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			ユーザー新規登録画面
		</title>
		<style>
			body {
				font-family: 'Arial', sans-serif;
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				margin: 0 auto;
			}
			a {
				color: initial;
				text-decoration: none;
				user-select: none;
				-webkit-user-select: none;
				-ms-user-select: none;
			}
			h2 {
				user-select: none;
				-webkit-user-select: none;
				-ms-user-select: none;
			}
			.main{
				text-align: center;
				box-sizing: border-box;
			}
			.main h2 {
				font-size: 50px;
			}
			form {
				display: inline-block;
				margin: 0 auto;
			}
			input {
				display: block;
				width: 50ch;
				font-size: 25px;
				margin-bottom: 40px;
			}
			.new-btn {
				margin-right: 200px;
				font-size: 16px;
				width: 100px;
				background-color: rgba(255, 165, 0, 0.7);
				padding: 10px 10px;
				border-radius: 20px;
				border: none;
			}
			.new-btn:hover {
				background-color: rgba(255, 165, 0, 1);
				padding: 10px 10px;
				border-radius: 20px;
				border: none;
			}
			.login-btn {		
				margin-left: 200px;
				width: 100px;
				font-size: 16px;
				background-color: rgba(0, 225, 255, 0.5);
				padding: 10px 10px;
				border-radius: 20px;
				border: none;
			}
			.login-btn:hover {		
				background-color: rgba(0, 225, 255, 1);
				padding: 10px 10px;
				border-radius: 20px;
				border: none;
				cursor: pointer;
			}
		</style>
	</head>
	<body>
		<div class="main">
			<h2>
				ユーザー新規登録画面
			</h2>
			@if ($errors->any())
    			<div style="color: red;">
        			<ul>
            			@foreach ($errors->all() as $error)
                		<li>
							{{ $error }}
						</li>
           				 @endforeach
        			</ul>
    			</div>
			@endif
			<form action="{{ url('/user_register') }}" method="post">
				@csrf
				<div class="input-text">
					<input type="password" name="password" placeholder="パスワード" required>
					<input type="email" name="email" placeholder="メールアドレス" required value="{{ old('email')}}">
				</div>
				<div class="input-btn">
					<button type="submit" class="new-btn">
						新規登録
					</button>
					<button class="login-btn" type="button" onclick="location.href='user_login'">
						戻る
					</button>
				</div>
			</form>
		</div>
	</body>
</html>
