
<?php
use Framework\Session;
Session::start();
$successMessage = Session::getFlashMessage('success_message');
$errorMessage = Session::getFlashMessage('error_message');
?>

<?php if ($successMessage !== null) : ?>
    <div class="container mx-auto max-w-6xl px-4 mt-4 animate-fade-in">
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded shadow-sm flex items-center justify-between" role="alert" style="background-color: #ecfdf5; border-left: 4px solid #10b981; color: #065f46; padding: 1rem; border-radius: 0.375rem; display: flex; align-items: center; justify-content: space-between;">
            <div class="flex items-center">
                <i class="fa-solid fa-circle-check mr-3 text-emerald-600" style="margin-right: 0.75rem; color: #059669; font-size: 1.25rem;"></i>
                <span class="font-medium"><?= sanitize($successMessage) ?></span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 focus:outline-none" style="background: none; border: none; cursor: pointer; color: #10b981; font-size: 1.25rem;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
<?php endif; ?>

<?php if ($errorMessage !== null) : ?>
    <div class="container mx-auto max-w-6xl px-4 mt-4 animate-fade-in">
        <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-4 rounded shadow-sm flex items-center justify-between" role="alert" style="background-color: #fff1f2; border-left: 4px solid #f43f5e; color: #9f1239; padding: 1rem; border-radius: 0.375rem; display: flex; align-items: center; justify-content: space-between;">
            <div class="flex items-center">
                <i class="fa-solid fa-circle-exclamation mr-3 text-rose-600" style="margin-right: 0.75rem; color: #e11d48; font-size: 1.25rem;"></i>
                <span class="font-medium"><?= sanitize($errorMessage) ?></span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-rose-500 hover:text-rose-700 focus:outline-none" style="background: none; border: none; cursor: pointer; color: #f43f5e; font-size: 1.25rem;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
<?php endif; ?>
