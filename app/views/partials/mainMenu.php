<?php
    use Core\H;
    global $currentUser;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

		<a class="navbar-brand" href="<?=ROOT?>">ApTheme</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav mr-auto my-lg-0 navbar-nav-scroll">
				<?= H::navItem('blog/index', 'Home'); ?>
				<!--<li class="nav-item">
					<a class="nav-link" href="<?/*= ROOT; */?>">Home</a>
				</li>-->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown link
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<li><a class="dropdown-item" href="#">Action</a></li>
						<li><a class="dropdown-item" href="#">Another action</a></li>
						<li><a class="dropdown-item" href="#">Something else here</a></li>
					</ul>
				</li>
			</ul>
            <ul class="navbar-nav d-flex">
                <?php if(!$currentUser): ?>
                    <?= H::navItem('auth/login', 'Log In'); ?>
                <?php endif; ?>
                <?php if($currentUser): ?>
                    <li class="nav-item dropdown">
                        <a href="" class="nav.link dropdown-toggle" id="accountDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            Hello <?= $currentUser->fname; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
	                        <?= H::navItem('admin/articles', 'Author Portal', true); ?>
                            <li><hr class="dropdown-divider"></li>
	                        <?= H::navItem('auth/logout', 'Log Out', true); ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>

		</div>

</nav>