<html lang="en" webcrx=""><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script><script src="blob:https://demo.growdone.com/14753cb7-a21a-43cf-bf1b-3f406280d138"></script>
    <style>
        :root {
            --primary: #5d78ff;
            --primary-light: #e8f0fe;
            --secondary: #495057;
            --success: #2dce89;
            --danger: #f5365c;
            --warning: #fb6340;
            --info: #11cdef;
            --dark: #212529;
            --light: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
        }

        .container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            background: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 20px 0;
        }

        .logo {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .logo h2 {
            color: var(--primary);
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: var(--secondary);
            text-decoration: none;
            transition: all 0.3s;
        }

        .menu-item:hover, .menu-item.active {
            background: var(--primary-light);
            color: var(--primary);
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main Content Styles */
        .main-content {
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: #fff;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        .search-bar {
            position: relative;
            width: 300px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 30px;
            outline: none;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .user-actions {
            display: flex;
            align-items: center;
        }

        .notification {
            position: relative;
            margin-right: 20px;
            cursor: pointer;
        }

        .notification .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            text-align: center;
        }

        .stat-card i {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .stat-card h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: #666;
        }

        .primary-card {
            border-top: 3px solid var(--primary);
        }

        .success-card {
            border-top: 3px solid var(--success);
        }

        .danger-card {
            border-top: 3px solid var(--danger);
        }

        .warning-card {
            border-top: 3px solid var(--warning);
        }

        /* Main Content Area */
        .content-area {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .content-area-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* NEW ROW FOR RECENT ACTIVITIES AND TOP PRODUCTS */
        .content-area-3 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            padding: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .card-header h3 {
            font-size: 18px;
        }

        .card-header .actions i {
            margin-left: 10px;
            cursor: pointer;
            color: #999;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .table th {
            font-weight: 600;
            color: var(--dark);
            background: #f9f9f9;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background: rgba(45, 206, 137, 0.1);
            color: var(--success);
        }

        .badge-warning {
            background: rgba(251, 99, 64, 0.1);
            color: var(--warning);
        }

        .badge-danger {
            background: rgba(245, 54, 92, 0.1);
            color: var(--danger);
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 10px;
            background: #f9f9f9;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            text-decoration: none;
            color: var(--secondary);
        }

        .action-btn:hover {
            background: var(--primary-light);
            color: var(--primary);
            transform: translateY(-3px);
        }

        .action-btn i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        /* Activity Log */
        .activity-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .activity-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .activity-content h5 {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .activity-content p {
            font-size: 12px;
            color: #666;
            margin-bottom: 3px;
        }

        .activity-time {
            font-size: 11px;
            color: #999;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .content-area, .content-area-2, .content-area-3 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            .sidebar {
                display: none;
            }
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            .search-bar {
                width: 200px;
            }
        }
    </style>
<script src="blob:https://demo.growdone.com/a97b0824-b30c-4b86-8c09-0818433bcbdb"></script><script src="blob:https://demo.growdone.com/88713c05-d691-46e5-86ad-6e92ef12a6d7"></script></head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>POS System</h2>
            </div>
            <nav>
                <a href="#" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-cash-register"></i>
                    <span>POS Terminal</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-boxes"></i>
                    <span>Products</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-barcode"></i>
                    <span>Barcode Printing</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-warehouse"></i>
                    <span>Stock Management</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Quotations</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Purchase</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span>Sales</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Returns</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-wallet"></i>
                    <span>Expenses</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Customers/Suppliers</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-user-shield"></i>
                    <span>User Management</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-pie"></i>
                    <span>Reports</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="user-actions">
                    <div class="notification">
                        <i class="fas fa-bell"></i>
                        <span class="badge">5</span>
                    </div>
                    <div class="user-profile">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                        <span>Admin User</span>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="dashboard-grid">
                <div class="stat-card primary-card">
                    <i class="fas fa-dollar-sign" style="color: var(--primary);"></i>
                    <h3>$12,345</h3>
                    <p>Today's Sales</p>
                    <small style="color: var(--success);">+12% from yesterday</small>
                </div>
                <div class="stat-card success-card">
                    <i class="fas fa-shopping-cart" style="color: var(--success);"></i>
                    <h3>156</h3>
                    <p>Today's Orders</p>
                </div>
                <div class="stat-card danger-card">
                    <i class="fas fa-box-open" style="color: var(--danger);"></i>
                    <h3>12</h3>
                    <p>Low Stock Items</p>
                </div>
                <div class="stat-card warning-card">
                    <i class="fas fa-file-invoice-dollar" style="color: var(--warning);"></i>
                    <h3>8</h3>
                    <p>Pending Quotations</p>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="content-area">
                <!-- Sales Chart -->
                <div class="card">
                    <div class="card-header">
                        <h3>Sales Overview</h3>
                        <div class="actions">
                            <i class="fas fa-sync-alt"></i>
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="salesChart" width="959" height="375" style="display: block; box-sizing: border-box; height: 300px; width: 767px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h3>Quick Actions</h3>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="#" class="action-btn">
                                <i class="fas fa-cash-register"></i>
                                <span>New Sale</span>
                            </a>
                            <a href="#" class="action-btn">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <span>Create Quotation</span>
                            </a>
                            <a href="#" class="action-btn">
                                <i class="fas fa-box"></i>
                                <span>Add Product</span>
                            </a>
                            <a href="#" class="action-btn">
                                <i class="fas fa-barcode"></i>
                                <span>Print Barcode</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Content Area -->
            <div class="content-area-2">
                <!-- Recent Transactions -->
                <div class="card">
                    <div class="card-header">
                        <h3>Recent Transactions</h3>
                        <div class="actions">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="max-height: 300px; overflow-y: auto;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#ORD-10025</td>
                                        <td>John Smith</td>
                                        <td>$125.50</td>
                                        <td><span class="badge badge-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-10024</td>
                                        <td>Sarah Johnson</td>
                                        <td>$89.99</td>
                                        <td><span class="badge badge-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-10023</td>
                                        <td>Michael Brown</td>
                                        <td>$156.75</td>
                                        <td><span class="badge badge-warning">Processing</span></td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-10022</td>
                                        <td>Emily Davis</td>
                                        <td>$67.20</td>
                                        <td><span class="badge badge-danger">Returned</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Inventory Alerts -->
                <div class="card">
                    <div class="card-header">
                        <h3>Inventory Alerts</h3>
                        <div class="actions">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="max-height: 300px; overflow-y: auto;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>SKU</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Premium Coffee</td>
                                        <td>PC-1001</td>
                                        <td>5</td>
                                        <td><span class="badge badge-danger">Low Stock</span></td>
                                    </tr>
                                    <tr>
                                        <td>Organic Tea</td>
                                        <td>OT-2002</td>
                                        <td>12</td>
                                        <td><span class="badge badge-warning">Warning</span></td>
                                    </tr>
                                    <tr>
                                        <td>Chocolate Cookies</td>
                                        <td>CC-3003</td>
                                        <td>3</td>
                                        <td><span class="badge badge-danger">Low Stock</span></td>
                                    </tr>
                                    <tr>
                                        <td>Energy Bar</td>
                                        <td>EB-4004</td>
                                        <td>8</td>
                                        <td><span class="badge badge-warning">Warning</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NEW ROW FOR RECENT ACTIVITIES AND TOP PRODUCTS CHART -->
            <div class="content-area-3">
                <!-- Recent Activities -->
                <div class="card">
                    <div class="card-header">
                        <h3>Recent Activities</h3>
                        <div class="actions">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="max-height: 300px; overflow-y: auto;">
                            <div class="activity-item">
                                <div class="activity-icon" style="background: rgba(93, 120, 255, 0.1);">
                                    <i class="fas fa-cash-register" style="color: var(--primary);"></i>
                                </div>
                                <div class="activity-content">
                                    <h5>New order #ORD-10025</h5>
                                    <p>Customer: John Smith - $125.50</p>
                                    <p class="activity-time">2 minutes ago</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon" style="background: rgba(45, 206, 137, 0.1);">
                                    <i class="fas fa-box" style="color: var(--success);"></i>
                                </div>
                                <div class="activity-content">
                                    <h5>Product restocked</h5>
                                    <p>Premium Coffee (50 units)</p>
                                    <p class="activity-time">1 hour ago</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon" style="background: rgba(245, 54, 92, 0.1);">
                                    <i class="fas fa-exclamation-triangle" style="color: var(--danger);"></i>
                                </div>
                                <div class="activity-content">
                                    <h5>Low stock alert</h5>
                                    <p>Chocolate Cookies (3 units left)</p>
                                    <p class="activity-time">3 hours ago</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon" style="background: rgba(251, 99, 64, 0.1);">
                                    <i class="fas fa-user-plus" style="color: var(--warning);"></i>
                                </div>
                                <div class="activity-content">
                                    <h5>New customer registered</h5>
                                    <p>Lisa Ray</p>
                                    <p class="activity-time">5 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Selling Products Chart (Rounded Bars) -->
                <div class="card">
                    <div class="card-header">
                        <h3>Top Selling Products</h3>
                        <div class="actions">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="topProductsChart" width="706" height="375" style="display: block; box-sizing: border-box; height: 300px; width: 565px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <a href="/Pruduct_catagory.html" style="
     display: inline-block;
     padding: 10px 20px;
     background-color: #007BFF;
     color: white;
     text-decoration: none;
     border-radius: 5px;
     font-size: 16px;
     border: none;
     cursor: pointer;
     text-align: center;
   ">
  <button> Pruduct catagory </button>
</a>


  <a href="/product_list.html" style="
     display: inline-block;
     padding: 10px 20px;
     background-color: #007BFF;
     color: white;
     text-decoration: none;
     border-radius: 5px;
     font-size: 16px;
     border: none;
     cursor: pointer;
     text-align: center;
   ">
  <button> Pruduct list </button>
</a>   


<a href="/sibardemo.html" style="
     display: inline-block;
     padding: 10px 20px;
     background-color: #007BFF;
     color: white;
     text-decoration: none;
     border-radius: 5px;
     font-size: 16px;
     border: none;
     cursor: pointer;
     text-align: center;
   ">
  <button> Pruduct list </button>
</a>


    <script>
        // Sales Chart
        const salesChartCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesChartCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales',
                    data: [4500, 5200, 4800, 6100, 7500, 8200, 9700, 9100, 8500, 7300, 6800, 7900],
                    backgroundColor: 'rgba(93, 120, 255, 0.1)',
                    borderColor: 'rgba(93, 120, 255, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: 'rgba(93, 120, 255, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });

        // Register rounded bar controller
        Chart.register({
            id: 'roundedBar',
            beforeDraw: function(chart, args, options) {
                const {ctx, chartArea: {top, bottom, left, right, width, height}} = chart;
                
                // Draw rounded bars
                chart.data.datasets.forEach((dataset, i) => {
                    chart.getDatasetMeta(i).data.forEach((bar, index) => {
                        const x = bar.x;
                        const y = bar.y;
                        const barHeight = height - y;
                        const barWidth = bar.width;
                        const radius = 10; // Corner radius
                        
                        ctx.save();
                        ctx.beginPath();
                        ctx.moveTo(x - barWidth/2, y + radius);
                        ctx.arcTo(x - barWidth/2, y, x - barWidth/2 + radius, y, radius);
                        ctx.arcTo(x + barWidth/2, y, x + barWidth/2, y + radius, radius);
                        ctx.lineTo(x + barWidth/2, y + barHeight);
                        ctx.lineTo(x - barWidth/2, y + barHeight);
                        ctx.closePath();
                        ctx.fillStyle = dataset.backgroundColor[index];
                        ctx.fill();
                        ctx.restore();
                    });
                });
            }
        });

        // Top Products Chart with Rounded Bars
        const topProductsChartCtx = document.getElementById('topProductsChart').getContext('2d');
        const topProductsChart = new Chart(topProductsChartCtx, {
            type: 'bar',
            data: {
                labels: ['Premium Coffee', 'Organic Tea', 'Chocolate Cookies', 'Energy Bar', 'Bottled Water'],
                datasets: [{
                    label: 'Units Sold',
                    data: [156, 98, 76, 65, 45],
                    backgroundColor: [
                        'rgba(93, 120, 255, 0.8)',
                        'rgba(45, 206, 137, 0.8)',
                        'rgba(245, 54, 92, 0.8)',
                        'rgba(251, 99, 64, 0.8)',
                        'rgba(17, 205, 239, 0.8)'
                    ],
                    borderColor: [
                        'rgba(93, 120, 255, 1)',
                        'rgba(45, 206, 137, 1)',
                        'rgba(245, 54, 92, 1)',
                        'rgba(251, 99, 64, 1)',
                        'rgba(17, 205, 239, 1)'
                    ],
                    borderWidth: 0,
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' units sold';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });

        // Update charts on window resize
        window.addEventListener('resize', function() {
            salesChart.resize();
            topProductsChart.resize();
        });
    </script>

<div id="cb-connect-sidebar-main"><div id="cb-connect-sidebar"><a href="#" class="cb-connect-close-sidebar-button"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="currentColor"><path fill-rule="evenodd" d="M3.3352346,13.1409137 L3.33523455,13.1409138 C2.91548014,13.5733825 2.92546046,14.2645641 3.35752584,14.684707 C3.78087294,15.0963751 4.45458199,15.0962796 4.87780976,14.6844919 L9.00453522,10.5538595 L13.1373639,14.6904917 L13.1373638,14.6904917 C13.568947,15.1110906 14.2594594,15.1018597 14.6796682,14.6698737 C15.0920236,14.2459591 15.0919517,13.570408 14.6795052,13.1465834 L10.5469491,9.01016937 L14.6955806,4.85777412 L14.6955806,4.85777409 C15.1130468,4.423134 15.0994531,3.73205118 14.6652183,3.31419357 C14.2430237,2.90792372 13.5756331,2.90792372 13.1534407,3.31419361 L9.00453675,7.46620706 L4.86206292,3.31981159 L4.86206295,3.31981162 C4.436122,2.89342832 3.74549844,2.89339123 3.31951335,3.31972975 C2.89352771,3.74606833 2.89349066,4.43733659 3.31943155,4.86371935 L7.46206886,9.01011482 L3.3352346,13.1409137 Z" fill=""></path></svg></a><div id="cb-connect-sidebar-loading">
        <div>
          <div class="cb-connect-sidebar-loading-outer">
            <div class="cb-connect-sidebar-loading-inner">
              <img src="chrome-extension://pmnhcgfcafcnkbengdcanjablaabjplo/src/assets/logo.svg" width="40" height="40">
              <div class="cb-connect-sidebar-loading-inner-text">Loading...</div>
            </div>
          </div>
        </div>
      </div><div><iframe id="cb-connect-sidebar-iframe" lang="en" class="cb-connect-sidebar-container" style="height: 100vh; min-height: 100vh"></iframe></div></div><div id="cb-connect-open-button-outer" class="cb-connect-open-button-is-tucked" style="inset: 64px 0px auto auto;"><div id="cb-connect-open-button-inner" style="background: rgb(20, 140, 252);">
          <img src="chrome-extension://pmnhcgfcafcnkbengdcanjablaabjplo/src/assets/logo-dark-background.svg" width="20" height="20" style="user-select: none;width: 20px !important;height:20px !important;filter: none !important;">

          <div id="cb-connect-open-button-icp-message" style="display: none;">ICP</div>
        <div id="cb-connect-open-button-move-button"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4 12.5V11h12v1.5ZM4 9V7.5h12V9Z"></path></svg></div><a href="#" id="cb-connect-close-widget-button" title="Hide widget on this site or all sites"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="currentColor"><path fill-rule="evenodd" d="M3.3352346,13.1409137 L3.33523455,13.1409138 C2.91548014,13.5733825 2.92546046,14.2645641 3.35752584,14.684707 C3.78087294,15.0963751 4.45458199,15.0962796 4.87780976,14.6844919 L9.00453522,10.5538595 L13.1373639,14.6904917 L13.1373638,14.6904917 C13.568947,15.1110906 14.2594594,15.1018597 14.6796682,14.6698737 C15.0920236,14.2459591 15.0919517,13.570408 14.6795052,13.1465834 L10.5469491,9.01016937 L14.6955806,4.85777412 L14.6955806,4.85777409 C15.1130468,4.423134 15.0994531,3.73205118 14.6652183,3.31419357 C14.2430237,2.90792372 13.5756331,2.90792372 13.1534407,3.31419361 L9.00453675,7.46620706 L4.86206292,3.31981159 L4.86206295,3.31981162 C4.436122,2.89342832 3.74549844,2.89339123 3.31951335,3.31972975 C2.89352771,3.74606833 2.89349066,4.43733659 3.31943155,4.86371935 L7.46206886,9.01011482 L3.3352346,13.1409137 Z" fill=""></path></svg></a></div></div></div></body></html>