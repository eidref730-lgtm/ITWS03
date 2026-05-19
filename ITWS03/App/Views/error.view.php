
<?php
if (!isset($status)) $status = 404;
if (!isset($message)) $message = 'Sorry, the requested page is not accessible or does not exist.';
?>
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="error-page animate-fade-in">
    <div class="error-wrap">
        <div class="error-card">
            <div class="error-icon-wrap">
                <div class="error-icon-spin">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
            </div>

            <span class="error-badge">Error <?= sanitize($status ?? 404) ?></span>
            <h1 class="error-title"><?= sanitize($status === 403 ? 'Access Denied' : 'Page Not Found') ?></h1>
            <p class="error-text">
                <?= sanitize($message ?? 'Sorry, the requested page is not accessible or does not exist.') ?>
            </p>

            <div class="error-actions">
                <a href="<?= url('/') ?>" class="btn error-btn-primary">
                    <i class="fa fa-house"></i>
                    Back to Home
                </a>

                <a href="<?= url('/listings') ?>" class="btn error-btn-secondary">
                    <i class="fa fa-briefcase"></i>
                    Browse Jobs
                </a>
            </div>
        </div>
    </div>
</section>

<?php loadPartial('footer'); ?>
