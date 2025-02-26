let playlistsAnadir = document.getElementById('playlistsAnadir');
let contenedorTodo = document.getElementById('canciones');
let botonCrearPlaylist = document.getElementById('crearPlaylist');
let buscar = document.querySelector('input');
let tusPlaylist=document.getElementById('tusPlaylist');

fetch('/playlist/mostrarPorUsuario').then(response => response.json().then(playlists => {
    for (const playlist of playlists) {
        let img = document.createElement('img');
        img.src = '../images/cover.png';

        let divCancion = document.createElement('div');
        divCancion.classList.add('cancion');

        divCancion.addEventListener('click', () => {
            recomendados.innerHTML = '';
            tusPlaylist.innerHTML = '';
            playlistsAnadir.innerHTML = '';

            let textoTusPlaylist=document.getElementById('textoTusPlaylist');
            textoTusPlaylist.textContent='';

            let textoPlaylist = document.getElementById('textoPlaylist');
            textoPlaylist.innerHTML = '';
            let texto = document.getElementById('texto');
            texto.innerHTML = `<h2>Tus canciones de la playlist</h2> ${playlist.nombre}`;
            fetch(`/getCanciones/${playlist.nombre}`).then(response => response.json()).then(cancionesDePlaylist => {
                for (const c of cancionesDePlaylist) {
                    let img = document.createElement('img');
                    if (c.foto == null) {
                        img.src = 'images/cover.png';
                    } else {
                        img.src = c.foto;
                    }

                    let divCancion = document.createElement('div');
                    divCancion.classList.add('cancion');

                    divCancion.addEventListener('click', () => {
                        footer.style.visibility = 'visible';
                        cancionActual.innerHTML = '';
                        let nombreCancion = divCancion.querySelector('.nombre-cancion').textContent;
                        let p = document.createElement('p');
                        p.textContent = nombreCancion + ' - ' + c.autor;
                        cancionActual.appendChild(p);


                        // let ruta=cancion.id+'.mp3';
                        let audio = document.querySelector('audio');
                        audio.src = `cancion/${c.id}`;
                        audio.play();

                    });

                    let divNombreCancion = document.createElement('div');
                    let nombreCancion2 = document.createElement('p');
                    nombreCancion2.classList.add('nombre-cancion');
                    nombreCancion2.textContent = c.titulo;

                    divNombreCancion.appendChild(nombreCancion2);
                    divNombreCancion.classList.add = 'cancionActual'

                    divCancion.appendChild(img);
                    divCancion.appendChild(divNombreCancion);

                    recomendados.appendChild(divCancion);

                }
            });
        })

        let divNombreCancion = document.createElement('div');
        let nombreCancion2 = document.createElement('p');
        nombreCancion2.classList.add('nombre-cancion');
        nombreCancion2.textContent = playlist.nombre;

        divNombreCancion.appendChild(nombreCancion2);
        divNombreCancion.classList.add = 'cancionActual'

        divCancion.appendChild(img);
        divCancion.appendChild(divNombreCancion);

        let h2=document.createElement('h2');
        h2.textContent='Tus playlists';

        tusPlaylist.appendChild(divCancion);
        
    }
}));


