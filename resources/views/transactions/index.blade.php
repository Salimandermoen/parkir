@extends('layouts.app')

@section('title', 'Transaction')
@section('page_name', 'Transaction')

@section('header_action')
    <!-- Selectable Vehicle Types (Dynamic) -->
    <div style="display: flex; gap: 0.5rem; align-items: center; margin-right: 1rem;">
        @foreach($vehicleTypes as $index => $type)
            <button type="button" class="vehicle-type-btn @if($index === 0) active @endif" data-id="{{ $type->id }}" onclick="selectVehicleType(this, {{ $type->id }})">
                {{ strtoupper($type->jenis) }}
            </button>
        @endforeach
    </div>
    
    <button type="button" class="btn-primary" onclick="triggerCheckIn()">+ ENTER VEHICLE</button>
@endsection

@section('content')

@if($errors->any())
<div style="background-color: #fce8e6; border: 1px solid #ea0606; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem; color: #c5221f;">
    <h6 style="margin: 0 0 0.5rem 0; font-weight: 700; color: #c5221f;">Warning!</h6>
    <ul style="margin: 0; padding-left: 1.25rem; font-size: 0.875rem;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">

    <div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          
            <div>
                <div class="clock-card"> <img src="C:\xampp\htdocs\parkir\public\images">
                    <span id="clock-day" style="font-size: 0.875rem; text-transform: uppercase; font-weight: 600; color: #adb5bd;">Monday</span>
                    <span id="clock-date" style="font-size: 0.75rem; color: #adb5bd; margin-top: 2px;">8 December 2025</span>
                    <div id="clock-time" class="clock-time">10:23:51</div>
                </div>
            </div>

          
            @foreach($locations as $location)
            <div class="card location-card-select" style="margin-top: 0;" data-id="{{ $location->id }}" data-name="{{ $location->location_name }}" onclick="selectLocation(this, {{ $location->id }})">
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    
                    <div style="background: linear-gradient(310deg, #7928ca 0%, #ff0080 100%); width: 40px; height: 40px; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fas fa-parking"><img src="http://127.0.0.1:8000/images/parkir-building.svg"S></i>
                    </div>
                    <div>
                        <h6 style="margin: 0; font-weight: 700; font-size: 0.875rem; color: #344767;">{{ $location->location_name }}</h6>
                      
                        <span style="font-size: 0.75rem; color: #67748e; display: flex; align-items: center; gap: 6px; margin-top: 4px;">
                            <i class="fas fa-motorcycle" style="font-size: 10px;"></i> {{ $location->available_motorcycle }} |
                            <i class="fas fa-car" style="font-size: 10px;"></i> {{ $location->available_car }} |
                            <i class="fas fa-truck" style="font-size: 10px;"></i> {{ $location->available_other }}
                        </span>
                    </div>
                </div>

              
                <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                    <span class="badge-capacity {{ $location->available_motorcycle > 0 ? 'badge-capacity-green' : 'badge-capacity-red' }}">
                        <i class="fas fa-motorcycle"></i> {{ $location->available_motorcycle }}
                    </span>
                    <span class="badge-capacity {{ $location->available_car > 0 ? 'badge-capacity-green' : 'badge-capacity-red' }}">
                        <i class="fas fa-car"></i> {{ $location->available_car }}
                    </span>
                    <span class="badge-capacity {{ $location->available_other > 0 ? 'badge-capacity-green' : 'badge-capacity-red' }}">
                        <i class="fas fa-truck"></i> {{ $location->available_other }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>


        <div class="card" style="margin-top: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h6 style="color: #cb0c9f; font-weight: 700; margin: 0;">Transaction <span style="font-weight: 400; color: #67748e;">Input Form</span></h6>
                <button type="submit" form="checkout-form" class="btn-primary" style="background-color: #172b4d; background-image: none;">+ EXIT VEHICLE</button>
            </div>

            <form id="checkout-form" action="{{ route('transactions.exit') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label for="no_tiket" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Ticket Number</label>
                        <input type="text" id="no_tiket" name="no_tiket" required placeholder="Ticket Number" style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
                    </div>
                    <div>
                        <label for="no_polisi_out" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Police Number</label>
                        <input type="text" id="no_polisi_out" name="no_polisi" required placeholder="Police Number" style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
                    </div>
                </div>
            </form>
        </div>
    </div>

  
    <div>
        <div class="card" style="margin-top: 0; min-height: 250px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid #f0f2f5; padding-bottom: 0.75rem;">
                <h6 style="margin: 0; font-weight: 700; font-size: 0.875rem; color: #344767;">Tickets</h6>
            </div>

            <div style="max-height: 300px; overflow-y: auto;">
                @forelse($recentTransactions as $tx)
                <div class="ticket-item">
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 600; color: #344767;">
                            {{ $tx->masuk }}
                        </div>
                        <div style="font-size: 0.75rem; color: #67748e; margin-top: 2px;">
                            #{{ $tx->no_tiket }} <span style="font-weight: 600; color: #cb0c9f;">({{ $tx->no_polisi }})</span>
                        </div>
                    </div>
                    <a href="{{ route('transactions.ticket', $tx->id) }}" target="_blank" style="color: #ea0606; text-decoration: none; font-size: 0.875rem;" title="Print Ticket">
                        <i class="fas fa-file-pdf"></i> <span style="font-size: 0.75rem; font-weight: 700; margin-left: 2px;">PDF</span>
                    </a>
                </div>
                @empty
                <div style="text-align: center; color: #67748e; font-size: 0.875rem; padding: 2rem 0;">
                    No active tickets.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


<div id="checkInModal" class="modal-overlay" style="display: none; opacity: 0;">
    <div class="modal-card" style="width: 400px; padding: 2rem;">
        <h3 style="margin-bottom: 0.25rem;">Enter Vehicle</h3>
        <p id="modal-subheading" style="font-size: 0.8rem; margin-bottom: 1.5rem;">Select Location & Type</p>
        
        <form id="checkin-form" action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <input type="hidden" id="modal_id_lokasi" name="id_lokasi">
            <input type="hidden" id="modal_id_jenis" name="id_jenis">
            
            <div style="text-align: left; margin-bottom: 1.5rem;">
                <label for="no_polisi_in" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Police Number</label>
                <input type="text" id="no_polisi_in" name="no_polisi" required placeholder="E.g. B 1234 ABC" style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
            </div>

            <div style="display: flex; gap: 0.5rem;">
                <button type="button" onclick="closeCheckIn()" style="flex: 1; background-color: #172b4d;">CANCEL</button>
                <button type="submit" style="flex: 1; background: linear-gradient(310deg, #7928ca 0%, #ff0080 100%);">SUBMIT</button>
            </div>
        </form>
    </div>
</div>

<script>
    let selectedLocationId = null;
    let selectedLocationName = "";
    
    let selectedVehicleTypeId = @json($vehicleTypes->first()->id ?? null);
    let selectedVehicleTypeName = @json(ucfirst($vehicleTypes->first()->jenis ?? ""));

    function selectLocation(element, id) {
       
        document.querySelectorAll('.location-card-select').forEach(card => {
            card.classList.remove('selected');
        });
        
        
        element.classList.add('selected');
        selectedLocationId = id;
        selectedLocationName = element.getAttribute('data-name');
    }

    function selectVehicleType(element, id) {
        document.querySelectorAll('.vehicle-type-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        element.classList.add('active');
        selectedVehicleTypeId = id;
        selectedVehicleTypeName = element.innerText.trim();
    }

    function triggerCheckIn() {
        if (!selectedLocationId) {
            alert("Please select a location card first!");
            return;
        }
        if (!selectedVehicleTypeId) {
            alert("No vehicle type selected or configured!");
            return;
        }

        
        document.getElementById('modal_id_lokasi').value = selectedLocationId;
        document.getElementById('modal_id_jenis').value = selectedVehicleTypeId;
        document.getElementById('modal-subheading').innerText = "Location: " + selectedLocationName + " | Type: " + selectedVehicleTypeName;
        
        
        const modal = document.getElementById('checkInModal');
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.style.opacity = '1';
        }, 10);
    }

    function closeCheckIn() {
        const modal = document.getElementById('checkInModal');
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

   
    function updateClock() {
        const now = new Date();
        
        
        const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        document.getElementById('clock-day').innerText = days[now.getDay()];
        
        
        const months = ["December", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November"];
       

        const monthsStandard = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        document.getElementById('clock-date').innerText = now.getDate() + " " + monthsStandard[now.getMonth()] + " " + now.getFullYear();
        
      
        let hours = now.getHours();
        let minutes = now.getMinutes();
        let seconds = now.getSeconds(); 
        
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        
        document.getElementById('clock-time').innerText = hours + ":" + minutes + ":" + seconds;
    }

    
    setInterval(updateClock, 1000);
    updateClock();
</script>

@endsection
