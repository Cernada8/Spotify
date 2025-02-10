let canciones=document.querySelectorAll('.cancion');
let cancionActual=document.getElementById('cancionActual');
let footer=document.querySelector('footer');
let recomendados=document.getElementById('recomendados');

fetch('/playlist/mostrarTodas').then(response=>response.json()).then(playlists=>{
    for (const playlist of playlists) {
        let img=document.createElement('img');
        img.src='../images/cover.png';

        let divCancion=document.createElement('div');
        divCancion.classList.add('cancion');

        let divNombreCancion=document.createElement('div');
        let nombreCancion2=document.createElement('p');
        nombreCancion2.classList.add('nombre-cancion');
        nombreCancion2.textContent=playlist.nombre;

        divNombreCancion.appendChild(nombreCancion2);
        divNombreCancion.classList.add='cancionActual'

        divCancion.appendChild(img);
        divCancion.appendChild(divNombreCancion);
        
        recomendados.appendChild(divCancion);
    }
});