anadirPlaylist(playlistsAnadir)
function anadirPlaylist(contenedor) {
    fetch('/playlist/mostrarTodas').then(response => response.json()).then(playlists => {
        for (const playlist of playlists) {
            let img = document.createElement('img');
            img.src = '../images/cover.png';

            let divCancion = document.createElement('div');
            divCancion.classList.add('cancion');

            divCancion.addEventListener('click', () => {
                recomendados.innerHTML = '';
                contenedor.innerHTML = '';
                let textoPlaylist = document.getElementById('textoPlaylist');
                textoPlaylist.innerHTML = '';
                let texto = document.getElementById('texto');
                texto.innerHTML = `<h2>Tus canciones de la playlist</h2> ${playlist.nombre}`;
                fetch(`/getCanciones/${playlist.nombre}`).then(response => response.json()).then(cancionesDePlaylist => {
                    for (const c of cancionesDePlaylist) {
                        let img = document.createElement('img');
                        if (c.foto == null) {
                            img.src = 'images/cover.png';
                        } else {
                            img.src = c.foto;
                        }

                        let divCancion = document.createElement('div');
                        divCancion.classList.add('cancion');

                        divCancion.addEventListener('click', () => {
                            footer.style.visibility = 'visible';
                            cancionActual.innerHTML = '';
                            let nombreCancion = divCancion.querySelector('.nombre-cancion').textContent;
                            let p = document.createElement('p');
                            p.textContent = nombreCancion + ' - ' + c.autor;
                            cancionActual.appendChild(p);


                            // let ruta=cancion.id+'.mp3';
                            let audio = document.querySelector('audio');
                            audio.src = `cancion/${c.id}`;
                            audio.play();

                        });

                        let divNombreCancion = document.createElement('div');
                        let nombreCancion2 = document.createElement('p');
                        nombreCancion2.classList.add('nombre-cancion');
                        nombreCancion2.textContent = c.titulo;

                        divNombreCancion.appendChild(nombreCancion2);
                        divNombreCancion.classList.add = 'cancionActual'

                        divCancion.appendChild(img);
                        divCancion.appendChild(divNombreCancion);

                        recomendados.appendChild(divCancion);

                    }
                });
            })

            let divNombreCancion = document.createElement('div');
            let nombreCancion2 = document.createElement('p');
            nombreCancion2.classList.add('nombre-cancion');
            nombreCancion2.textContent = playlist.nombre;

            divNombreCancion.appendChild(nombreCancion2);
            divNombreCancion.classList.add = 'cancionActual'

            divCancion.appendChild(img);
            divCancion.appendChild(divNombreCancion);

            contenedor.appendChild(divCancion);
        }
    });
}


let cancionActual = document.getElementById('cancionActual');
let footer = document.querySelector('footer');
let recomendados = document.getElementById('recomendados');

fetch('/cancion/mostrarTodas').then(response => response.json()).then(canciones => {
    for (const cancion of canciones) {
        let img = document.createElement('img');
        if (cancion.foto == null) {
            img.src = 'images/cover.png';
        } else {
            img.src = cancion.foto;
        }

        let divCancion = document.createElement('div');
        divCancion.classList.add('cancion');

        divCancion.addEventListener('click', () => {
            footer.style.visibility = 'visible';
            cancionActual.innerHTML = '';
            let nombreCancion = divCancion.querySelector('.nombre-cancion').textContent;
            let p = document.createElement('p');
            p.textContent = nombreCancion + ' - ' + cancion.autor;
            cancionActual.appendChild(p);


            // let ruta=cancion.id+'.mp3';
            let audio = document.querySelector('audio');
            audio.src = `cancion/${cancion.id}`;
            audio.play();

        });

        let divNombreCancion = document.createElement('div');
        let nombreCancion2 = document.createElement('p');
        nombreCancion2.classList.add('nombre-cancion');
        nombreCancion2.textContent = cancion.titulo;

        divNombreCancion.appendChild(nombreCancion2);
        divNombreCancion.classList.add = 'cancionActual'

        divCancion.appendChild(img);
        divCancion.appendChild(divNombreCancion);

        recomendados.appendChild(divCancion);
    }
});

let intervalo;

//AÑADIR METODO DE GETPLAYLIST POR USUARIO

botonCrearPlaylist.addEventListener('click', () => {
    //HACER FORM DE PLAYLIST --> boton para hacerlas
})


//fetch de todas las canciones y playlists (todas)
let todo;
fetch('/getCancionesYPlaylists').then(response => response.json().then(todos => {
    todo = todos;
}))

