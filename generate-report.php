<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

define('GENERATING_PDF', true);

ob_start();
require_once __DIR__ . '/pdf-content.php';

$html = ob_get_clean();

// 3) Configura Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // permite carregar file:// ou http(s) se necessário
$options->set('defaultFont', 'DejaVu Sans'); // melhor suporte a acentuação

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// 4) Faz o stream (download). Attachment=true baixa; false abre no navegador
$filename = 'serenatto-products-' . date('Ymd-His') . '.pdf';
$dompdf->stream($filename, ['Attachment' => true]);
