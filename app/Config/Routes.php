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
$routes->get('Acceso/respondida', 'Acceso::encuesta_respondida');
$routes->get('aspirante/generarFalsosAspirantes/(:num)', 'Aspirante::generarFalsosAspirantes/$1');
$routes->post('aspirante/toggle-examen', 'Aspirante::toggleExamen');
$routes->post('aspirantes/cargarCSV', 'Aspirante::cargarCSV');
$routes->get('aspirantes/imprimirSeleccionados', 'Aspirante::imprimirSeleccionados');


$routes->get('aspirante/documentacion', 'Documentacion::index');
$routes->get('ver_documento/(:segment)/(:segment)', 'Documentacion::verDocumento/$1/$2');
$routes->post('aspirante/subir_documento', 'Documentacion::subir_documento');
$routes->post('aspirante/eliminar_documento', 'Documentacion::eliminar_documento');
$routes->get('documentacion/aspirantes', 'Documentacion::indexAdmin');
$routes->get('admin/documentos/ver/(:segment)', 'Documentacion::ver/$1');
$routes->post('admin/documentos/actualizar', 'Documentacion::actualizar');







$routes->get('convocatoria/crear', 'Convocatoria::index');
$routes->post('convocatoria/guardar', 'Convocatoria::guardar');
$routes->get('getFechasConvocatoria/(:segment)', 'Convocatoria::getFechasConvocatoria/$1');



$routes->post('aspirantes/generarPrefichas', 'Encuesta::generarPrefichas');
$routes->get('aspirantes/preficha', 'Encuesta::obtenerPreficha');

$routes->get('aulas/crear', 'Aulas::index');
$routes->post('aulas/guardar', 'Aulas::guardar');

$routes->get('aulas/editar/(:num)', 'Aulas::editar/$1');
$routes->post('aulas/actualizar/(:num)', 'Aulas::actualizar/$1');
$routes->get('getAulasPorSede/(:num)', 'Aulas::getAulasPorSede/$1');



$routes->get('grupos-examen', 'GruposExamen::index');
$routes->post('grupos-examen/guardar', 'GruposExamen::guardar');
$routes->get('grupos-examen/editar/(:num)', 'GruposExamen::editar/$1');
$routes->post('grupos-examen/actualizar/(:num)', 'GruposExamen::actualizar/$1');

$routes->get('Asignacion', 'Asignacion::index');
$routes->get('grupos-examen/aspirantes/(:num)', 'GruposExamen::aspirantes/$1');
$routes->post('grupos-examen/asignar/(:num)', 'GruposExamen::asignar/$1');
$routes->get('grupos-examen/eliminarAspirante/(:num)/(:segment)', 'GruposExamen::eliminarAspirante/$1/$2');
$routes->get('grupos-examen/imprimir-lista/(:num)', 'GruposExamen::imprimirLista/$1');







$routes->get('Servicios/entrega', 'Preficha::vistaEntregaDocumentacion');



