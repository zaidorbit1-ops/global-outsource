<?php
declare(strict_types=1);

$breadcrumbItems = $breadcrumbItems ?? [];
$breadcrumbClass = $breadcrumbClass ?? 'breadcrumb section-shell';
?>
<nav class="<?= htmlspecialchars($breadcrumbClass, ENT_QUOTES, 'UTF-8') ?>" aria-label="Breadcrumb">
    <ol>
        <?php foreach ($breadcrumbItems as $index => $item): ?>
            <li>
                <?php if ($index < count($breadcrumbItems) - 1 && isset($item['url'])): ?>
                    <a href="<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8') ?>">
                        <?php if ($index === 0): ?>
                            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="m2.5 9 7.5-6 7.5 6v8a.8.8 0 0 1-.8.8h-4.4v-5.2H7.7v5.2H3.3a.8.8 0 0 1-.8-.8z"/></svg>
                        <?php endif; ?>
                        <span><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></span>
                    </a>
                <?php else: ?>
                    <span aria-current="page"><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
