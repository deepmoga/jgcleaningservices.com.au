<?php
declare(strict_types=1);
$seed = require dirname(__DIR__) . '/database/seed-content.php';
foreach ($seed['services'] as $service) {
    $faqText = '';
    foreach ($service['faqs'] as $faq) {
        $faqText .= ' ' . $faq['question'] . ' ' . $faq['answer'];
    }
    $text = html_entity_decode(strip_tags($service['content'])) . $faqText;
    $words = preg_split('/\s+/', trim($text));
    echo $service['slug'] . ': ' . count(array_filter($words)) . " words\n";
}
