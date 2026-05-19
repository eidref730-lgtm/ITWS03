<?php
loadPartial('head');
loadPartial('navbar');
?>

<!-- Search Form -->
<section class="search-section" style="background: #f8fafc; padding: 2rem 0;">
    <div class="container mx-auto max-w-6xl px-4">
        <form method="GET" action="<?= url('/listings') ?>" class="flex flex-col md:flex-row gap-4 items-center justify-center">
            <input type="text" name="keywords" value="<?= isset($keywords) ? sanitize($keywords) : '' ?>" placeholder="Job title, keywords, or company" class="form-input flex-1 min-w-0" style="padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 1rem;" />
            <input type="text" name="location" value="<?= isset($location) ? sanitize($location) : '' ?>" placeholder="Location (city or state)" class="form-input flex-1 min-w-0" style="padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 1rem;" />
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem; background: #2563eb; color: white; border: none; border-radius: 0.375rem; font-weight: 600; font-size: 1rem; cursor: pointer;">Search Jobs</button>
        </form>
    </div>
</section>

<!-- Showcase Message Alert -->
<?php loadPartial('message'); ?>

<section class="jobs-section animate-fade-in">
    <div class="container mx-auto max-w-6xl px-4">
        <div class="jobs-section-header">
            <span class="jobs-section-badge">Opportunities</span>
            
            <?php if (!empty($keywords) || !empty($location)) : ?>
                <h1 class="jobs-section-title">Search Results</h1>
                <p class="jobs-section-subtitle" style="font-size: 1.1rem; color: #4b5563; margin-top: 0.5rem;">
                    Showing jobs matching
                    <?php if (!empty($keywords)) : ?><strong>"<?= sanitize($keywords) ?>"</strong><?php endif; ?>
                    <?php if (!empty($location)) : ?> in <strong>"<?= sanitize($location) ?>"</strong><?php endif; ?>
                </p>
                <a href="<?= url('/listings') ?>" style="display: inline-block; margin-top: 0.75rem; font-size: 0.9rem; color: #6b7280; text-decoration: underline;">
                    <i class="fa fa-xmark"></i> Clear search
                </a>
            <?php else : ?>
                <h1 class="jobs-section-title">Browse All Jobs</h1>
                <p class="jobs-section-subtitle">
                    Explore available openings across engineering, design, marketing, and data roles.
                </p>
            <?php endif; ?>
        </div>

        <?php if (empty($listings)) : ?>
            <div class="no-jobs" style="text-align: center; padding: 4rem 2rem; background: white; border-radius: 0.5rem; border: 1px dashed #d1d5db; margin: 2rem 0;">
                <i class="fa-regular fa-folder-open" style="font-size: 3rem; color: #9ca3af; margin-bottom: 1rem;"></i>
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No Opportunities Found</h3>
                <p style="color: #6b7280; max-width: 400px; margin: 0 auto 1.5rem;">
                    We couldn't find any job listings matching your search query. Try broadening your keywords or location.
                </p>
                <a href="<?= url('/listings') ?>" class="btn btn-primary" style="display: inline-block;">Browse All Jobs</a>
            </div>
        <?php else : ?>
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
        <?php endif; ?>

        <div class="back-link-wrap" style="margin-top: 3rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
            <a href="<?= url('/') ?>" class="back-link">
                <i class="fa fa-arrow-left"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </div>
</section>

<?php
loadPartial('footer');
?>