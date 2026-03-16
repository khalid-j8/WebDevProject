<?php

require_once __DIR__ . '/db.php';

function getDefaultSettings(): array
{
    return [
        'site_theme' => 'theme-classic',
    ];
}

function ensureSiteSettingsTable(): void
{
    $pdo = getDatabaseConnection();

    if ($pdo === null) {
        return;
    }

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS site_settings (
            setting_key VARCHAR(100) PRIMARY KEY,
            setting_value VARCHAR(255) NOT NULL,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )'
    );
}

function getSiteSettings(): array
{
    $defaults = getDefaultSettings();
    $pdo = getDatabaseConnection();

    if ($pdo === null) {
        return $defaults;
    }

    ensureSiteSettingsTable();

    $statement = $pdo->query('SELECT setting_key, setting_value FROM site_settings');
    $rows = $statement->fetchAll();

    foreach ($rows as $row) {
        $defaults[$row['setting_key']] = $row['setting_value'];
    }

    return $defaults;
}

function getThemeOptions(): array
{
    return [
        'theme-classic' => [
            'name' => 'Classic Light',
            'description' => 'White, grey, and navy with a clean editorial feel.',
        ],
        'theme-slate' => [
            'name' => 'Slate Modern',
            'description' => 'Cool slate surfaces with deeper blue accents.',
        ],
        'theme-luxe' => [
            'name' => 'Luxe Contrast',
            'description' => 'Bright ivory surfaces with rich navy and gold-toned highlights.',
        ],
    ];
}

function updateSiteTheme(string $themeKey): array
{
    $themes = getThemeOptions();

    if (!isset($themes[$themeKey])) {
        return [false, 'Invalid theme selected.'];
    }

    $pdo = getDatabaseConnection();

    if ($pdo === null) {
        return [false, 'Database connection is not available.'];
    }

    ensureSiteSettingsTable();

    $statement = $pdo->prepare(
        'INSERT INTO site_settings (setting_key, setting_value)
         VALUES (:setting_key, :setting_value)
         ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)'
    );

    $statement->execute([
        'setting_key' => 'site_theme',
        'setting_value' => $themeKey,
    ]);

    return [true, 'Site theme updated successfully.'];
}
