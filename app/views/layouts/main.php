<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mindforge' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= BASE_URL; ?>/css/output.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/global.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="<?= BASE_URL; ?>/js/utils.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<script>
console.log('MAIN LOADED');
console.log(typeof showToast);

document.addEventListener('DOMContentLoaded', () => {

    if (typeof showToast === 'function') {

        showToast(
            'Test Toast',
            'Toast berhasil dipanggil',
            'success'
        );

    } else {

        console.log('showToast tidak ditemukan');

    }

});
</script>

<body class="flex flex-col min-h-screen w-full bg-white dark:bg-grey-500 text-grey-500 dark:text-white font-sans">

    <div id="app">
        <?= $content ?>
    </div>

    <!-- Toast Container -->
    <div
        id="toastContainer"
        class="fixed bottom-5 right-5 z-[9999] flex flex-col gap-3">
    </div>

    <?php if (isset($_SESSION['toast'])): ?>

        <script>
            document.addEventListener(
                'DOMContentLoaded',
                function() {

                    showToast(
                        <?= json_encode($_SESSION['toast']['title']) ?>,
                        <?= json_encode($_SESSION['toast']['message']) ?>,
                        <?= json_encode($_SESSION['toast']['type']) ?>
                    );

                }
            );
        </script>

        <?php unset($_SESSION['toast']); ?>

    <?php endif; ?>

</body>

</html>