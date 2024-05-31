<div class="dash-cont">
    <div class="dash-inner">
        <h1>Dashboard</h1>
        <p>Welcome to the dashboard, <?php echo $_SESSION['user']->username; ?></p>
        <button onclick="document.location.href = '/logout.php'">Logout</button>
    </div>
</div>