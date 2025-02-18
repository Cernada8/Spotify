document.addEventListener("DOMContentLoaded", function () {
    // Likes por playlist (Mantiene barras)
    fetch("/manager/estadisticas/playlistLikes")
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.nombre);
            const values = data.map(item => item.likes);
            const ctx = document.getElementById('likesPlaylist').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Likes',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: { 
                    responsive: true,
                    scales: { 
                        x: { 
                            ticks: { color: 'yellow' }
                        },
                        y: { 
                            beginAtZero: true,
                            ticks: { color: 'yellow' }
                        }
                    },
                    plugins: { 
                        legend: {
                            labels: {
                                color: 'white',
                                font: {
                                    size: 16, 
                                    weight: 'bold'
                                },
                                padding: 20
                            }
                        }
                    }
                }
            });
        });

    // Reproducciones por playlist (Cambio a línea para mostrar tendencia)
    fetch("/manager/estadisticas/playlistReproducciones")
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.nombre);
            const values = data.map(item => item.reproducciones);
            const ctx = document.getElementById('reproduccionesPlaylist').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Reproducciones',
                        data: values,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: { 
                    responsive: true,
                    scales: { 
                        x: { 
                            ticks: { color: 'yellow' }
                        },
                        y: { 
                            beginAtZero: true,
                            ticks: { color: 'yellow' }
                        }
                    },
                    plugins: { 
                        legend: {
                            labels: {
                                color: 'white',
                                font: {
                                    size: 16, 
                                    weight: 'bold'
                                },
                                padding: 20
                            }
                        }
                    }
                }
            });
        });

    // Rango de edades (Cambio a Pie Chart para ver proporciones)
    fetch("/manager/estadisticas/usuarioEdad")
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.rango);
            const values = data.map(item => item.numero);
            const ctx = document.getElementById('edades').getContext('2d');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Distribución de edades',
                        data: values,
                        backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff'],
                        borderWidth: 1
                    }]
                },
                options: { 
                    responsive: true,
                    scales: { 
                        x: { 
                            ticks: { color: 'yellow' }
                        },
                        y: { 
                            beginAtZero: true,
                            ticks: { color: 'yellow' }
                        }
                    },
                    plugins: { 
                        legend: {
                            labels: {
                                color: 'white',
                                font: {
                                    size: 16, 
                                    weight: 'bold'
                                },
                                padding: 20
                            }
                        }
                    }
                }
            });
        });

    // Reproducciones por canción (Cambio a línea para mostrar tendencia)
    fetch("/manager/estadisticas/cancionesReproducciones")
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.titulo);
            const values = data.map(item => item.reproducciones);
            const ctx = document.getElementById('reproduccionesCancion').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Reproducciones',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: { 
                    responsive: true,
                    scales: { 
                        x: { 
                            ticks: { color: 'yellow' }
                        },
                        y: { 
                            beginAtZero: true,
                            ticks: { color: 'yellow' }
                        }
                    },
                    plugins: { 
                        legend: {
                            labels: {
                                color: 'white',
                                font: {
                                    size: 16, 
                                    weight: 'bold'
                                },
                                padding: 20
                            }
                        }
                    }
                }
            });
        });

    // Reproducciones por estilo (Cambio a Doughnut para proporciones)
    fetch("/manager/estadisticas/reproduccionesEstilo")
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.nombre);
            const values = data.map(item => item.totalReproducciones);
            const ctx = document.getElementById('reproduccionesEstilo').getContext('2d');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Reproducciones por estilo',
                        data: values,
                        backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff'],
                        borderWidth: 1
                    }]
                },
                options: { 
                    responsive: true,
                    scales: { 
                        x: { 
                            ticks: { color: 'yellow' }
                        },
                        y: { 
                            beginAtZero: true,
                            ticks: { color: 'yellow' }
                        }
                    },
                    plugins: { 
                        legend: {
                            labels: {
                                color: 'white',
                                font: {
                                    size: 16, 
                                    weight: 'bold'
                                },
                                padding: 20
                            }
                        }
                    }
                }
            });
        });
});
