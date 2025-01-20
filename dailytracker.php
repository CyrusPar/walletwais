<?php
function dailyTracker($userId) {
    global $usersFacade; // Assuming $usersFacade is defined elsewhere

    // Fetch the user by userId
    $fetchUserById = $usersFacade->fetchUserById($userId);

    foreach ($fetchUserById as $user) {
        // Display the button to show the email
        ?>
        <div style="text-align: left; margin-top: 20px;">  <!-- Align the button to the left -->
            <button id="showEmailBtn" onclick="toggleEmail()" style="background-color: #058240; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
                Show Email
            </button>
        </div>

        <!-- Initially hidden email -->
        <p id="email" style="display:none; margin-top: 10px;"><?= htmlspecialchars($user['email']) ?></p>

        <script>
            // Function to toggle the visibility of the email
            function toggleEmail() {
                var emailElement = document.getElementById('email');
                // Toggle display property between 'none' and 'block'
                if (emailElement.style.display === "none") {
                    emailElement.style.display = "block";
                } else {
                    emailElement.style.display = "none";
                }
            }
        </script>
        <?php
    }
}
?>
