<?php include('includes/header.php'); ?>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --success-color: #4CAF50;
        --warning-color: #ff9800;
        --danger-color: #f44336;
        --info-color: #2196F3;
        --dark-color: #2c3e50;
        --light-color: #f8f9fa;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    body {
        background: #f0f2f5;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .dashboard-container {
        padding: 2rem;
        margin-bottom: 80px;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .dashboard-title {
        font-size: 2.5rem;
        color: var(--dark-color);
        font-weight: 700;
        margin: 0;
    }

    .date-time {
        background: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        font-size: 1.1rem;
        color: var(--dark-color);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .stat-card.rooms::before { background: var(--primary-color); }
    .stat-card.users::before { background: var(--success-color); }
    .stat-card.admins::before { background: var(--warning-color); }
    .stat-card.bookings::before { background: var(--info-color); }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stat-title {
        font-size: 1.2rem;
        color: var(--dark-color);
        font-weight: 600;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stat-icon.rooms { background: var(--primary-color); }
    .stat-icon.users { background: var(--success-color); }
    .stat-icon.admins { background: var(--warning-color); }
    .stat-icon.bookings { background: var(--info-color); }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-color);
        margin: 1rem 0;
    }

    .stat-change {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .stat-change.positive { color: var(--success-color); }
    .stat-change.negative { color: var(--danger-color); }

    .quick-actions {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--card-shadow);
    }

    .actions-title {
        font-size: 1.3rem;
        color: var(--dark-color);
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-button {
        padding: 1rem;
        border-radius: 12px;
        border: none;
        background: var(--light-color);
        color: var(--dark-color);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
        cursor: pointer;
    }

    .action-button:hover {
        background: var(--primary-color);
        color: white;
    }

    .recent-activity {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
    }

    .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .activity-title {
        font-size: 1.3rem;
        color: var(--dark-color);
        font-weight: 600;
    }

    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        padding: 1rem;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .activity-details {
        flex: 1;
    }

    .activity-text {
        margin: 0;
        color: var(--dark-color);
    }

    .activity-time {
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: white;
        padding: 1rem;
        display: flex;
        justify-content: space-around;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: var(--dark-color);
        transition: var(--transition);
    }

    .nav-item.active {
        color: var(--primary-color);
    }

    .nav-item i {
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
    }

    .nav-text {
        font-size: 0.8rem;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .dashboard-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .dashboard-title {
            font-size: 2rem;
        }

        .stat-value {
            font-size: 2rem;
        }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard Overview</h1>
        <div class="date-time" id="datetime"></div>
    </div>

    <div class="stats-grid">
        <!-- Total Rooms -->
        <div class="stat-card rooms">
            <div class="stat-header">
            <a href="add.php" class="text-decoration-none">
                <span class="stat-title">Total Rooms</span>
                <div class="stat-icon rooms">
                    <i class="fas fa-door-open"></i>
                </div>
            </div>
            <?php 
                $total_rooms = "SELECT * FROM rooms";
                $total_rooms_run = mysqli_query($con, $total_rooms);
                $count = mysqli_num_rows($total_rooms_run);
            ?>
            <div class="stat-value"><?= $count ?></div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 
            </div>
            </a>
        </div>

        <!-- Total Users -->
        <div class="stat-card users">
            <div class="stat-header">
            <a href="users.php" class="text-decoration-none">

                <span class="stat-title">Total Users</span>
                <div class="stat-icon users">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <?php 
                $total_users = "SELECT * FROM users";
                $total_users_run = mysqli_query($con, $total_users);
                $user_count = mysqli_num_rows($total_users_run);
            ?>
            <div class="stat-value"><?= $user_count ?></div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>12% from last month</span>
            </div>
            </a> 
        </div>

        <!-- Total Admins -->
        <div class="stat-card admins">
            <div class="stat-header">
            <a href="admins.php" class="text-decoration-none">
                <span class="stat-title">Total Admins</span>
                <div class="stat-icon admins">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
            <?php 
                $total_admin = "SELECT * FROM admins";
                $total_admin_run = mysqli_query($con, $total_admin);
                $admin_count = mysqli_num_rows($total_admin_run);
            ?>
            <div class="stat-value"><?= $admin_count ?></div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>2 new this month</span>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="stat-card bookings">
            <div class="stat-header">
                <span class="stat-title">Active Bookings</span>
                <div class="stat-icon bookings">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
            <div class="stat-value">24</div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i>
                <span>3% from last week</span>
            </div>
        </div>
    </div>

    <div class="quick-actions">
        <h2 class="actions-title">Quick Actions</h2>
        <div class="actions-grid">
            <button class="action-button">
                <i class="fas fa-plus"></i>
                Add New Room
            </button>
            <button class="action-button">
                <i class="fas fa-user-plus"></i>
                Add New User
            </button>
            <button class="action-button">
                <i class="fas fa-calendar-plus"></i>
                New Booking
            </button>
            <button class="action-button">
                <i class="fas fa-cog"></i>
                Settings
            </button>
        </div>
    </div>

    <div class="recent-activity">
        <div class="activity-header">
            <h2 class="activity-title">Recent Activity</h2>
            <a href="#" class="view-all">View All</a>
        </div>
        <ul class="activity-list">
            <li class="activity-item">
                <div class="activity-icon" style="background: var(--success-color)">
                    <i class="fas fa-check"></i>
                </div>
                <div class="activity-details">
                    <p class="activity-text">New booking confirmed for Room 101</p>
                    <span class="activity-time">2 minutes ago</span>
                </div>
            </li>
            <li class="activity-item">
                <div class="activity-icon" style="background: var(--primary-color)">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="activity-details">
                    <p class="activity-text">New user registration</p>
                    <span class="activity-time">1 hour ago</span>
                </div>
            </li>
            <li class="activity-item">
                <div class="activity-icon" style="background: var(--warning-color)">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="activity-details">
                    <p class="activity-text">Room 205 details updated</p>
                    <span class="activity-time">3 hours ago</span>
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="bottom-nav">
    <a href="dashboard.php" class="nav-item active">
        <i class="fas fa-home"></i>
        <span class="nav-text">Dashboard</span>
    </a>
    <a href="rooms.php" class="nav-item">
        <i class="fas fa-door-open"></i>
        <span class="nav-text">Rooms</span>
    </a>
    <a href="bookings.php" class="nav-item">
        <i class="fas fa-calendar-alt"></i>
        <span class="nav-text">Bookings</span>
    </a>
    <a href="users.php" class="nav-item">
        <i class="fas fa-users"></i>
        <span class="nav-text">Users</span>
    </a>
    <a href="settings.php" class="nav-item">
        <i class="fas fa-cog"></i>
        <span class="nav-text">Settings</span>
    </a>
</div>

<script>
// Update datetime
function updateDateTime() {
    const now = new Date();
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit', 
        minute: '2-digit'
    };
    document.getElementById('datetime').textContent = now.toLocaleDateString('en-US', options);
}

updateDateTime();
setInterval(updateDateTime, 60000);
</script>

<?php include('includes/footer.php'); ?>