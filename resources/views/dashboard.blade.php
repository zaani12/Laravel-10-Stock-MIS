@extends('layouts.app')

@section('title', 'Admin Dashboard for Stock Management System')

@include('cdn')

@section('contents')
    @if(Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('status') }}
        </div>
    @endif

    <div class="container mt-4">
        <div class="row">
                <div class="row">
    <!-- Sales Per Day (Past Week) Card -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Sales Per Day (Past Week)</h5>
                <canvas id="interactiveSalesPerDayChart" width="100%" height="50"></canvas>            </div>
        </div>
    </div>
</div>
            <!-- Products Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <canvas id="stockOverviewChart" width="100%" height="50"></canvas>
                    </div>
                </div>
            </div>

            <!-- Sales Performance Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Sales Performance</h5>
                        <canvas id="salesPerformanceChart" width="100%" height="50"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top Selling Models Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Top Selling Models</h5>
                        <canvas id="topSellingModelsChart" width="100%" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Inventory Alerts -->
            <div class="col-md-4 mb-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Inventory Alerts</h5>
            <ul class="list-group">
                <!-- Model X - Low Stock -->
                <li class="list-group-item d-flex align-items-center">
                    <img src="path_to_image/model_x.jpg" alt="Model X" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 15px;">
                    <div>
                        <strong>Model X</strong> - Low Stock<br>
                        <small class="text-muted">Only 3 items left in stock</small>
                        <br>
                        <span class="badge bg-warning text-dark">Low Stock</span>
                    </div>
                </li>

                <!-- Model Y - Overstock -->
                <li class="list-group-item d-flex align-items-center">
                    <img src="path_to_image/model_y.jpg" alt="Model Y" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 15px;">
                    <div>
                        <strong>Model Y</strong> - Overstock<br>
                        <small class="text-muted">In stock: 50+ items</small>
                        <br>
                        <span class="badge bg-success">Overstock</span>
                    </div>
                </li>

                <!-- Model Z - Out of Stock -->
                <li class="list-group-item d-flex align-items-center">
                    <img src="path_to_image/model_z.jpg" alt="Model Z" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 15px;">
                    <div>
                        <strong>Model Z</strong> - Out of Stock<br>
                        <small class="text-muted">Currently unavailable</small>
                        <br>
                        <span class="badge bg-danger">Out of Stock</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>


</div>

            <!-- Sales by Region Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Sales by Region</h5>
                        <canvas id="salesByRegionChart" width="100%" height="50"></canvas>
                    </div>
                </div>
            </div>

            <!-- Order Fulfillment Rate Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Order Fulfillment Rate</h5>
                        <canvas id="fulfillmentRateChart" width="100%" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Sections for Supplier Invoices and Low Stock Articles -->
        <div class="row">
            <!-- Supplier Invoices Section -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Supplier Invoices</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Supplier Name</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>INV12345</td>
                                    <td>Supplier A</td>
                                    <td>$5,000</td>
                                    <td>2024-12-01</td>
                                </tr>
                                <tr>
                                    <td>INV67890</td>
                                    <td>Supplier B</td>
                                    <td>$2,500</td>
                                    <td>2024-12-15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Articles Out of Stock or Low Stock Section -->
            <div class="col-md-6 mb-4">

            </div>
        </div>



    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Charts Initialization Script -->
    <script>
        // Stock Overview Chart
        var ctxStockOverview = document.getElementById('stockOverviewChart').getContext('2d');
        var stockOverviewChart = new Chart(ctxStockOverview, {
            type: 'pie',
            data: {
                labels: ['Sport Bikes', 'Cruisers', 'Dirt Bikes', 'Scooters'],
                datasets: [{
                    label: 'Stock Overview',
                    data: [30, 20, 15, 10], // Sample data
                    backgroundColor: ['#4CAF50', '#FF9800', '#2196F3', '#FFC107']
                }]
            },
            options: {
                responsive: true
            }
        });

        // Sales Performance Chart
        var ctxSalesPerformance = document.getElementById('salesPerformanceChart').getContext('2d');
        var salesPerformanceChart = new Chart(ctxSalesPerformance, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Monthly Sales',
                    data: [50, 75, 100, 90, 110], // Sample data
                    borderColor: '#2196F3',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Top Selling Models Chart
        var ctxTopSellingModels = document.getElementById('topSellingModelsChart').getContext('2d');
        var topSellingModelsChart = new Chart(ctxTopSellingModels, {
            type: 'bar',
            data: {
                labels: ['Model A', 'Model B', 'Model C', 'Model D', 'Model E'],
                datasets: [{
                    label: 'Top Selling Models',
                    data: [120, 95, 80, 75, 60], // Sample data
                    backgroundColor: '#4CAF50'
                }]
            },
            options: {
                responsive: true
            }
        });

        // Sales by Region Chart
        var ctxSalesByRegion = document.getElementById('salesByRegionChart').getContext('2d');
        var salesByRegionChart = new Chart(ctxSalesByRegion, {
            type: 'bar',
            data: {
                labels: ['North', 'South', 'East', 'West'],
                datasets: [{
                    label: 'Sales by Region',
                    data: [200, 300, 250, 150], // Sample data
                    backgroundColor: '#FF9800'
                }]
            },
            options: {
                responsive: true
            }
        });

        // Order Fulfillment Rate Chart
        var ctxFulfillmentRate = document.getElementById('fulfillmentRateChart').getContext('2d');
        var fulfillmentRateChart = new Chart(ctxFulfillmentRate, {
            type: 'doughnut',
            data: {
                labels: ['Fulfilled', 'Pending'],
                datasets: [{
                    label: 'Fulfillment Rate',
                    data: [80, 20], // Sample data
                    backgroundColor: ['#4CAF50', '#FF9800']
                }]
            },
            options: {
                responsive: true
            }
        });
        // Sales Per Day Chart
var ctxSalesPerDay = document.getElementById('salesPerDayChart').getContext('2d');
var salesPerDayChart = new Chart(ctxSalesPerDay, {
    type: 'bar',
    data: {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'], // Days of the week
        datasets: [{
            label: 'Daily Sales',
            data: [120, 150, 100, 180, 200, 90, 75], // Sample sales data for each day
            backgroundColor: [
                '#4CAF50', '#FF9800', '#2196F3', '#FFC107', '#9C27B0', '#03A9F4', '#8BC34A'
            ]
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Sales'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Day of the Week'
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        }
    }
});

    </script>

@endsection
