<?php
if (!defined('GENERATING_PDF')) {
    http_response_code(403);
    exit('Forbidden'); // opcional: pode redirecionar para home/admin
}

require_once __DIR__ . '/vendor/autoload.php';

use Athena272\SerenattoCafeteria\Database\ConnectionCreator;
use Athena272\SerenattoCafeteria\Infrastructure\Repository\PdoProductRepository;

// 1) Busca dados
$pdo = ConnectionCreator::createConnection();
$repo = new PdoProductRepository($pdo);
$products = $repo->fetchAllProducts();

// 2) Monta HTML do relatório
$today = (new DateTime('now'))->format('Y-m-d H:i');
$logoPath = __DIR__ . '/img/logo-serenatto-horizontal.png';

// Se quiser exibir o logo no PDF via file://, precisamos de caminho absoluto:
$logoSrc = file_exists($logoPath) ? $logoPath : '';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Serenatto - Product Report</title>
    <style>
        @page {
            margin: 28px 28px 40px;
        }

        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px;
        }

        .header img {
            height: 48px;
        }

        .title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
        }

        .meta {
            font-size: 11px;
            color: #666;
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background: #f2e3c8;
            color: #333B1E;
            text-align: left;
        }

        tr:nth-child(even) td {
            background: #fafafa;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            background: #eee;
            font-size: 11px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="header">
    <?php if ($logoSrc): ?>
        <img src="file:///<?= str_replace('\\', '/', $logoSrc); ?>" alt="Serenatto">
    <?php endif; ?>
    <div>
        <div class="title">Product Report</div>
        <div class="meta">Generated at: <?= htmlspecialchars($today) ?></div>
    </div>
</div>

<table>
    <thead>
    <tr>
        <th style="width: 30%;">Product</th>
        <th style="width: 14%;">Type</th>
        <th style="width: 41%;">Description</th>
        <th style="width: 15%;" class="right">Price</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($products)): ?>
        <tr>
            <td colspan="4" class="center">No products found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p->getName()) ?></td>
                <td><span class="badge"><?= htmlspecialchars($p->getType()) ?></span></td>
                <td><?= htmlspecialchars($p->getDescription()) ?></td>
                <td class="right"><?= $p->getFormattedPrice() ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<div class="footer">Serenatto Café &amp; Bistrô — <?= date('Y') ?></div>
</body>
</html>