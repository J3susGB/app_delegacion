<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\ArbitroController;
use Controllers\AsistenciaController;
use MVC\Router;
use Controllers\AuthController;
use Controllers\CategoriaController;
use Controllers\DashboardController;
use Controllers\ListaController;
use Controllers\ModalidadController;
use Controllers\PerfilController;
use Controllers\TurnoController;
use Controllers\UsuarioController;

$router = new Router();

//AUTH____________________________________________________________________________________________-
// Login
$router->get('/', [AuthController::class, 'login']);
$router->post('/', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

//DIRECTIVOS________________________________________________________________________________________
$router->get('/directivo/dashboard', [DashboardController::class, 'index']);
$router->get('/directivo/dashboard/futbol', [DashboardController::class, 'futbol']);
$router->get('/directivo/dashboard/futsal', [DashboardController::class, 'futsal']);
$router->get('/directivo/dashboard/futfem', [DashboardController::class, 'futfem']);
$router->get('/directivo/dashboard/playa', [DashboardController::class, 'playa']);
$router->get('/directivo/dashboard/usuarios', [DashboardController::class, 'usuarios']);
$router->get('/directivo/dashboard/modalidades', [DashboardController::class, 'modalidades']);
$router->get('/directivo/dashboard/categorias', [DashboardController::class, 'categorias']);
$router->get('/directivo/dashboard/turnos', [DashboardController::class, 'turnos']);
$router->get('/directivo/dashboard/perfil', [DashboardController::class, 'perfil']);

$router->get('/directivo/futbol/añadir', [ArbitroController::class, 'añadir_futbol']);
$router->post('/directivo/futbol/añadir', [ArbitroController::class, 'añadir_futbol']);
$router->get('/directivo/futbol/editar', [ArbitroController::class, 'editar_futbol']);
$router->post('/directivo/futbol/editar', [ArbitroController::class, 'editar_futbol']);
$router->post('/directivo/futbol/eliminar', [ArbitroController::class, 'eliminar_futbol']);
$router->get('/directivo/futsal/añadir', [ArbitroController::class, 'añadir_futsal']);
$router->post('/directivo/futsal/añadir', [ArbitroController::class, 'añadir_futsal']);
$router->get('/directivo/futsal/editar', [ArbitroController::class, 'editar_futsal']);
$router->post('/directivo/futsal/editar', [ArbitroController::class, 'editar_futsal']);
$router->post('/directivo/futsal/eliminar', [ArbitroController::class, 'eliminar_futsal']);

$router->get('/directivo/usuarios/añadir', [UsuarioController::class, 'añadir_usuario']);
$router->post('/directivo/usuarios/añadir', [UsuarioController::class, 'añadir_usuario']);
$router->get('/directivo/usuarios/editar', [UsuarioController::class, 'editar_usuario']);
$router->post('/directivo/usuarios/editar', [UsuarioController::class, 'editar_usuario']);
$router->post('/directivo/usuarios/eliminar', [UsuarioController::class, 'eliminar_usuario']);

$router->get('/directivo/modalidades/añadir', [ModalidadController::class, 'añadir_modalidad']);
$router->post('/directivo/modalidades/añadir', [ModalidadController::class, 'añadir_modalidad']);
$router->get('/directivo/modalidades/editar', [ModalidadController::class, 'editar_modalidad']);
$router->post('/directivo/modalidades/editar', [ModalidadController::class, 'editar_modalidad']);
$router->post('/directivo/modalidades/eliminar', [ModalidadController::class, 'eliminar_modalidad']);

$router->get('/directivo/categorias/añadir', [CategoriaController::class, 'añadir_categoria']);
$router->post('/directivo/categorias/añadir', [CategoriaController::class, 'añadir_categoria']);
$router->get('/directivo/categorias/editar', [CategoriaController::class, 'editar_categoria']);
$router->post('/directivo/categorias/editar', [CategoriaController::class, 'editar_categoria']);
$router->post('/directivo/categorias/eliminar', [CategoriaController::class, 'eliminar_categoria']);

$router->get('/directivo/turnos/añadir', [TurnoController::class, 'añadir_turno']);
$router->post('/directivo/turnos/añadir', [TurnoController::class, 'añadir_turno']);
$router->get('/directivo/turnos/editar', [TurnoController::class, 'editar_turno']);
$router->post('/directivo/turnos/editar', [TurnoController::class, 'editar_turno']);
$router->post('/directivo/turnos/eliminar', [TurnoController::class, 'eliminar_turno']);

$router->get('/directivo/perfil/editar', [PerfilController::class, 'editar_perfil_directivo']);
$router->post('/directivo/perfil/editar', [PerfilController::class, 'editar_perfil_directivo']);
$router->get('/directivo/perfil/cambiar_contraseña', [PerfilController::class, 'cambiar_contraseña']);
$router->post('/directivo/perfil/cambiar_contraseña', [PerfilController::class, 'cambiar_contraseña']);

$router->get('/directivo/lista', [ListaController::class, 'index']);
$router->post('/directivo/lista', [ListaController::class, 'index']);
$router->get('/directivo/lista/lista_fem', [ListaController::class, 'lista_fem']);
$router->post('/directivo/lista/lista_fem', [ListaController::class, 'lista_fem']);
$router->get('/directivo/lista/lista_playa', [ListaController::class, 'lista_playa']);
$router->post('/directivo/lista/lista_playa', [ListaController::class, 'lista_playa']);

$router->get('/directivo/asistencia', [AsistenciaController::class, 'index']);

//COLABORADORES________________________________________________________________________________________
$router->get('/colaborador/dashboard', [DashboardController::class, 'index_colaborador']);
$router->post('/colaborador/dashboard', [DashboardController::class, 'index_colaborador']);
$router->get('/colaborador/dashboard/lista_fem', [DashboardController::class, 'lista_fem']);
$router->post('/colaborador/dashboard/lista_fem', [DashboardController::class, 'lista_fem']);
$router->get('/colaborador/dashboard/lista_playa', [DashboardController::class, 'lista_playa']);
$router->post('/colaborador/dashboard/lista_playa', [DashboardController::class, 'lista_playa']);

$router->get('/colaborador/perfil', [PerfilController::class, 'index_colaborador']);
$router->get('/colaborador/perfil/editar', [PerfilController::class, 'editar_perfil_colaborador']);
$router->post('/colaborador/perfil/editar', [PerfilController::class, 'editar_perfil_colaborador']);
$router->get('/colaborador/perfil/cambiar_contraseña', [PerfilController::class, 'cambiar_contraseña_colaborador']);
$router->post('/colaborador/perfil/cambiar_contraseña', [PerfilController::class, 'cambiar_contraseña_colaborador']);

//APIS________________________________________________________________________________________
$router->get('/api/provinciales', [APIController::class, 'provinciales']);
$router->get('/api/oficiales', [APIController::class, 'oficiales']);
$router->get('/api/auxiliares', [APIController::class, 'auxiliares']);
$router->get('/api/fbase', [APIController::class, 'futbol_base']);
$router->get('/api/regional', [APIController::class, 'regional_futsal']);
$router->get('/api/nacional', [APIController::class, 'nacional_futsal']);
$router->get('/api/ningreso', [APIController::class, 'ni_futsal']);
$router->get('/api/femenino', [APIController::class, 'femenino']);
$router->get('/api/playa', [APIController::class, 'playa']);

$router->comprobarRutas();