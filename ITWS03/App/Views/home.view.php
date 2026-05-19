
<?php
if (!isset($listings)) $listings = [];
loadPartial('head');
loadPartial('navbar');
loadPartial('showcase');
?>

<!-- Showcase Message Alert -->
<?php loadPartial('message'); ?>

<section class="top-banner">
    <div class="container mx-auto max-w-6xl px-4">
        <h2>Career Opportunities</h2>
        <p>
            Discover job openings across multiple categories and employers.
        </p>
    </div>
</section>

<section class="jobs-section animate-fade-in">
    <div class="container mx-auto max-w-6xl px-4">
        <div class="jobs-section-header">
            <span class="jobs-section-badge">Latest Jobs</span>
            <h2 class="jobs-section-title">Recent Listings</h2>
            <p class="jobs-section-subtitle">
                Here are some of the recently posted job opportunities.
            </p>
        </div>

        <div class="jobs-grid">
            <?php foreach ($listings as $listing) : ?>
                <article class="job-card">
                    <div class="job-card-content">
                        <div class="job-card-top" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                            <span class="job-card-category" style="font-weight: 600; color: var(--primary);"><?= sanitize($listing->company ?? 'Company') ?></span>
                            <span class="job-badge" style="background-color: #e0f2fe; color: #0369a1; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">Active</span>
                        </div>
                        <h3 class="job-card-title" style="margin-bottom: 0.5rem; font-size: 1.25rem; font-weight: 700; color: #1f2937;"><?= sanitize($listing->title) ?></h3>
                        <p class="job-card-description" style="color: #6b7280; font-size: 0.95rem; margin-bottom: 1rem; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; height: 4.5rem;"><?= sanitize($listing->description) ?></p>
                        
                        <?php if (!empty($listing->tags)) : ?>
                            <div class="job-tags" style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1rem;">
                                <?php foreach (explode(',', $listing->tags) as $tag) : ?>
                                    <span class="tag-badge" style="background-color: #f3f4f6; color: #4b5563; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 500;">
                                        <?= sanitize(trim($tag)) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="job-card-meta" style="border-top: 1px solid #f3f4f6; padding-top: 1rem; margin-bottom: 1.25rem;">
                            <div class="job-meta-row">
                                <span class="job-meta-label">Salary</span>
                                <span class="job-salary" style="font-weight: 600; color: var(--primary);"><?= formatSalary($listing->salary) ?></span>
                            </div>
                            <div class="job-meta-row">
                                <span class="job-meta-label">Location</span>
                                <span class="job-location" style="color: #4b5563; font-weight: 500;"><?= sanitize($listing->city) ?>, <?= sanitize($listing->state) ?></span>
                            </div>
                        </div>

                        <a href="<?= url('/listings/' . $listing->id) ?>" class="job-details-btn" style="display: block; text-align: center; background-color: #f3f4f6; color: #1f2937; padding: 0.6rem; border-radius: 0.375rem; font-weight: 600; text-decoration: none; transition: all 0.2s;">View Details</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="jobs-footer-link-wrap" style="margin-top: 3rem;">
            <a href="<?= url('/listings') ?>" class="jobs-footer-link">
                <span>Show All Jobs</span>
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<section class="container mx-auto max-w-6xl px-4 mb-16">
    <div class="cta-banner">
        <div>
            <h2>Post a Job Opening</h2>
            <p>Share your job listing and reach more applicants.</p>
        </div>

        <a href="<?= url('/listings/create') ?>" class="btn btn-primary">
            <i class="fa fa-edit"></i>
            Post a Job
        </a>
    </div>
</section>

<?php
loadPartial('footer');
?>