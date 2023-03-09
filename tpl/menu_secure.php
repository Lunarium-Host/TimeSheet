<?php global $user; ?> 
<ul class="nav">
	<li class="nav-item">
		<a class="nav-link" href="/secure/">
			<i class="ti-dashboard menu-icon"></i>
			<span class="menu-title">Задачи</span>
		</a>
	</li>
	<li class="nav-item">
<?php if ( $user['admin'] == 2 ) { ?>
		<a class="nav-link" href="/secure/companies">
			<i class="ti-write menu-icon"></i>
			<span class="menu-title">Компании</span>
		</a>
<?php } else { ?>
	<a class="nav-link" href="/secure/projects">
			<i class="ti-write menu-icon"></i>
			<span class="menu-title">Проекты</span>
		</a>
<?php } ?>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="javascript:addTask();">
			<i class="ti-plus menu-icon"></i>
			<span class="menu-title">Добавить задачу</span>
		</a>
	</li>
</ul>