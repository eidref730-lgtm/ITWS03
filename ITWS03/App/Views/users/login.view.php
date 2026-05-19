<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="create-page">
  <div class="create-wrap animate-fade-in" style="max-width: 500px; margin: 3rem auto;">
    <div class="form-shell">
      <div class="form-hero" style="text-align: center; margin-bottom: 2rem;">
        <span class="form-badge">Welcome Back</span>
        <h1>Login to Prosple</h1>
        <p>Enter your credentials to manage your job postings and applications.</p>
      </div>

      <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>

      <form method="POST" action="<?= url('/auth/login') ?>" class="job-form">
        <div class="form-section">
          <div class="form-grid" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="form-group full" style="width: 100%;">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" placeholder="name@company.com" class="form-input" value="<?= sanitize($user['email'] ?? '') ?>" required />
            </div>

            <div class="form-group full" style="width: 100%;">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" placeholder="••••••••" class="form-input" required />
            </div>
          </div>
        </div>

        <div class="action-row" style="margin-top: 2rem; display: flex; flex-direction: column; gap: 1rem; align-items: stretch;">
          <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; text-align: center; font-size: 1.05rem; padding: 0.8rem 1.5rem;">
            <i class="fa-solid fa-right-to-bracket" style="margin-right: 0.5rem;"></i>
            Sign In
          </button>
          
          <p style="text-align: center; color: #6b7280; font-size: 0.95rem; margin-top: 1rem;">
            Don't have an account? 
            <a href="<?= url('/auth/register') ?>" style="color: var(--primary-color, #10b981); font-weight: 600; text-decoration: none; hover: text-decoration: underline;">Register here</a>
          </p>
        </div>
      </form>
    </div>
  </div>
</section>

<?php loadPartial('footer'); ?>
