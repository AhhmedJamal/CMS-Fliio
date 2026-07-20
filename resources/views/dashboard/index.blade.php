@extends('layouts.admin')

@section('title', __('dashboard.title'))

@section('content')

    <h2 class="text-3xl font-bold" style="color: {{ $settings->get('text_color', '#1F2937') }}">
        @lang('dashboard.welcome_admin')
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 my-6">

        {{-- Total Revenue --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 d-card-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        {{ __('dashboard.total_revenue') }}
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-800">
                        {{ __('app.currency') }}
                        {{ number_format($totalRevenue, 2) }}
                    </p>
                </div>

                <div class="size-12 rounded-full bg-green-100 flex items-center justify-center icon-card">
                    <i class="fas fa-wallet text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 d-card-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        {{ __('dashboard.total_orders') }}
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-800">
                        {{ number_format($totalOrders) }}
                    </p>
                </div>

                <div class="size-12 rounded-full bg-blue-100 flex items-center justify-center icon-card">
                    <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Average Order Value --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 d-card-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        {{ __('dashboard.average_order_value') }}
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-800">
                        {{ __('app.currency') }}
                        {{ number_format($averageOrderValue, 2) }}
                    </p>
                </div>

                <div class="size-12 rounded-full bg-orange-100 flex items-center justify-center icon-card">
                    <i class="fas fa-chart-line text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Total Customers --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 d-card-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        {{ __('customers.new_customers') }}
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-800">
                        {{ number_format($customers) }}
                    </p>
                </div>

                <div class="size-12 rounded-full bg-purple-100 flex items-center justify-center icon-card">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Revenue Overview
                </h3>
                <p class="text-sm text-gray-500">
                    Monthly revenue for the current year
                </p>
            </div>
        </div>

        <div id="revenueChart"></div>
    </div>
@endsection


@push('styles')
    <style>
        .d-card-item {
            position: relative;
            border-top-right-radius: 36px;
        }

        .icon-card {
            position: absolute;
            top: -18px;
            right: -18px;
        }
    </style>
@endpush


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =============================================
            // 1. جلب البيانات من PHP
            // =============================================
            const monthlyData = @json($monthlyData ?? array_fill(0, 12, 0));
            
            // أسماء الأشهر
            const months = [
                '{{ __("january") }}',
                '{{ __("february") }}',
                '{{ __("march") }}',
                '{{ __("april") }}',
                '{{ __("may") }}',
                '{{ __("june") }}',
                '{{ __("july") }}',
                '{{ __("august") }}',
                '{{ __("september") }}',
                '{{ __("october") }}',
                '{{ __("november") }}',
                '{{ __("december") }}'
            ];

            // =============================================
            // 2. التحقق من وجود بيانات
            // =============================================
            const hasData = monthlyData.some(value => value > 0);
            const chartContainer = document.querySelector("#revenueChart");

            if (!hasData) {
                // عرض رسالة في حال عدم وجود بيانات
                chartContainer.innerHTML = `
                    <div class="text-center py-16 text-gray-500">
                        <i class="fas fa-chart-line text-5xl mb-4 block text-gray-300"></i>
                        <p class="text-lg font-medium text-gray-600">
                            {{ __('dashboard.no_revenue_data') }}
                        </p>
                        <p class="text-sm text-gray-400 mt-1">
                            {{ __('dashboard.no_revenue_data_description') }}
                        </p>
                    </div>
                `;
                return;
            }

            // =============================================
            // 3. إعداد خيارات الرسم البياني
            // =============================================
            const options = {
                series: [{
                    name: '{{ __("dashboard.revenue") }}',
                    data: monthlyData
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    fontFamily: 'Inter, sans-serif',
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    colors: ['#3B82F6'] // لون الخط أزرق
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.35,
                        opacityTo: 0.05,
                        stops: [0, 100],
                        colorStops: [
                            {
                                offset: 0,
                                color: '#3B82F6',
                                opacity: 0.35
                            },
                            {
                                offset: 100,
                                color: '#3B82F6',
                                opacity: 0.05
                            }
                        ]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                grid: {
                    borderColor: '#e5e7eb',
                    strokeDashArray: 4,
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    }
                },
                xaxis: {
                    categories: months,
                    labels: {
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontWeight: 500
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return '{{ __("app.currency") }} ' + value.toLocaleString();
                        },
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontWeight: 500
                        }
                    }
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: function(value) {
                            return '{{ __("app.currency") }} ' + value.toLocaleString();
                        }
                    },
                    x: {
                        formatter: function(value) {
                            return months[value] || value;
                        }
                    },
                    marker: {
                        show: true,
                        fillColors: ['#3B82F6']
                    }
                },
                markers: {
                    size: 4,
                    colors: ['#3B82F6'],
                    strokeColors: '#FFFFFF',
                    strokeWidth: 2,
                    hover: {
                        size: 6
                    }
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                    markers: {
                        width: 8,
                        height: 8,
                        radius: 4
                    },
                    fontSize: '13px',
                    fontWeight: 500,
                    labels: {
                        colors: '#374151'
                    }
                },
                responsive: [
                    {
                        breakpoint: 480,
                        options: {
                            chart: {
                                height: 250
                            },
                            legend: {
                                position: 'bottom',
                                horizontalAlign: 'center'
                            }
                        }
                    }
                ]
            };

            // =============================================
            // 4. رسم الرسم البياني
            // =============================================
            try {
                const chart = new ApexCharts(chartContainer, options);
                chart.render();

                // =============================================
                // 5. (اختياري) تحديث الرسم البياني عند تغيير حجم النافذة
                // =============================================
                let resizeTimer;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(() => {
                        chart.updateOptions({
                            chart: {
                                width: chartContainer.parentElement.offsetWidth
                            }
                        });
                    }, 250);
                });

            } catch (error) {
                console.error('Error rendering chart:', error);
                chartContainer.innerHTML = `
                    <div class="text-center py-10 text-red-500">
                        <i class="fas fa-exclamation-triangle text-3xl mb-2 block"></i>
                        <p>{{ __('dashboard.chart_error') }}</p>
                    </div>
                `;
            }
        });
    </script>
@endpush