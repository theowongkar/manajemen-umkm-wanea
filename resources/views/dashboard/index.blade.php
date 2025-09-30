<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Dashboard</x-slot>

    {{-- Bagian Statistik Card --}}
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        {{-- Total User --}}
        <x-cards.status-card :count="$totalUsers" title="Jumlah User" subtitle="Jumlah user yang terdaftar" color="red" />

        {{-- Total UMKM --}}
        <x-cards.status-card :count="$totalActiveBusinesses" title="Jumlah UMKM" subtitle="Jumlah UMKM yang aktif" color="red" />
        <x-cards.status-card :count="$totalInactiveBusinesses" title="Jumlah UMKM" subtitle="Jumlah UMKM yang tidak aktif"
            color="red" />
    </section>

    {{-- Bagian Statistik Chart --}}
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        {{-- Line Chart: Total UMKM per Bulan --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Total UMKM ({{ now()->year }})</h3>
            <canvas id="businessesPerMonth"></canvas>
        </div>

        {{-- Bar Chart: Total UMKM per Kelurahan --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Total UMKM per Kelurahan</h3>
            <canvas id="businessesPerVillage"></canvas>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //  Data dari Controller 
        const months = @json(array_values($months));
        const monthLabels = @json($monthLabels);
        const villageLabels = @json($businessesPerVillage->pluck('name'));
        const villageData = @json($businessesPerVillage->pluck('businesses_count'));

        //  Line Chart: UMKM per Bulan 
        new Chart(document.getElementById('businessesPerMonth'), {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Total UMKM',
                    data: months,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

        //  Bar Chart: UMKM per Kelurahan 
        new Chart(document.getElementById('businessesPerVillage'), {
            type: 'bar',
            data: {
                labels: villageLabels,
                datasets: [{
                    label: 'Total UMKM',
                    data: villageData,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</x-app-layout>
