<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestlink College - Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <img src="image/bcp_logo.png" alt="Bestlink College" class="logo">
            
            <h2>Bestlink College of the Philippines</h2>
            <h3>Login as</h3>
            <select id="role-select">
                <option value="">Choose</option>
                <option value="student">Student</option>
                <option value="professor">Professor</option>
                <option value="faculty">Faculty</option>
            </select>

            <form id="login-form" action="#" method="POST" style="display: none;">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <button type="submit">Login</button>    
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('role-select').addEventListener('change', function() {
            const loginForm = document.getElementById('login-form');
            if (this.value) {
                loginForm.style.display = 'block';
            } else {
                loginForm.style.display = 'none';
            }
        });
    </script>
</body>
</html>
