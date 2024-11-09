<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <h1>{{ $subject }}</h1>

    <p>Dear {{ $recipient_name }},</p>

    <div>
        {!! nl2br(e($emailContent)) !!} <!-- Changed variable name here -->
    </div>

    <p>
        Thanks,<br>
        {{ config('app.name') }}
    </p>
</body>
</html>


{{--
<li class="slide">
    <a href="{{ route('admin.composer.inbox') }}" class="side-menu__item {{ request()->is('admin/composer/inbox*') ? 'active' : '' }}">Inbox</a>
</li>
<li class="slide">
    <a href="{{ route('admin.composer.email_compose') }}" class="side-menu__item {{ request()->is('admin/composer/email_compose*') ? 'active' : '' }}">Compose</a>
</li>
<li class="slide">
    <a href="{{ route('admin.composer.read') }}" class="side-menu__item {{ request()->is('admin/composer/read*') ? 'active' : '' }}">Read Email</a>
</li>
<li class="slide">
    <a href="{{ route('admin.composer.sent') }}" class="side-menu__item {{ request()->is('admin/composer/sent*') ? 'active' : '' }}">Sent Mail</a>
</li>
<li class="slide">
    <a href="{{ route('admin.composer.trash') }}" class="side-menu__item {{ request()->is('admin/composer/trash*') ? 'active' : '' }}">Trash</a>
</li> --}}