buscar.addEventListener('input', () => { //En vez de input, cada vez que pare de escribir



    clearTimeout(intervalo);
    intervalo = setTimeout(() => {
        let buscando = buscar.value.toLowerCase();
        recomendados.innerHTML='';
        playlistsAnadir.innerHTML='';
        if (buscando != "") {
            

            //Bucle de las canciones y las playlists
            for (const obj of todo) {

                let cancionNombre = obj.cancion.titulo.toLowerCase();
                let playlistNombre = obj.playlist.nombre.toLowerCase();
                let cancion = obj.cancion;
                let playlist = obj.playlist;

                if (cancionNombre.includes(buscando)) {
                    let img = document.createElement('img');
                    if (cancion.foto == null) {
                        img.src = 'images/cover.png';
                    } else {
                        img.src = cancion.foto;
                    }
            
                    let divCancion = document.createElement('div');
                    divCancion.classList.add('cancion');
            
                    divCancion.addEventListener('click', () => {
                        footer.style.visibility = 'visible';
                        cancionActual.innerHTML = '';
                        let nombreCancion = divCancion.querySelector('.nombre-cancion').textContent;
                        let p = document.createElement('p');
                        p.textContent = nombreCancion + ' - ' + cancion.autor;
                        cancionActual.appendChild(p);
            
            
                        // let ruta=cancion.id+'.mp3';
                        let audio = document.querySelector('audio');
                        audio.src = `cancion/${cancion.id}`;
                        audio.play();
            
                    });
            
                    let divNombreCancion = document.createElement('div');
                    let nombreCancion2 = document.createElement('p');
                    nombreCancion2.classList.add('nombre-cancion');
                    nombreCancion2.textContent = cancion.titulo;
            
                    divNombreCancion.appendChild(nombreCancion2);
                    divNombreCancion.classList.add = 'cancionActual'
            
                    divCancion.appendChild(img);
                    divCancion.appendChild(divNombreCancion);
            
                    recomendados.appendChild(divCancion);
                }

                if (playlistNombre.includes(buscando)) {
                    let img = document.createElement('img');
                    img.src = '../images/cover.png';

                    let divCancion = document.createElement('div');
                    divCancion.classList.add('cancion');

                    let divNombreCancion = document.createElement('div');
                    let nombreCancion2 = document.createElement('p');
                    nombreCancion2.classList.add('nombre-cancion');
                    nombreCancion2.textContent = playlist.nombre;

                    console.log(playlist.nombre)

                    divNombreCancion.appendChild(nombreCancion2);
                    divNombreCancion.classList.add = 'cancionActual'

                    divCancion.appendChild(img);
                    divCancion.appendChild(divNombreCancion);

                    divCancion.addEventListener('click', () => {
                        recomendados.innerHTML = '';
                        playlistsAnadir.innerHTML = '';
                        let textoPlaylist = document.getElementById('textoPlaylist');
                        textoPlaylist.innerHTML = '';
                        let texto = document.getElementById('texto');
                        texto.innerHTML = `<h2>Tus canciones de la playlist</h2> ${playlist.nombre}`;
                        fetch(`/getCanciones/${playlist.nombre}`).then(response => response.json()).then(cancionesDePlaylist => {
                            for (const c of cancionesDePlaylist) {
                                let img = document.createElement('img');
                                if (c.foto == null) {
                                    img.src = 'images/cover.png';
                                } else {
                                    img.src = c.foto;
                                }
        
                                let divCancion = document.createElement('div');
                                divCancion.classList.add('cancion');
        
                                divCancion.addEventListener('click', () => {
                                    footer.style.visibility = 'visible';
                                    cancionActual.innerHTML = '';
                                    let nombreCancion = divCancion.querySelector('.nombre-cancion').textContent;
                                    let p = document.createElement('p');
                                    p.textContent = nombreCancion + ' - ' + c.autor;
                                    cancionActual.appendChild(p);
        
        
                                    // let ruta=cancion.id+'.mp3';
                                    let audio = document.querySelector('audio');
                                    audio.src = `cancion/${c.id}`;
                                    audio.play();
        
                                });
        
                                let divNombreCancion = document.createElement('div');
                                let nombreCancion2 = document.createElement('p');
                                nombreCancion2.classList.add('nombre-cancion');
                                nombreCancion2.textContent = c.titulo;
        
                                divNombreCancion.appendChild(nombreCancion2);
                                divNombreCancion.classList.add = 'cancionActual'
        
                                divCancion.appendChild(img);
                                divCancion.appendChild(divNombreCancion);
        
                                recomendados.appendChild(divCancion);
        
                            }
                        });
                    })

                    playlistsAnadir.appendChild(divCancion);
                }
            }

        }else{
            document.location='index.html'
        }





    }, 500);
});



fetch('/getSession').then(response => response.json().then(sesion => {
    if(sesion[0].email==null){
        let containerCrearPlaylist=document.getElementById('container-crear-playlist');
        containerCrearPlaylist.style.visibility='hidden';
    }
}))




