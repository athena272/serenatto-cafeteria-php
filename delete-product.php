<?php
session_start();

require_once 'vendor/autoload.php';

use Athena272\SerenattoCafeteria\Database\ConnectionCreator;
use Athena272\SerenattoCafeteria\Infrastructure\Repository\PdoProductRepository;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Bloqueia acesso direto via GET
    http_response_code(405);
    echo "Método não permitido.";
    exit;
}

// Validação básica do id
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    echo "ID inválido.";
    exit;
}

try {
    $connection = ConnectionCreator::createConnection();
    $repository = new PdoProductRepository($connection);

    $repository->deleteProductById($id);

    $_SESSION['flash_message'] = "Produto excluído com sucesso!";
    header('Location: admin.php');
    exit;
} catch (Exception $e) {
    $_SESSION['flash_message'] = "Erro ao excluir produto: " . $e->getMessage();
    echo "Erro ao excluir produto: " . $e->getMessage();
}
