Здравствуйте <i>{{ $demo->receiver }}</i>,
<p>Вы были зарегестрированы в системе.</p>

<p><u>Данные для входа:</u></p>

<div>
    <p><b>Логин:</b>&nbsp;{{ $demo->login }}</p>
    <p><b>Пароль:</b>&nbsp;{{ $demo->password }}</p>
</div>

С Уважением,
<br/>
<i>{{ $demo->sender }}</i>
