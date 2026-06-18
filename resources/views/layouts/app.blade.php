<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIJA PARKIR</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</head>
<body>
    <aside>
        <div class="sidebar-header">
            <span class="brand">
                <img src="{{ asset('images/parkir.png') }}" alt="Parking building">
                <span>SIJA PARKING</span>
            </span>
        </div>
        <hr class="sidebar-divider">
        <nav>
            <a href="{{ route('locations.index') }}" class="nav-link {{ Route::is('locations.*') ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-building" style="font-size: 14px;"></i></div>
                <span>Location</span>
            </a>
            <a href="{{ route('transactions.index') }}" class="nav-link {{ Route::is('transactions.*') ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-credit-card" style="font-size: 14px;"></i></div>
                <span>Transaction</span>
            </a>
            <a href="{{ route('vehicle_types.index') }}" class="nav-link {{ Route::is('vehicle_types.*') ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-rocket" style="font-size: 14px;"></i></div>
                <span>Vehicle Type</span>
            </a>
            <div class="nav-section-title">Reports</div>
            <a href="{{ route('reports.location') }}" class="nav-link {{ Route::is('reports.location') ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-cube" style="font-size: 14px;"></i></div>
                <span>Location Report</span>
            </a>
            <a href="{{ route('reports.transaction') }}" class="nav-link {{ Route::is('reports.transaction') ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-newspaper" style="font-size: 14px;"></i></div>
                <span>Transaction Report</span>
            </a>
        </nav>
    </aside>

    <main>
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <nav style="font-size: 0.875rem; color: #67748e; margin-bottom: 4px;">
                    Pages / <span style="color: #344767; font-weight: 600;">@yield('page_name')</span>
                </nav>
                <h6 style="margin: 0; font-weight: 700; font-size: 1rem;">@yield('page_name')</h6>
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="position: relative;">
                </div>
                @yield('header_action')
                <a href="#" style="font-size: 0.875rem; color: #67748e; text-decoration: none; font-weight: 600;">
                    <i class="fas fa-user-circle" style="margin-right: 4px;"></i> Sign Out
                </a>
            </div>
        </header>

        @yield('content')

        <footer style="margin-top: 4rem; text-align: center; font-size: 0.875rem; color: #67748e;">
            &copy; 2025, made with <i class="fa fa-heart" style="color: #cb0c9f;"></i> by <b>FERDI</b> for ASAS Ganjil Web And Mobile Development - SMKN 1 Cibinong.
        </footer>
    </main>

    @if (session('success'))
    <div id="successModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-icon-success">
                <i class="fas fa-check"></i>
            </div>
            <h3>Good Job</h3>
            <p>{{ session('success') }}</p>
            <button onclick="closeSuccessModal()">OK</button>
        </div>
    </div>
    <script>
        function closeSuccessModal() {
            document.getElementById('successModal').style.opacity = '0';
            setTimeout(() => {
                document.getElementById('successModal').style.display = 'none';
            }, 300);
        }
    </script>
    @endif

    @if (session('error'))
    <div id="errorModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-icon-error">
                <i class="fas fa-exclamation"></i>
            </div>
            <h3>Failed</h3>
            <p>{{ session('error') }}</p>
            <button onclick="closeErrorModal()">OK</button>
        </div>
    </div>
    <script>
        function closeErrorModal() {
            document.getElementById('errorModal').style.opacity = '0';
            setTimeout(() => {
                document.getElementById('errorModal').style.display = 'none';
            }, 300);
        }
    </script>
    @endif
</body>
</html>
