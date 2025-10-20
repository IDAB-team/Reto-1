<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AnuncioModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';


class AnuncioController extends BaseController {
    public function index() {
        session_start(); 

        // Header según tipo de usuario
        $header = 'headerSinSession.php';
        $user = null;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            if ($user['tipo'] === 'Cliente') {
                $header = 'headerSessionComprador.php';
            } elseif ($user['tipo'] === 'Comerciante') {
                $header = 'headerSessionVendedor.php';
            }
        }
        
        $listaAnuncios = AnuncioModel::getAll();
        $listaCategorias = CategoriaModel::getAll();

        $this->render('anuncio.view.php', [
        'listaAnuncios' => $listaAnuncios,
        'listaCategorias' => $listaCategorias,
        'header' => $header
        ]);    
    }

    public function getAll(){
        $listaAnuncios=AnuncioModel::getAll();
        $this->render('anuncio.view.php', ['listaAnuncios' => $listaAnuncios]);
    }
    // Devuelve anuncios que contienen una palabra en su nombre
    public function apiBuscarPorNombre() {
        header('Content-Type: application/json');

        // Obtener el texto desde la URL
        $texto = $_GET['texto'] ?? '';

        // Conexión a la base de datos
        $db = Database::getConnection();

        // Consulta SQL con LIKE para buscar coincidencias en el nombre
        $sql = "SELECT a.Nombre AS nombreAnuncio, a.Precio AS precioAnuncio, a.Descripcion AS descripcionAnuncio, u.Username AS usernameAnuncio
                FROM Anuncios a
                JOIN Usuarios u ON a.ID_Usuario = u.ID_Usuario
                WHERE a.Nombre LIKE :texto";

        $stmt = $db->prepare($sql);
        $stmt->execute(['texto' => "%$texto%"]);

        // Devolver resultados como JSON
        echo json_encode($stmt->fetchAll());
        exit;
    }
    public function getByNameCategory(){
        header('Content-Type: application/json');

        // Obtener el nombre de la categoría desde la URL
        $categoria = $_GET['categoria'] ?? '';

        $db = Database::getConnection();

        // Consulta SQL para filtrar por categoría
        $sql = "SELECT a.Nombre AS nombreAnuncio, a.Precio AS precioAnuncio, a.Descripcion AS descripcionAnuncio, u.Username AS usernameAnuncio
                FROM Anuncios a
                JOIN Usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN Categorias c ON c.ID_Categoria = a.ID_Categoria
                WHERE c.Nombre = :categoria";

        $stmt = $db->prepare($sql);
        $stmt->execute(['categoria' => $categoria]);

        // Devolver resultados como JSON
        echo json_encode($stmt->fetchAll());
        exit;
    }

    // Devuelve anuncios ordenados por precio (ascendente o descendente)
    public function apiOrdenarPorPrecio() {
        header('Content-Type: application/json');

        $orden = $_GET['orden'] ?? 'ASC'; // Puede ser 'ASC' o 'DESC'

        $db = Database::getConnection();
        $sql = "SELECT a.Nombre AS nombreAnuncio, a.Precio AS precioAnuncio, a.Descripcion AS descripcionAnuncio, u.Username AS usernameAnuncio
                FROM Anuncios a
                JOIN Usuarios u ON a.ID_Usuario = u.ID_Usuario
                ORDER BY a.Precio " . ($orden === 'DESC' ? 'DESC' : 'ASC');

        $stmt = $db->prepare($sql);
        $stmt->execute();

        echo json_encode($stmt->fetchAll());
        exit;
    }

}