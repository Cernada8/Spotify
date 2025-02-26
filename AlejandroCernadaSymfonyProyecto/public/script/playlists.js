let playlistsAnadir=document.getElementById('playlistsAnadir');
let footer=document.querySelector('footer');

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
function anadirPlaylist(contenedor){
    fetch('/playlist/mostrarTodas').then(response=>response.json()).then(playlists=>{
        for (const playlist of playlists) {
            let img=document.createElement('img');
            img.src='../images/cover.png';
            
            let divCancion=document.createElement('div');
            divCancion.classList.add('cancion');

            divCancion.addEventListener('click',()=>{
                contenedor.innerHTML='';
                let texto=document.getElementById('texto');
                texto.innerHTML=`<h2>Tus canciones de la playlist</h2> ${playlist.nombre}`;
                fetch(`/getCanciones/${playlist.nombre}`).then(response=>response.json()).then(cancionesDePlaylist=>{
                    
                    for (const c of cancionesDePlaylist) {     
                        let img=document.createElement('img');
                        if(c.foto==null){
                            img.src='images/cover.png';
                        }else{
                            img.src=c.foto;
                        }
                
                        let divCancion=document.createElement('div');
                        divCancion.classList.add('cancion');
                
                        divCancion.addEventListener('click',()=>{
                            footer.style.visibility='visible';
                            cancionActual.innerHTML='';
                            let nombreCancion=divCancion.querySelector('.nombre-cancion').textContent;
                            let p=document.createElement('p');
                            p.textContent=nombreCancion+' - '+c.autor;
                            cancionActual.appendChild(p);
                
                          
                                // let ruta=cancion.id+'.mp3';
                                let audio=document.querySelector('audio');
                                audio.src=`cancion/${c.id}`;
                                audio.play();
                
                        });
                
                        let divNombreCancion=document.createElement('div');
                        let nombreCancion2=document.createElement('p');
                        nombreCancion2.classList.add('nombre-cancion');
                        nombreCancion2.textContent=c.titulo;
                
                        divNombreCancion.appendChild(nombreCancion2);
                        divNombreCancion.classList.add='cancionActual'
                
                        divCancion.appendChild(img);
                        divCancion.appendChild(divNombreCancion);
                        
                        contenedor.appendChild(divCancion);
                    }

                });
            })

            let divNombreCancion=document.createElement('div');
            let nombreCancion2=document.createElement('p');
            nombreCancion2.classList.add('nombre-cancion');
            nombreCancion2.textContent=playlist.nombre;

            divNombreCancion.appendChild(nombreCancion2);
            divNombreCancion.classList.add='cancionActual'

            divCancion.appendChild(img);
            divCancion.appendChild(divNombreCancion);
            
            contenedor.appendChild(divCancion);
        }
    });
}

fetch('/getSession').then(response => response.json().then(sesion => {
    if(sesion[0].email==null){
        let textoTusPlaylist=document.getElementById('textoTusPlaylist');
        textoTusPlaylist.style.visibility='hidden';
    }
}))