<h2  id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-botones">
    <a href="/directivo/dashboard/futbol">Fútbol</a>
    <a href="/directivo/dashboard/futsal">Futsal</a>
    <a href="/directivo/dashboard/futfem">Femenino</a>
    <a href="/directivo/dashboard/playa">Playa</a>
</div>

<h2  id="heading" class="margin dashboard__heading">Panel de control</h2>
<div class="dashboard__contenedor-botones2">
    <div class="dashboard__contenedor-botones2--boton">
        <a href="/directivo/dashboard/usuarios">Usuarios</a>
    </div>
    <div class="dashboard__contenedor-botones2--boton">
        <a href="/directivo/dashboard/modalidades">Modalidad</a>
    </div>
    <div class="dashboard__contenedor-botones2--boton">
        <a href="/directivo/dashboard/categorias">Categorías</a>
    </div>
    <div class="dashboard__contenedor-botones2--boton">
        <a href="/directivo/dashboard/turnos">Turnos</a>
    </div>
    <div class="dashboard__contenedor-botones2--boton">
        <a href="/directivo/dashboard/perfil?id=<?php echo $usuario->id; ?>">Perfil</a>
    </div>
</div>