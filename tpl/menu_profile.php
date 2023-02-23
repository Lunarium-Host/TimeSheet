<li class="nav-item nav-profile dropdown">
	<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
		<img src="/images/faces/face28.jpg" alt="Профайл"/>
	</a>
	<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
		<!-- <a class="dropdown-item" href="/secure/companies/"><i class="ti-settings text-primary"></i> Компании</a> -->
		<a class="dropdown-item" href='/secure/users/'><i class="ti-user text-primary"></i> Пользователи</a>
		<a class="dropdown-item" href="#"><i class="ti-tag text-primary"></i> Версия: <?= include('ver.txt'); ?></a>
		<a class="dropdown-item" href='/secure/profile/'><i class="ti-user text-primary"></i> Настройки</a>
		<a class="dropdown-item" href='/secure/?logout=true'><i class="ti-power-off text-primary"></i> Выход</a>
	</div>
</li>