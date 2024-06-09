<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <img src="application/images/logo-system.png" style="height: 30px;top: 11px;position: relative;"/>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span style="cursor: pointer;" class="m-r-sm text-muted welcome-message" onClick="nextPage('?module=cadastro&acao=edita_usuario', <?php echo $_SESSION['gestaoVeiculos_userId'];?>);"><i class="fa fa-user"> </i> <?php echo $_SESSION['gestaoVeiculos_userName'];?></span>
            </li>
            <li>
                <a href="?module=index&acao=logout">
                    <i class="fa fa-sign-out"></i>Sair
                </a>
            </li>
        </ul>
    </nav>
</div>