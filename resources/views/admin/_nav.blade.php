<ul class="nav nav-tabs my-3">
    <li class="nav-item"><a class="nav-link {{ ($route == 'home')?'active':'' }}" href="{{ route('admin.index') }}">Главная</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'users')?'active':'' }}" href="{{ route('admin.users.index') }}">Пользователи</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'projects')?'active':'' }}" href="{{ route('admin.projects.index') }}">Проекты</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'editor')?'active':'' }}" href="{{ route('admin.editor.index') }}">Редактор</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'plans')?'active':'' }}" href="{{ route('admin.plans.index') }}">Планы</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'payments')?'active':'' }}" href="{{ route('admin.payments.index') }}">Платежи</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'advice')?'active':'' }}" href="{{ route('admin.advice.index') }}">Советы</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'faq')?'active':'' }}" href="{{ route('admin.faq.index') }}">FAQ</a></li>
</ul>
