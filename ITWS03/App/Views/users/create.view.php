<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="create-page">
  <div class="create-wrap animate-fade-in" style="max-width: 600px; margin: 3rem auto;">
    <div class="form-shell">
      <div class="form-hero" style="text-align: center; margin-bottom: 2rem;">
        <span class="form-badge">Join Us</span>
        <h1>Create Your Account</h1>
        <p>Register to start listing opportunities and finding top talent.</p>
      </div>

      <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>

      <form method="POST" action="<?= url('/auth/register') ?>" class="job-form">
        <div class="form-section">
          <h2>Account Details</h2>
          <div class="form-grid">
            <div class="form-group full">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name" placeholder="John Doe" class="form-input" value="<?= sanitize($user['name'] ?? '') ?>" required />
            </div>

            <div class="form-group full">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" placeholder="name@company.com" class="form-input" value="<?= sanitize($user['email'] ?? '') ?>" required />
            </div>

            <div class="form-group">
              <label for="city">City</label>
              <input type="text" id="city" name="city" placeholder="Manila" class="form-input" value="<?= sanitize($user['city'] ?? '') ?>" required />
            </div>

            <div class="form-group">
              <label for="state">State / Province</label>
              <input type="text" id="state" name="state" placeholder="Metro Manila" class="form-input" value="<?= sanitize($user['state'] ?? '') ?>" required />
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" placeholder="Min. 6 characters" class="form-input" required />
            </div>

            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" class="form-input" required />
            </div>
          </div>
        </div>

        <div class="action-row" style="margin-top: 2rem; display: flex; flex-direction: column; gap: 1rem; align-items: stretch;">
          <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; text-align: center; font-size: 1.05rem; padding: 0.8rem 1.5rem;">
            <i class="fa-solid fa-user-plus" style="margin-right: 0.5rem;"></i>
            Create Account
          </button>
          
          <p style="text-align: center; color: #6b7280; font-size: 0.95rem; margin-top: 1rem;">
            Already have an account? 
            <a href="<?= url('/auth/login') ?>" style="color: var(--primary-color, #10b981); font-weight: 600; text-decoration: none; hover: text-decoration: underline;">Login here</a>
          </p>
        </div>
      </form>
    </div>
  </div>
</section>

<?php loadPartial('footer'); ?>
