<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //rutas acceso principal
$routes->get('/', 'Acceso::index');
$routes->get('Acceso/principal', 'Acceso::principal');
$routes->post('Acceso/login', 'Acceso::login');
$routes->get('Acceso/logout', 'Acceso::logout');
$routes->get('error', 'Acceso::error');

//rutas repositorios
$routes->get('Repositorio/nuevo', 'Repositorio::nuevo');
$routes->post('Repositorio/nuevo', 'Repositorio::nuevo');

$routes->get('Repositorio/ver/(:num)', 'Repositorio::ver/$1');

$routes->get('Recurso/nuevo/(:num)', 'Recurso::nuevo/$1');
$routes->get('Recurso/agregar_link/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_csv/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_excel/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_evento/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_kml/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_geojson/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_coordenada/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_municipio/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_articulo/(:num)/(:alpha)', 'Recurso::agregar_articulo/$1/$2');
$routes->get('Recurso/agregar_tesis/(:num)/(:alpha)', 'Recurso::agregar_tesis/$1/$2');
$routes->get('Recurso/agregar_libro/(:num)/(:alpha)', 'Recurso::agregar_libro/$1/$2');
$routes->get('Recurso/agregar_libro_capitulo/(:num)/(:alpha)', 'Recurso::agregar_libro_capitulo/$1/$2');
$routes->get('Recurso/agregar_congreso/(:num)/(:alpha)', 'Recurso::agregar_congreso/$1/$2');
$routes->get('Recurso/agregar_proyecto_investigacion/(:num)/(:alpha)', 'Recurso::agregar_proyecto_investigacion/$1/$2');
$routes->get('Recurso/agregar_doc/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_imagen/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_correo/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_audio/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_pdf/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_pptx/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_sql/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_video/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->get('Recurso/agregar_zip/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');


$routes->post('Recurso/nuevo/(:num)', 'Recurso::nuevo/$1');
$routes->post('Recurso/agregar_link/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_csv/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_excel/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_evento/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_kml/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_geojson/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_coordenada/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_municipio/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_articulo/(:num)/(:alpha)', 'Recurso::agregar_articulo/$1/$2');
$routes->post('Recurso/agregar_tesis/(:num)/(:alpha)', 'Recurso::agregar_articulo/$1/$2');
$routes->post('Recurso/agregar_libro/(:num)/(:alpha)', 'Recurso::agregar_articulo/$1/$2');
$routes->post('Recurso/agregar_libro_capitulo/(:num)/(:alpha)', 'Recurso::agregar_articulo/$1/$2');
$routes->post('Recurso/agregar_congreso/(:num)/(:alpha)', 'Recurso::agregar_articulo/$1/$2');
$routes->post('Recurso/agregar_proyecto_investigacion/(:num)/(:alpha)', 'Recurso::agregar_articulo/$1/$2');
$routes->post('Recurso/agregar_doc/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_imagen/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_correo/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_audio/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_pdf/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_pptx/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_sql/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_video/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');
$routes->post('Recurso/agregar_zip/(:num)/(:alpha)', 'Recurso::agregar_link/$1/$2');


$routes->get('Repositorio/busqueda_general', 'Repositorio::busqueda_general');


$routes->get('upload', 'Upload::index');          // Add this line.
$routes->post('upload/upload', 'Upload::upload'); // Add this line.

//service('auth')->routes($routes);

$routes->get('Acceso/aspirante', 'Aspirante::index');
$routes->post('analizar-curp', 'Aspirante::analizar_curp');
$routes->post('guardar-aspirante', 'Aspirante::create');
$routes->get('getSedes', 'Sedes::getSedes');
$routes->get('getCarrerasPorSede/(:num)', 'Sedes::getCarrerasPorSede/$1');

$routes->get('Acceso/encuesta', 'Encuesta::index');
$routes->post('encuesta/guardar', 'Encuesta::create');
$routes->get('Acceso/aspirante_registrados', 'Aspirante::indexAs');
$routes->get('aspirante/editar/(:segment)', 'Aspirante::edit/$1');
$routes->post('aspirante/actualizar/(:segment)', 'Aspirante::update/$1');



