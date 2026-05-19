<?php if (isset($errors) && !empty($errors)) : ?>
    <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-4 rounded shadow-sm mb-6 animate-fade-in" style="background-color: #fff1f2; border-left: 4px solid #f43f5e; color: #9f1239; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem;">
        <div class="flex items-center mb-2" style="display: flex; align-items: center; margin-bottom: 0.5rem; font-weight: 600;">
            <i class="fa-solid fa-triangle-exclamation mr-2" style="margin-right: 0.5rem; color: #e11d48;"></i>
            <span>Please correct the following errors:</span>
        </div>
        <ul class="list-disc pl-5" style="margin: 0; padding-left: 1.25rem; list-style-type: disc;">
            <?php foreach ($errors as $error) : ?>
                <li class="text-sm" style="font-size: 0.875rem; margin-bottom: 0.25rem;"><?= sanitize($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
