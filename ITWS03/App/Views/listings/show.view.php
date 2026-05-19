<?php
use Framework\Authorization;
loadPartial('head');
loadPartial('navbar');
?>

<section class="container mx-auto max-w-4xl px-4 mt-8 animate-fade-in">
    <!-- Showcase Message Alert -->
    <?= loadPartial('message') ?>

    <div class="job-details-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <a href="<?= url('/listings') ?>" class="back-link">
            <i class="fa fa-arrow-left"></i>
            Back to Listings
        </a>

        <?php if (Authorization::isOwner($listing->user_id)) : ?>
            <div class="owner-controls" style="display: flex; gap: 0.75rem; align-items: center;">
                <a href="<?= url('/listings/edit/' . $listing->id) ?>" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                    <i class="fa fa-edit"></i> Edit Listing
                </a>

                <form method="POST" action="<?= url('/listings/' . $listing->id) ?>" onsubmit="return confirm('Are you sure you want to delete this listing?');" style="margin: 0;">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" style="background-color: #ef4444; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; font-size: 0.9rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: background 0.2s;">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- Main Listing Info Card -->
    <div class="job-card" style="background: white; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 2rem;">
        <div class="job-card-content" style="padding: 2.5rem;">
            <div class="job-card-top" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <span class="job-card-category" style="font-weight: 700; font-size: 1.1rem; color: var(--primary);"><?= sanitize($listing->company) ?></span>
                <span class="job-badge" style="background-color: #e0f2fe; color: #0369a1; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 700;">Verified Opening</span>
            </div>

            <h1 class="job-card-title text-3xl" style="font-size: 2rem; font-weight: 800; color: #111827; margin-bottom: 1rem;"><?= sanitize($listing->title) ?></h1>
            
            <p class="job-card-description" style="color: #4b5563; font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem; white-space: pre-line;"><?= sanitize($listing->description) ?></p>

            <?php if (!empty($listing->tags)) : ?>
                <div class="job-tags" style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem; border-bottom: 1px solid #f3f4f6; padding-bottom: 1.5rem;">
                    <?php foreach (explode(',', $listing->tags) as $tag) : ?>
                        <span class="tag-badge" style="background-color: #f3f4f6; color: #374151; padding: 0.35rem 0.75rem; border-radius: 0.375rem; font-size: 0.85rem; font-weight: 600;">
                            <i class="fa fa-tag" style="margin-right: 0.25rem; opacity: 0.6;"></i><?= sanitize(trim($tag)) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Job Specific Info Grid -->
            <div class="job-card-meta" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; background-color: #f9fafb; padding: 1.5rem; border-radius: 0.5rem; border: 1px solid #f3f4f6; margin-bottom: 2rem;">
                <div class="job-meta-row" style="display: flex; flex-direction: column; gap: 0.25rem;">
                    <span class="job-meta-label" style="font-size: 0.85rem; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Annual Compensation</span>
                    <span class="job-salary" style="font-size: 1.25rem; font-weight: 700; color: var(--primary);"><?= formatSalary($listing->salary) ?></span>
                </div>
                <div class="job-meta-row" style="display: flex; flex-direction: column; gap: 0.25rem;">
                    <span class="job-meta-label" style="font-size: 0.85rem; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Work Location</span>
                    <span class="job-location" style="font-size: 1.25rem; font-weight: 700; color: #374151;"><?= sanitize($listing->city) ?>, <?= sanitize($listing->state) ?></span>
                </div>
                <?php if (!empty($listing->phone)) : ?>
                    <div class="job-meta-row" style="display: flex; flex-direction: column; gap: 0.25rem;">
                        <span class="job-meta-label" style="font-size: 0.85rem; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Contact Phone</span>
                        <span class="job-location" style="font-size: 1.25rem; font-weight: 700; color: #374151;"><?= sanitize($listing->phone) ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Extended Info Tabs/Details -->
            <?php if (!empty($listing->requirements)) : ?>
                <div class="details-section" style="margin-bottom: 2rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa fa-list-check" style="color: var(--primary);"></i> Job Requirements
                    </h3>
                    <p style="color: #4b5563; font-size: 1.05rem; line-height: 1.6; white-space: pre-line;"><?= sanitize($listing->requirements) ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($listing->benefits)) : ?>
                <div class="details-section" style="margin-bottom: 2rem; border-top: 1px solid #f3f4f6; padding-top: 1.5rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa fa-gift" style="color: var(--primary);"></i> Benefits & Perks
                    </h3>
                    <p style="color: #4b5563; font-size: 1.05rem; line-height: 1.6; white-space: pre-line;"><?= sanitize($listing->benefits) ?></p>
                </div>
            <?php endif; ?>

            <div class="application-cta" style="border-top: 1px solid #e5e7eb; padding-top: 2rem; margin-top: 2rem; text-align: center;">
                <p style="color: #6b7280; font-size: 0.95rem; margin-bottom: 1.25rem;">
                    Interested? Put <strong style="color: #374151;">"Job Application"</strong> as the subject of your email and attach your resume.
                </p>
                <a href="mailto:<?= sanitize($listing->email) ?>" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; font-size: 1.1rem; padding: 0.75rem 2.5rem; border-radius: 0.375rem; text-decoration: none;">
                    <i class="fa fa-paper-plane"></i> Apply Now
                </a>
            </div>
        </div>
    </div>
</section>

<?php
loadPartial('footer');
?>
