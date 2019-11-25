"use strict"
document.addEventListener("DOMContentLoaded", function(){
    let app = new Vue({
        el: "#comentarios-api",
        data: {
            title: "Lista de comentarios",
            loading: false,
            comentarios: [],
            promedio: 0,
            admin: false
        },
         
        methods: {
            borrarComentario: function (event, id_comentario){
            let urlencoded = encodeURI("api/comentarios/"+id_comentario)
            fetch(urlencoded,{
                "method" : "DELETE"
            })
            .then(response => {
                if (!response.ok) { console.log("error"); } else { return response.json()}})
            .then( () => {
                getComentarios();
                console.log("Borrado exitoso");
            })
            .catch(error => console.log(error));
            },

            agregarComentario: function (){
                let texto= document.querySelector("#texto-comentario").value;
                let puntaje= document.querySelector("#puntaje-comentario").value;
                let id_producto = document.querySelector(".id_producto").value;
                let id_usuario = document.querySelector(".nombreusuario-id").id;

                let data = {
                    "texto": texto,
                    "puntaje": puntaje,
                    "id_producto" : id_producto,
                    "id_usuario" : id_usuario
                };

                fetch("api/comentarios",{
                    "method" : "POST",
                    "mode": 'cors',
                    "headers": {'Content-Type': 'application/json'},       
                    "body": JSON.stringify(data)
                }).then(response => {
                    if (!response.ok) { console.log("error"); } else { return response.json()}
                })
                .then(() =>{
                    getComentarios();
                    console.log("publicado con exito")
                })
                .catch(error => console.log(error));
            }
            
        },
    }
    );
        
        document.addEventListener("load", getComentarios());
        function getComentarios(){
            let idproducto = document.querySelector(".container").dataset.id_producto;
            console.log(idproducto);
            app.loading = true;
            let urlencoded = encodeURI("api/productos/"+idproducto+"/comentarios")
            fetch(urlencoded)
            .then(response => response.json())
            .then(comentarios => {
                app.comentarios = comentarios;
                app.promedio = promedioCom(comentarios);
                console.log("Consulta exitosa");
                app.loading = false;
            })
            .catch(error => console.log(error));
        };
        document.querySelector("#btn-refrescar").addEventListener('click', getComentarios);

        function promedioCom(comentarios){
            let puntaje= 0;
            let cont = 0;
            for(let comentario of comentarios){
                puntaje += Number(comentario.puntaje);
                cont++;
            }
            puntaje = puntaje/cont;
            let promedio = puntaje.toFixed(2);

            return promedio;
        }
});