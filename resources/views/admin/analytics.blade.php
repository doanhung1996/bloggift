<div class="row">
    <div class="col-lg-7">
        <div class="chart-container">
            <div class="chart has-fixed-height" id="area_basic" data-stats="{{ json_encode($stats, JSON_HEX_APOS) }}"></div>
        </div>
    </div>

    <div class="col-lg-5">
        <div id="world-map" class="h-100" data-country-stats="{{ json_encode($countryStats, JSON_HEX_APOS) }}"></div>
    </div>
    <div class="col-lg-12 mt-4">
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="mr-3 align-self-center">
                            <i class="icon-pointer icon-3x text-success-400"></i>
                        </div>

                        <div class="media-body text-right">
                            <h3 class="font-weight-semibold mb-0">{{ $total['ga:sessions'] }}</h3>
                            <span class="text-uppercase font-size-sm text-muted">{{ __('Phiên') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="mr-3 align-self-center">
                            <i class="icon-users2 icon-3x text-indigo-400"></i>
                        </div>

                        <div class="media-body text-right">
                            <h3 class="font-weight-semibold mb-0">{{ $total['ga:users'] }}</h3>
                            <span class="text-uppercase font-size-sm text-muted">{{ __('Người xem') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="font-weight-semibold mb-0">{{ $total['ga:pageviews'] }}</h3>
                            <span class="text-uppercase font-size-sm text-muted">{{ __('Số lượt xem') }}</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-eye8 icon-3x text-blue-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="font-weight-semibold mb-0">{{ round($total['ga:bounceRate'], 2) }}%</h3>
                            <span class="text-uppercase font-size-sm text-muted">{{ __('Tỷ lệ thoát') }}</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-enter6 icon-3x text-danger-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="font-weight-semibold mb-0">{{ round($total['ga:percentNewSessions'], 2) }}%</h3>
                            <span class="text-uppercase font-size-sm text-muted">{{ __('Phần trăm phiên mới') }}</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-new icon-3x text-blue-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="font-weight-semibold mb-0">{{ round($total['ga:pageviewsPerVisit'], 2) }}</h3>
                            <span class="text-uppercase font-size-sm text-muted">{{ __('Trang / Phiên') }}</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-pie-chart8 icon-3x text-orange-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="font-weight-semibold mb-0">{{ gmdate('H:i:s', $total['ga:avgSessionDuration']) }}</h3>
                            <span class="text-uppercase font-size-sm text-muted">{{ __('Thời gian trung bình xem') }}</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-database-time2 icon-3x text-primary-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="font-weight-semibold mb-0">{{ $total['ga:newUsers'] }}</h3>
                            <span class="text-uppercase font-size-sm text-muted">{{ __('Người xem mới') }}</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-user-plus icon-3x text-green-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    var stats = $('#area_basic').data('stats')

    let xAxis = [];
    let statPageview = [];
    let statVisitor = [];

    $.each(stats, (index, el) => {
        xAxis.push(el.axis);
        statPageview.push(el.pageViews);
        statVisitor.push(el.visitors);
    });
    let series = [
        {
            name: 'Người xem',
            type: 'line',
            data: statVisitor,
            areaStyle: {
                normal: {
                    opacity: 0.25
                }
            },
            smooth: true,
            symbolSize: 7,
            itemStyle: {
                normal: {
                    borderWidth: 2
                }
            }
        },
        {
            name: 'Số lượt xem',
            type: 'line',
            smooth: true,
            symbolSize: 7,
            itemStyle: {
                normal: {
                    borderWidth: 2
                }
            },
            areaStyle: {
                normal: {
                    opacity: 0.25
                }
            },
            data: statPageview
        }

    ]



    // Setup module
    // ------------------------------

    var EchartsAreaBasicLight = function() {


        //
        // Setup module components
        //

        // Basic area chart

        var _areaBasicLightExample = function() {
            if (typeof echarts == 'undefined') {
                console.warn('Cảnh báo - echarts.min.js không thể tải.');
                return;
            }

            // Define element
            var area_basic_element = document.getElementById('area_basic');


            //
            // Charts configuration
            //

            if (area_basic_element) {

                // Initialize chart
                var area_basic = echarts.init(area_basic_element);


                //
                // Chart config
                //

                // Options
                area_basic.setOption({

                    // Define colors
                    color: ['#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80'],

                    // Global text styles
                    textStyle: {
                        fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                        fontSize: 13
                    },

                    // Chart animation duration
                    animationDuration: 750,

                    // Setup grid
                    grid: {
                        left: 0,
                        right: 40,
                        top: 35,
                        bottom: 0,
                        containLabel: true
                    },

                    // Add legend
                    legend: {
                        data: ['Người xem', 'Số lượt xem'],
                        itemHeight: 8,
                        itemGap: 20
                    },

                    // Add tooltip
                    tooltip: {
                        trigger: 'axis',
                        backgroundColor: 'rgba(0,0,0,0.75)',
                        padding: [10, 15],
                        textStyle: {
                            fontSize: 13,
                            fontFamily: 'Roboto, sans-serif'
                        }
                    },

                    // Horizontal axis
                    xAxis: [{
                        type: 'category',
                        boundaryGap: false,
                        data: xAxis,
                        axisLabel: {
                            color: '#333'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#999'
                            }
                        },
                        splitLine: {
                            show: true,
                            lineStyle: {
                                color: '#eee',
                                type: 'dashed'
                            }
                        }
                    }],

                    // Vertical axis
                    yAxis: [{
                        type: 'value',
                        axisLabel: {
                            color: '#333'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#999'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: '#eee'
                            }
                        },
                        splitArea: {
                            show: true,
                            areaStyle: {
                                color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                            }
                        }
                    }],

                    // Add series
                    series: series
                });
            }


            //
            // Resize charts
            //

            // Resize function
            var triggerChartResize = function() {
                area_basic_element && area_basic.resize();
            };

            // On sidebar width change
            var sidebarToggle = document.querySelector('.sidebar-control');
            sidebarToggle && sidebarToggle.addEventListener('click', triggerChartResize);

            // On window resize
            var resizeCharts;
            window.addEventListener('resize', function() {
                clearTimeout(resizeCharts);
                resizeCharts = setTimeout(function () {
                    triggerChartResize();
                }, 200);
            });
        };


        //
        // Return objects assigned to module
        //

        return {
            init: function() {
                _areaBasicLightExample();
            }
        }
    }();


    $(function () {
        EchartsAreaBasicLight.init();
        let mapSelector = $('#world-map');
        let country_stats = mapSelector.data('country-stats');
        let visitorsData = {};

        $.each(country_stats, (index, el) => {
            visitorsData[el[0]] = el[1];
        });

        mapSelector.vectorMap({
            map: 'world_mill',
            backgroundColor: 'transparent',
            regionStyle: {
                initial: {
                    fill: '#e4e4e4',
                    'fill-opacity': 1,
                    stroke: 'none',
                    'stroke-width': 0,
                    'stroke-opacity': 1
                }
            },
            series: {
                regions: [{
                    values: visitorsData,
                    scale: ['#C64333', '#dd4b39'],
                    normalizeFunction: 'polynomial'
                }]
            },
            onRegionTipShow: (e, el, code) => {
                if (typeof visitorsData[code] !== 'undefined') {
                    el.html(el.html() + ': ' + visitorsData[code] + ' ' + 'Người xem');
                }
            }
        });
    })


</script>
