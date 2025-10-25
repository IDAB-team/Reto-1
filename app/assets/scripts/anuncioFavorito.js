const botonFavorito=document.querySelector('.favoritoToggle');

if(botonFavorito){
    botonFavorito.addEventListener('click',async (e) => {
        e.preventDefault();
        const url= e.currentTarget.href;
        try{
            await axios.get(url);

            botonFavorito.classList.toggle('favoritoActivado');
            
        }catch(error){
            console.error("Error actualizar favorito: ", error);
        }
    })
}