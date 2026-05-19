<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="create-page animate-fade-in">
  <div class="create-wrap">
    <div class="form-shell">
      <div class="form-hero">
        <div class="form-hero-content">
          <span class="form-badge">Employer Portal</span>
          <h1>Create Job Listing</h1>
          <p>Post a new opportunity and reach the right candidates faster.</p>
        </div>
      </div>

      <form method="POST" action="<?= url('/listings') ?>" class="job-form">
        <div class="form-section">
          <div class="section-heading" style="display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1.5rem;">
            <span class="section-step" style="background: var(--primary-color, #10b981); color: white; border-radius: 50%; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0;">01</span>
            <div>
              <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600;">Job Information</h2>
              <p style="margin: 0.25rem 0 0; color: #6b7280; font-size: 0.9rem;">Provide the core details about the position you are offering.</p>
            </div>
          </div>

          <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>

          <div class="form-grid">
            <div class="form-group full">
              <label for="title">Job Title</label>
              <input type="text" id="title" name="title" placeholder="Frontend Developer" class="form-input"
                value="<?= sanitize($listing['title'] ?? $listing->title ?? '') ?>" required />
            </div>

            <div class="form-group full">
              <label for="description">Job Description</label>
              <textarea id="description" name="description" rows="5" placeholder="Describe the role, responsibilities, and expectations..." class="form-input" required><?= sanitize($listing['description'] ?? $listing->description ?? '') ?></textarea>
            </div>

            <div class="form-group">
              <label for="salary">Annual Salary</label>
              <input type="text" id="salary" name="salary" placeholder="₱500,000" class="form-input"
                value="<?= sanitize($listing['salary'] ?? $listing->salary ?? '') ?>" required />
            </div>

            <div class="form-group">
              <label for="requirements">Requirements</label>
              <input type="text" id="requirements" name="requirements" placeholder="React, Tailwind, PHP" class="form-input"
                value="<?= sanitize($listing['requirements'] ?? $listing->requirements ?? '') ?>" />
            </div>

            <div class="form-group full">
              <label for="benefits">Benefits</label>
              <input type="text" id="benefits" name="benefits" placeholder="Health insurance, remote work, bonuses" class="form-input"
                value="<?= sanitize($listing['benefits'] ?? $listing->benefits ?? '') ?>" />
            </div>

            <div class="form-group full">
              <label for="tags">Tags</label>
              <input type="text" id="tags" name="tags" placeholder="frontend, developer, php" class="form-input"
                value="<?= sanitize($listing['tags'] ?? $listing->tags ?? '') ?>" />
            </div>
          </div>
        </div>

        <div class="form-section" style="margin-top: 2rem; border-top: 1px solid #e5e7eb; padding-top: 2rem;">
          <div class="section-heading" style="display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1.5rem;">
            <span class="section-step" style="background: var(--primary-color, #10b981); color: white; border-radius: 50%; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0;">02</span>
            <div>
              <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600;">Company Information & Location</h2>
              <p style="margin: 0.25rem 0 0; color: #6b7280; font-size: 0.9rem;">Add the company details applicants need before applying.</p>
            </div>
          </div>

          <div class="form-grid">
            <div class="form-group full">
              <label for="company">Company Name</label>
              <input type="text" id="company" name="company" placeholder="Prosple Inc." class="form-input"
                value="<?= sanitize($listing['company'] ?? $listing->company ?? '') ?>" />
            </div>

            <div class="form-group full">
              <label for="address">Address</label>
              <input type="text" id="address" name="address" placeholder="123 Business Ave" class="form-input"
                value="<?= sanitize($listing['address'] ?? $listing->address ?? '') ?>" />
            </div>

            <div class="form-group">
              <label for="city">City</label>
              <input type="text" id="city" name="city" placeholder="Manila" class="form-input"
                value="<?= sanitize($listing['city'] ?? $listing->city ?? '') ?>" required />
            </div>

            <div class="form-group">
              <label for="state">State / Province</label>
              <input type="text" id="state" name="state" placeholder="Metro Manila" class="form-input"
                value="<?= sanitize($listing['state'] ?? $listing->state ?? '') ?>" required />
            </div>

            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" id="phone" name="phone" placeholder="+63 912 345 6789" class="form-input"
                value="<?= sanitize($listing['phone'] ?? $listing->phone ?? '') ?>" />
            </div>

            <div class="form-group">
              <label for="email">Application Email</label>
              <input type="email" id="email" name="email" placeholder="jobs@company.com" class="form-input"
                value="<?= sanitize($listing['email'] ?? $listing->email ?? '') ?>" required />
            </div>
          </div>
        </div>

        <div class="action-row" style="margin-top: 2.5rem; display: flex; gap: 1rem; align-items: center;">
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-floppy-disk"></i> Save Job
          </button>

          <a href="<?= url('/listings') ?>" class="btn btn-secondary">
            <i class="fa fa-xmark"></i> Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</section>

<?php loadPartial('footer'); ?>