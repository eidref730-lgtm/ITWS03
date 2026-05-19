<section class="hero-section">
    <div class="overlay"></div>

    <div class="container mx-auto hero-content">
        <div class="hero-badge">
            <i class="fa fa-briefcase"></i>
            Career Portal
        </div>

        <h2>Find Your Dream Job</h2>
        <p>
           Discover opportunities from top employers and take the next step in your career.
        </p>

        <form method="GET" action="<?= url('/listings') ?>" class="hero-search-form" id="hero-search-form" onsubmit="return true;">
            <div class="input-group">
                <i class="fa fa-search"></i>
                <input type="text" name="keywords" placeholder="Job title or keyword" value="<?= htmlspecialchars($_GET['keywords'] ?? '', ENT_QUOTES) ?>" autocomplete="off" />
            </div>

            <div class="input-group">
                <i class="fa fa-location-dot"></i>
                <input type="text" name="location" placeholder="Location" value="<?= htmlspecialchars($_GET['location'] ?? '', ENT_QUOTES) ?>" autocomplete="off" />
            </div>

            <button class="btn btn-primary search-btn" type="submit">
                <i class="fa fa-search"></i>
                Search Jobs
            </button>
        </form>

        <div class="hero-stats">
            <div class="hero-stat">
                <strong>300+</strong>
                <span>Open Jobs</span>
            </div>
            <div class="hero-stat">
                <strong>80+</strong>
                <span>Employers</span>
            </div>
            <div class="hero-stat">
                <strong>5k+</strong>
                <span>Applicants</span>
            </div>
        </div>
    </div>
</section>

<script>
// Kill any existing submit listeners on this form and let it submit naturally
(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('hero-search-form');
        if (!form) return;
        // Replace node to strip all attached event listeners
        var clean = form.cloneNode(true);
        form.parentNode.replaceChild(clean, form);
        // Guarantee natural submission
        clean.addEventListener('submit', function(e) {
            // Do NOT preventDefault — just let it go
        });
    });
})();
</script>