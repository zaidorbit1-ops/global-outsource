<?php
$serviceSwitcherItems = [
    [
        'page' => 'accounting-finance',
        'url' => 'accounting-finance',
        'label' => 'Accounting &amp;<br>Finance Outsourcing',
        'icon' => '<path d="M4 20V9m5 11V5m5 15v-8m5 8V3M2 21h20"/><path d="m3 7 5-4 5 3 7-5"/>',
    ],
    [
        'page' => 'it-solutions',
        'url' => 'it-solutions',
        'label' => 'IT Solutions',
        'icon' => '<path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/>',
    ],
    [
        'page' => 'ai-solutions',
        'url' => 'ai-solutions',
        'label' => 'AI Solutions',
        'icon' => '<path d="M12 3a3 3 0 0 0-3 3v1a3 3 0 0 0-3 3v1a3 3 0 0 0 0 6h1a3 3 0 0 0 6 0V6a3 3 0 0 0-1-2.2M12 3a3 3 0 0 1 3 3v1a3 3 0 0 1 3 3v1a3 3 0 0 1 0 6h-1a3 3 0 0 1-6 0V6a3 3 0 0 1 1-2.2"/>',
    ],
    [
        'page' => 'software-development',
        'url' => 'software-development',
        'label' => 'Software Development',
        'icon' => '<path d="m8 8-4 4 4 4m8-8 4 4-4 4m-3-9-2 10"/>',
    ],
    [
        'page' => 'managed-it-services',
        'url' => 'managed-it-services',
        'label' => 'Managed IT Services',
        'icon' => '<rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8m-4-4v4m-5-13h10m-10 3h6"/>',
    ],
    [
        'page' => 'cloud-solutions',
        'url' => 'cloud-solutions',
        'label' => 'Cloud Solutions',
        'icon' => '<path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/>',
    ],
    [
        'page' => 'business-process-support',
        'url' => 'business-process-support',
        'label' => 'Business Process Support',
        'icon' => '<path d="M4 4h16v16H4z"/><path d="M8 8h8m-8 4h8m-8 4h5"/>',
    ],
];
?>
<nav class="service-switcher section-shell" aria-label="Explore our services">
    <?php foreach ($serviceSwitcherItems as $item): ?>
        <?php $isCurrentService = $item['page'] !== '' && $currentPage === $item['page']; ?>
        <a class="service-switcher-item<?= $isCurrentService ? ' is-current' : '' ?>" href="<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8') ?>"<?= $isCurrentService ? ' aria-current="page"' : '' ?>>
            <span class="switcher-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><?= $item['icon'] ?></svg></span>
            <span><?= $item['label'] ?></span>
            <span class="switcher-arrow" aria-hidden="true">›</span>
        </a>
    <?php endforeach; ?>
</nav>
