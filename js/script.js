"use strict"
document.addEventListener("DOMContentLoaded", function(){
    let app = new Vue({
        el: "#comentarios_api",
        data: {
            title: "Lista de comentarios",
            loading: false,
            comentarios: [],
            promedio: 0,
            admin: false
        },
         
        methods: {
            borrarComentario: function (event, id_comentario){
            fetch("api/comentarios/"+id_comentario,{
                "method" : "DELETE"
            })
            .then(response => response.json())
            .then( () => {
                getComentarios();
                console.log("Consulta DELETE exitosa");
            })
            .catch(error => console.log(error));
            },

            agregarComentario: function (){
                let data = {
                    // cambiar los ()
                    texto: document.querySelector("#texto-comentario").value,
                    puntaje: document.querySelector("#puntaje-comentario").value,
                    id_producto : document.querySelector(".idpelicula").value,
                    id_usuario : document.querySelector(".username-id").id
                };
                fetch("api/comentarios",{
                    "method" : "POST",
                    headers: {'Content-Type': 'application/json'},       
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(() =>{
                    getComentarios();
                    console.log("Consulta POST exitosa")
                })
                .catch(error => console.log(error));
            }
            
        },
    }
    );
        //let idpelicula = document.querySelector(".container").data-idpelicula;
        document.addEventListener("load", getComentarios());
        function getComentarios(){
            let idproducto = document.querySelector(".container").dataset.idproducto;
            console.log(idproducto);
            app.loading = true;
            fetch("api/productos/"+idproducto+"/comentarios")
            .then(response => response.json())
            .then(comentarios => {
                app.comentarios = comentarios;
                app.promedio = promedioCom(comentarios);
                console.log("Consulta GET exitosa");
                app.loading = false;
            })
            .catch(error => console.log(error));
        };
        document.querySelector("#btn-refresco").addEventListener('click', getComentarios);

        function promedioCom(comentarios){
            let Puntaje= 0;
            let cont = 0;
            for(let comentario of comentarios){
                Puntaje += Number(comentario.puntaje);
                cont++;
            }
            Puntaje = Puntaje/cont;
            let Promedio = Puntaje.toFixed(2);

            return Promedio;
        }
});