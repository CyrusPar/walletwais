<?php include realpath(__DIR__ . '/app/layout/header.php') ?>

<style>
    body {
        opacity: 1;
        background-image: radial-gradient(#cdd9e7 1.05px, #e5e5f7 1.05px);
        background-size: 21px 21px;
        overflow: hidden;
        /* Prevent scroll while splash is visible */
    }

    /* Splash screen styles */
    .splash-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #058240;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Make sure it's on top of other content */
        opacity: 1;
        transition: opacity 1s ease-out;
    }

    .splash-screen.hidden {
        opacity: 0;
        visibility: hidden;
    }

    .container {
        display: flex;
        align-items: center;
        height: 100vh;
    }
</style>

<!-- Splash Screen -->
<div class="splash-screen" id="splash-screen">
    <div class="text-center">
        <img src="./public/img/logo.png" class="w-50">
    </div>
</div>

<script>
    // Hide the splash screen and redirect after 2 seconds
    window.onload = function() {
        setTimeout(function() {
            const splashScreen = document.getElementById('splash-screen');
            splashScreen.classList.add('hidden');
            // Allow body to scroll again
            document.body.style.overflow = 'auto';
            
            // Redirect to index.php after splash screen disappears
            window.location.href = 'login.php';  // Redirects the page
        }, 2000); // 2000 milliseconds = 2 seconds
    };
</script>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>
