<div class="dashboard__sidebar dashboard__sidebar--colaborador" id="sidebar">
    <nav class="dashboard__menu dashboard__menu--colaborador">
        <a href="/colaborador/dashboard" class="dashboard__enlace <?php echo pagina_actual('/lista') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-clipboard-list dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Lista
            </span>
        </a>
        <a href="/colaborador/perfil" class="dashboard__enlace <?php echo pagina_actual('/miembros') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Perfil
            </span>
        </a>
    </nav>
</div>