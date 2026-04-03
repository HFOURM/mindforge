<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mindforge' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?php echo BASE_URL; ?>/css/output.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="<?php echo BASE_URL; ?>/js/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="flex flex-col min-h-screen w-full bg-white dark:bg-grey-500 text-grey-500 dark:text-white font-sans">
    <div id="app">
        <?= $content ?>
    </div>

    
</body>
</html>