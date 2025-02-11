let playlistsAnadir=document.getElementById('playlistsAnadir');

anadirPlaylist(playlistsAnadir)
function anadirPlaylist(contenedor){
    fetch('/playlist/mostrarTodas').then(response=>response.json()).then(playlists=>{
        for (const playlist of playlists) {
            let img=document.createElement('img');
            img.src='../images/cover.png';

            let divCancion=document.createElement('div');
            divCancion.classList.add('cancion');

            divCancion.addEventListener('click',()=>{
                fetch(`/getCanciones/${playlist.nombre}`).then(response=>response.json()).then(cancionesDePlaylist=>{
                    
                    for (const c of cancionesDePlaylist) {
                        console.log(c.titulo);
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

let cancionActual=document.getElementById('cancionActual');
let footer=document.querySelector('footer');
let recomendados=document.getElementById('recomendados');

fetch('/cancion/mostrarTodas').then(response=>response.json()).then(canciones=>{
    for (const cancion of canciones) {
        let img=document.createElement('img');
        if(cancion.foto==null){
            img.src='images/cover.png';
        }else{
            img.src=cancion.foto;
        }

        let divCancion=document.createElement('div');
        divCancion.classList.add('cancion');

        divCancion.addEventListener('click',()=>{
            footer.style.visibility='visible';
            cancionActual.innerHTML='';
            let nombreCancion=divCancion.querySelector('.nombre-cancion').textContent;
            let p=document.createElement('p');
            p.textContent=nombreCancion+' - '+cancion.autor;
            cancionActual.appendChild(p);

          
                // let ruta=cancion.id+'.mp3';
                let audio=document.querySelector('audio');
                audio.src=`cancion/${cancion.id}`;
                audio.play();

        });

        let divNombreCancion=document.createElement('div');
        let nombreCancion2=document.createElement('p');
        nombreCancion2.classList.add('nombre-cancion');
        nombreCancion2.textContent=cancion.titulo;

        divNombreCancion.appendChild(nombreCancion2);
        divNombreCancion.classList.add='cancionActual'

        divCancion.appendChild(img);
        divCancion.appendChild(divNombreCancion);
        
        recomendados.appendChild(divCancion);
    }
});
